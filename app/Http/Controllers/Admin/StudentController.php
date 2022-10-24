<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ParentModel;
use App\Models\Student;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class StudentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $student = Student::all();
        return view('admin.Student.index', compact('student'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $parents = ParentModel::all();
        return view('admin.Student.create', compact('parents'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nama' => 'required|string',
            'nisn' => 'required|string',
            'username' => 'required|string',
            'password' => "required|string|min:8",
            'email' => 'nullable|string',
            'parent_id' => 'required|numeric',
            'no_hp' => 'required|numeric|min:12',
            'alamat' => 'nullable|string',
            'kelas' => 'required|string',
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
            'level' => 'student',
            'alamat' => $request->alamat,
        ]);

        $foto = $request->file("foto");
        if (!$foto->isValid()) {
            return back()->with("error", "can't uploaded file");
        }

        $upload_foto = $request->foto->storeAs("students", $user->id . "." . $foto->getClientOriginalExtension());
        Student::create([
            'id' => $user->id,
            'parent_id' => $request->parent_id,
            'kelas' => $request->kelas,
            'nisn' => $request->nisn,
            'foto' => $upload_foto,
        ]);

        return redirect()->route('admin.student.index')->with("success", "Student berhasil ditambahkan");
    }
    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Student  $student
     * @return \Illuminate\Http\Response
     */
    public function show(Student $student)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Student  $student
     * @return \Illuminate\Http\Response
     */
    public function edit(Student $student)
    {
        $parents = ParentModel::all();
        return view("admin.Student.edit", compact("student", "parents"));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Student  $student
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Student $student)
    {
        $validator = Validator::make($request->all(), [
            'nama' => 'required|string',
            'nisn' => 'required|string',
            'username' => 'required|string',
            'password' => "nullable|string|min:8",
            'email' => 'nullable|string',
            'kelas' => 'nullable|string',
            'parent_id' => 'required|numeric',
            'no_hp' => 'required|numeric|min:12',
            'alamat' => 'nullable|string',
            'foto' => "required|image",
        ]);
        if ($validator->fails()) {
            return back()->with("error", $validator->errors()->first());
        }
        $update_user = [
            'nama' => $request->nama,
            'username' => $request->username,
            'email' => $request->email,
            'no_hp' => $request->no_hp,
            'alamat' => $request->alamat,
        ];
        if ($request->filled('password')) {
            $update_user['password'] = Hash::make($request->password);
        }
        $user = $student->user;
        $user->update($update_user);

        $update_student = [
            'parent_id' => $request->parent_id,
            'kelas' => $request->kelas,
            'nisn' => $request->nisn,
        ];

        if ($request->has('foto')) {
            $foto = $request->file("foto");
            if (!$foto->isValid()) {
                return back()->with("error", "can't uploaded file");
            }
            $update_foto = $request->foto->storeAs("students", $user->id . "." . $foto->getClientOriginalExtension());
            $update_student['foto'] = $update_foto;

            $student = $student->update($update_student);
            return redirect()->route('admin.student.index')->with("success", "Student berhasil diubah");
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Student  $student
     * @return \Illuminate\Http\Response
     */
    public function destroy(Student $student)
    {
        $student->user->delete();
        $student->delete();
        return redirect()->route('admin.student.index')->with("success", "Student berhasil dihapus");
    }
}
