<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ParentModel;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class ParentController extends Controller
{
    //
    public function index()
    {
        $parent = ParentModel::all();
        return view('admin.parent.index', compact('parent'));
    }

    public function create()
    {
        return view("admin.parent.create");
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(),[
            'nama' => 'required|string',
            'username' => 'required|string',
            'password'=> "required|string|min:8",
            'email' => 'nullable|string',
            'status_ortu' => 'required|string',
            'no_hp' => 'required|numeric|min:12',
            'alamat' => 'nullable|string',
            'verifikasi' => "nullable|string",
            'foto_kk' =>"required|image",
        ]);

        if ($validator->fails()){
            return back()->with("error", $validator->errors()->first());
        }

        // dd($request->all());

        $user = User::create([
            'nama' => $request->nama, //berdasarkan field db
            'username' => $request->username,
            'password'=> Hash::make($request->password),
            'email' => $request->email,
            'no_hp' => $request->no_hp,
            'level' => 'parent',
            'alamat' => $request->alamat,
        ]);

        // Do Upload
        $foto_kk = $request->file("foto_kk");
        if(!$foto_kk->isValid()) {
            return back()->with("error", "can't uploaded file");
        }

        $upload_kk = $request->foto_kk->storeAs("parents", $user->id.".".$foto_kk->getClientOriginalExtension()); //untuk ambil png/jpg dll

        ParentModel::create([
            'id' => $user->id,
            'verifikasi' => $request->verifikasi,
            'status_ortu' => $request->status_ortu,
            'foto_kk' => $upload_kk,
        ]);

        return redirect()->route('admin.parent.index')->with("success", "Parent berhasil ditambahkan");
    }

    public function edit(ParentModel $parent)
    {
        return view("admin.parent.edit", compact("parent")); //sesuai variabel diatas
    }

    public function update(ParentModel $parent, Request $request)
    {
        $validator = Validator::make($request->all(),[
            'nama' => 'required|string',
            'username' => 'required|string',
            'password'=> "nullable|string|min:8",
            'email' => 'nullable|string',
            'status_ortu' => 'required|string',
            'no_hp' => 'required|numeric|min:12',
            'alamat' => 'nullable|string',
            'verifikasi' => "nullable|string",
            'foto_kk' =>"nullable|image",
        ]);

        if ($validator->fails()){
            return back()->with("error", $validator->errors()->first());
        }

        // dd($request->all());
        $update_user = [
            'nama' => $request->nama, //berdasarkan field db
            'username' => $request->username,
            'email' => $request->email,
            'no_hp' => $request->no_hp,
            'alamat' => $request->alamat,
        ];

        if($request->filled('password')) {
            $update_user['password'] = Hash::make($request->password);
        }

        // $user = User::find($parent->user->id)->update([ pilih salah satu
        $user = $parent->user;
        $user->update($update_user);

        $update_parent = [
            'verifikasi' => $request->verifikasi,
            'status_ortu' => $request->status_ortu,
        ];

        // Do Upload
        if($request->has('foto_kk')) {
            $foto_kk = $request->file("foto_kk");
            if(!$foto_kk->isValid()) {
                return back()->with("error", "can't uploaded file");
            }
            $upload_kk = $request->foto_kk->storeAs("parents", $user->id.".".$foto_kk->getClientOriginalExtension()); //untuk ambil png/jpg dll

            $update_parent['foto_kk'] = $upload_kk;
        }


        $parent = $parent->update($update_parent);

        return redirect()->route('admin.parent.index')->with("success", "Parent berhasil diubah");
    }

    public function delete(ParentModel $parent)
    {
        $parent->user->delete();
        $parent->delete();
        return redirect()->route('admin.parent.index')->with("success", "Parent berhasil dihapus");
    }
}
