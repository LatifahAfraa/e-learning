<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin;
use App\Http\Controllers\Teacher;
use App\Http\Controllers\Parent as ParentNameSpace;
use App\Http\Controllers\Student;

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

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    // if(auth()->user()->level == "admin") {
    //     return redirect()->route("admin.home");
    // }

    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

Route::middleware(['auth'])->group(function () {
    Route::prefix("admin")->as("admin.")->middleware(['hanya.admin'])->group(function () { // untuk menambah awalan pada url
        Route::get("/", [Admin\HomeController::class, 'index'])->name("home");
        route::get("/admin", [Admin\AdminController::class, 'index'])->name("admin.index");
        route::post("/admin", [Admin\AdminController::class, 'store'])->name("admin.store");
        route::get("/admin/{admin}/edit", [Admin\AdminController::class, 'edit'])->name("admin.edit");
        route::put("/admin/{admin}/edit", [Admin\AdminController::class, 'update'])->name("admin.update");
        route::delete("/admin/{admin}", [Admin\AdminController::class, 'delete'])->name("admin.delete");
        route::get("/admin/create", [Admin\AdminController::class, 'create'])->name("admin.create");

        //
        route::get("/parent", [Admin\ParentController::class, 'index'])->name("parent.index");
        route::get("/parent/create", [Admin\ParentController::class, 'create'])->name("parent.create");
        route::post("/parent", [Admin\ParentController::class, 'store'])->name("parent.store");
        route::get("/parent/{parent}/edit", [Admin\ParentController::class, 'edit'])->name("parent.edit");
        route::put("/parent/{parent}/edit", [Admin\ParentController::class, 'update'])->name("parent.update");
        route::delete("/parent/{parent}",[Admin\ParentController::class, 'delete'])->name("parent.delete");

        //
        route::get("/teacher", [Admin\TeacherController::class, 'index'])->name("teacher.index");
        route::get("/teacher/create", [Admin\TeacherController::class, 'create'])->name("teacher.create");
        route::post("/teacher", [Admin\TeacherController::class, 'store'])->name("teacher.store");
        route::get("/teacher/{teacher}/edit", [Admin\TeacherController::class, 'edit'])->name("teacher.edit");
        route::put("/teacher/{teacher}/edit", [Admin\TeacherController::class, 'update'])->name("teacher.update");
        route::delete("/teacher/{teacher}",[Admin\TeacherController::class, 'delete'])->name("teacher.delete");

        // route::get("/student", [StudentController::class, 'index'])->name("student.index");
        // route::get("/student/create", [StudentController::class, 'create'])->name("student.create");
        // route::post("/student", [StudentController::class, 'store'])->name("student.store");
        // route::get("/student/{student}/edit", [StudentController::class,'edit'])->name("student.edit");
        // route::put("/student/{student}/edit",[StudentController::class, 'update'])->name("student.update");
        // route::delete("/student/{student}", [StudentController::class, 'destroy'])->name("student.destroy");

        Route::resource('student', Admin\StudentController::class);
    });

    route::prefix('teacher')->as('teacher.')->middleware(['hanya.teacher'])->group(function (){
        route::get('/', [Teacher\HomeController::class, 'index'])->name('home');
    });

    route::prefix('student')->as('student.')->middleware(['hanya.student'])->group(function (){
        route::get('/', [Student\HomeController::class, 'index'])->name('home');
    });

    route::prefix('parent')->as('parent.')->middleware(['hanya.parent'])->group(function (){
        route::get('/', [ParentNameSpace\HomeController::class, 'index'])->name('home');
    });
});


require __DIR__.'/auth.php';
