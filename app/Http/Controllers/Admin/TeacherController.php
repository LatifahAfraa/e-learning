<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Teacher;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class TeacherController extends Controller
{
    //

    public function index()
    {
        $teacher = Teacher::all();
        return view("admin.Teacher.index", compact("teacher"));
    }

    public function create()
    {
        return view("admin.Teacher.create");
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nama' => 'required|string',
            'username' => 'required|string',
            'password' => "required|string|min:8",
            'email' => 'nullable|string',
            'status_kepegawaian' => 'required|string',
            'no_hp' => 'required|numeric|min:12',
            'alamat' => 'nullable|string',
            'nip'   =>  'required|numeric',
            'mapel' => "nullable|string",
            'jabatan' => "nullable|string",
            'ttd' => "nullable|image",
            'foto' => "required|image",
        ]);

        if ($validator->fails()) {
            return back()->with("error", $validator->errors()->first());
        }

        $user = User::create([
            'nama' => $request->nama, //berdasarkan field db
            'username' => $request->username,
            'password' => Hash::make($request->password),
            'email' => $request->email,
            'no_hp' => $request->no_hp,
            'level' => 'teacher',
            'alamat' => $request->alamat,
        ]);

        $ttd = $request->file("ttd");
        if (!$ttd->isValid()) {
            return back()->with("error", "can't uploaded file");
        }
        $upload_ttd = $request->ttd->storeAs("teachers/ttd", $user->id . "." . $ttd->getClientOriginalExtension());

        $foto = $request->file("foto");
        if (!$foto->isValid()) {
            return back()->with("error", "can't uploaded file");
        }
        $upload_foto = $request->foto->storeAs("teachers/foto", $user->id . "." . $foto->getClientOriginalExtension());

        $teacher =  Teacher::create([
            'id' => $user->id,
            'nip' => $request->nip,
            'mapel' =>  $request->mapel,
            'jabatan' => $request->jabatan,
            'status_kepegawaian' => $request->status_kepegawaian,
            'ttd' => $upload_ttd,
            'foto' => $upload_foto,
        ]);
        return redirect()->route('admin.teacher.index')->with("success", "Teacher berhasil ditambahkan");
    }

    public function edit(Teacher $teacher)
    {
        return view("admin.Teacher.edit", compact("teacher"));
    }
    public function update(Teacher $teacher, Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nama' => 'required|string',
            'username' => 'required|string',
            'password' => "nullable|string|min:8",
            'email' => 'nullable|string',
            'status_kepegawaian' => 'required|string',
            'no_hp' => 'required|numeric|min:12',
            'alamat' => 'nullable|string',
            'nip'   =>  'required|numeric',
            'mapel' => "nullable|string",
            'jabatan' => "nullable|string",
            'ttd' => "nullable|image",
            'foto' => "required|image",
        ]);
        if ($validator->fails()) {
            return back()->with("error", $validator->errors()->first());
        }
        $update_user = [
            'nama' => $request->nama, //berdasarkan field db
            'username' => $request->username,
            'email' => $request->email,
            'no_hp' => $request->no_hp,
            'alamat' => $request->alamat,
        ];

        if ($request->filled('password')) {
            $update_user['password'] = Hash::make($request->password);
        }
        $user = $teacher->user;
        $user->update($update_user);

        $update_teacher = [
            'nip' => $request->nip,
            'mapel' =>  $request->mapel,
            'jabatan' => $request->jabatan,
            'status_kepegawaian' => $request->status_kepegawaian,
        ];
        if ($request->has('ttd')) {
            $ttd = $request->file("ttd");
            if (!$ttd->isValid()) {
                return back()->with("error", "can't uploaded file");
            }
            $upload_ttd = $request->ttd->storeAs("teachers/ttd", $user->id . "." . $ttd->getClientOriginalExtension()); //untuk ambil png/jpg dll

            $update_teacher['ttd'] = $upload_ttd;
        }

        if ($request->has('foto')) {
            $foto = $request->file("foto");
            if (!$foto->isValid()) {
                return back()->with("error", "can't uploaded file");
            }
            $upload_foto = $request->foto->storeAs("teachers/foto", $user->id . "." . $foto->getClientOriginalExtension()); //untuk ambil png/jpg dll

            $update_teacher['foto'] = $upload_foto;
        }
        $teacher = $teacher->update($update_teacher);


        return redirect()->route('admin.teacher.index')->with("success", "Teacher berhasil diubah");
    }

    public function delete(Teacher $teacher)
    {
        $teacher->user->delete();
        $teacher->delete();
        return redirect()->route('admin.teacher.index')->with("success", "Teacher berhasil dihapus");
    }
}
