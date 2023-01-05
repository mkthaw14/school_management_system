<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\DashBoardController;
use App\Http\Controllers\AcademicYearController;
use App\Http\Controllers\GradeController;
use App\Http\Controllers\SectionController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\TeacherController;
use App\Http\Controllers\SubjectController;
use App\Http\Controllers\SubjectAssignmentController;
use App\Http\Controllers\TimetableController;
use App\Http\Controllers\DayController;
use App\Http\Controllers\TimeController;

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



Route::get('/', [HomeController::class, "index"]);
Route::get('/home/timetable', [HomeController::class, "timetable"])->name("home.timetable");

Route::middleware("auth")->group(function() {

    Route::get('/dashboard', [DashBoardController::class, "index"]);

    Route::get("/academic_year/deleted", [AcademicYearController::class, "deletedList"]);
    Route::put("/academic_year/{academic_year}/restore", [AcademicYearController::class, "restore"]);
    Route::resource("/academic_year", AcademicYearController::class);

    Route::get("/grade/deleted", [GradeController::class, "deletedList"]);
    Route::put("/grade/{grade}/restore", [GradeController::class, "restore"]);
    Route::resource("/grade", GradeController::class);

    Route::get("/section/deleted", [SectionController::class, "deletedList"]);
    Route::put("/section/{section}/restore", [SectionController::class, "restore"]);
    Route::resource("/section", SectionController::class);

    Route::get("/student/deleted", [StudentController::class, "deletedList"]);
    Route::put("/student/{student}/restore", [StudentController::class, "restore"]);
    Route::resource("/student", StudentController::class);

    Route::get("/teacher/deleted", [TeacherController::class, "deletedList"]);
    Route::put("/teacher/{teacher}/restore", [TeacherController::class, "restore"]);
    Route::resource("/teacher", TeacherController::class);


    Route::get("/subject_assignment/deleted", [SubjectAssignmentController::class, "deletedList"]);
    Route::put("/subject_assignment/{subject}/restore", [SubjectAssignmentController::class, "restore"]);
    Route::resource("/subject_assignment", SubjectAssignmentController::class);

    Route::get("/subject/deleted", [SubjectController::class, "deletedList"]);
    Route::put("/subject/{subject}/restore", [SubjectController::class, "restore"]);
    Route::resource("/subject", SubjectController::class);

    Route::get("/time/deleted", [TimeController::class, "deletedList"]);
    Route::put("/time/{time}/restore", [TimeController::class, "restore"]);
    Route::resource("/time", TimeController::class);

    Route::get("/day/deleted", [DayController::class, "deletedList"]);
    Route::put("/day/{day}/restore", [DayController::class, "restore"]);
    Route::resource("/day", DayController::class);


    Route::get("/timetable/list", [TimetableController::class, "list"])->name("timetable.list");
    Route::get("/timetable/deleted", [TimetableController::class, "deletedList"]);
    Route::put("/timetable/{timetable}/restore", [TimetableController::class, "restore"]);
    Route::resource("/timetable", TimetableController::class);

    Route::get("/getoveralltimetable", [TimetableController::class, "getoveralltimetable"])->name("getoveralltimetable");
    Route::get("/teacherandsection", [TimetableController::class, "getteacherandsection"])->name("getteacherandsection");
    Route::get("/gettableselection", [TimetableController::class, "gettableselection"])->name("gettableselection");
    Route::get("/getsection", [TimetableController::class, "getsection"])->name("getsection");
    Route::get("/getsubject", [TimetableController::class, "getsubject"])->name("getsubject");
    Route::get("/searchteacher", [TimetableController::class, "searchteacher"])->name("searchteacher");
    Route::get("/searchsection", [TimetableController::class, "searchsection"])->name("searchsection");
    Route::get("/getday", [TimetableController::class, "getday"])->name("getdays");
    Route::get("/gettime", [TimetableController::class, "gettime"])->name("gettimes");
    Route::post("/timetable/save", [TimetableController::class, "saveOrUpdate"])->name("timetable.save");

}); 
Auth::routes(['register' => false]);


Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
