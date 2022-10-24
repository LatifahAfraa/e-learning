<?php

use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\HomeController;
use App\Http\Controllers\Admin\ParentController;
use App\Http\Controllers\Admin\StudentController;
use App\Http\Controllers\Admin\TeacherController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::prefix("admin")->as("admin.")->group(function () { // untuk menambah awalan pada url
    Route::get("/", [HomeController::class, 'index'])->name("home");
    route::get("/admin", [AdminController::class, 'index'])->name("admin.index");
    route::post("/admin", [AdminController::class, 'store'])->name("admin.store");
    route::get("/admin/{admin}/edit", [AdminController::class, 'edit'])->name("admin.edit");
    route::put("/admin/{admin}/edit", [AdminController::class, 'update'])->name("admin.update");
    route::delete("/admin/{admin}", [AdminController::class, 'delete'])->name("admin.delete");
    route::get("/admin/create", [AdminController::class, 'create'])->name("admin.create");

    //
    route::get("/parent", [ParentController::class, 'index'])->name("parent.index");
    route::get("/parent/create", [ParentController::class, 'create'])->name("parent.create");
    route::post("/parent", [ParentController::class, 'store'])->name("parent.store");
    route::get("/parent/{parent}/edit", [ParentController::class, 'edit'])->name("parent.edit");
    route::put("/parent/{parent}/edit", [ParentController::class, 'update'])->name("parent.update");
    route::delete("/parent/{parent}",[ParentController::class, 'delete'])->name("parent.delete");

    //
    route::get("/teacher", [TeacherController::class, 'index'])->name("teacher.index");
    route::get("/teacher/create", [TeacherController::class, 'create'])->name("teacher.create");
    route::post("/teacher", [TeacherController::class, 'store'])->name("teacher.store");
    route::get("/teacher/{teacher}/edit", [TeacherController::class, 'edit'])->name("teacher.edit");
    route::put("/teacher/{teacher}/edit", [TeacherController::class, 'update'])->name("teacher.update");
    route::delete("/teacher/{teacher}",[TeacherController::class, 'delete'])->name("teacher.delete");

    // route::get("/student", [StudentController::class, 'index'])->name("student.index");
    // route::get("/student/create", [StudentController::class, 'create'])->name("student.create");
    // route::post("/student", [StudentController::class, 'store'])->name("student.store");
    // route::get("/student/{student}/edit", [StudentController::class,'edit'])->name("student.edit");
    // route::put("/student/{student}/edit",[StudentController::class, 'update'])->name("student.update");
    // route::delete("/student/{student}", [StudentController::class, 'destroy'])->name("student.destroy");

    Route::resource('student', StudentController::class);
});


Route::get('/', function () {
    return view('welcome');
});
