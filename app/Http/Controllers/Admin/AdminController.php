<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
    public function index()
    {
        $admin = Admin::all();
        return view('admin.admin.index', compact("admin")); //untuk ambil data $admin
    }

    public function create()
    {
        return view('admin.Admin.create');
    }

    public function store(Request $request)
    {
        $validator= Validator::make($request->all(),[
            'nama' => "required|string", //berdasarkan name pada form
            'username' => "required|string",
            'password'=> "required|string|min:8",
            'email' => 'nullable|string',
            'status_admin' => 'required|string',
            'no_hp' => 'required|numeric|min:12',
            'alamat' => 'nullable|string',
        ]);

        if($validator->fails()) {   // fails untuk mengecek kondisi $validator jika data ada salah maka true, jika benar semua false
            return back()->with("error", $validator->errors()->first());
        }

        $user = User::create([
            'nama' => $request->nama, //berdasarkan field db
            'username' => $request->username,
            'password'=> Hash::make($request->password),
            'email' => $request->email,
            'no_hp' => $request->no_hp,
            'level' => 'admin',
            'alamat' => $request->alamat,
        ]);

        $admin = Admin::create([
            'id' => $user->id,
            'status_admin' => $request->status_admin,
        ]);

        return redirect()->route('admin.admin.index')->with("success", "Admin berhasil ditambahkan");
    }

    public function edit(Admin $admin)
    {
        return view("admin.admin.edit", compact("admin"));
    }

    public function update(Admin $admin, Request $request)
    {
        $validator = Validator::make($request->all(),[
            'nama' => "required|string", //berdasarkan name pada form
            'username' => "required|string",
            'password'=> "nullable|string|min:8",
            'email' => 'nullable|string',
            'status_admin' => 'required|string',
            'no_hp' => 'required|numeric|min:12',
            'alamat' => 'nullable|string',
        ]);

        if ($validator->fails()){
            return back()->with("error", $validator->errors()->first());
        }
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
        $user = $admin->user->update($update_user);

        $update_admin=[
            'status_admin' => $request->status_admin,
        ];

        $admin= $admin->update($update_admin);
        return redirect()->route("admin.admin.index")->with("success", "Admin berhasil diubah");
    }

    public function delete(Admin $admin)
    {
        $admin->user->delete();
        $admin->delete();
        return redirect()->route("admin.admin.index")->with("success", "Admin berhasil dihapus");
    }
}
