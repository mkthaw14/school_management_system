<?php

namespace App\Http\Controllers;

use App\Models\Student;
use App\Models\Section;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;


class StudentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $students = Student::paginate(4);
        return view("student.index", compact("students"));
    }

    public function deletedList()
    {
        $students = Student::onlyTrashed()->paginate(4);
        return view("student.deletedList", compact("students"));
    }

    public function restore($id)
    {
        Student::onlyTrashed()->where("id", $id)->restore();
        return redirect()->route("student.index");
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $sections = Section::all();
        return view("student.create", compact("sections"));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            "name" => ["required", Rule::unique("students")->where(function($query) use ($request) {
                return $query->where("section_id", $request->section_id);
            })],
            "profile" => "required|mimes:jpeg,png",
            "nrc" => "unique:students,nrc",
            "gender" => "required",
            "date_of_birth" => "required",
            "section_id" => ["required", "numeric"]
        ]);

        //dd($request->all());

        DB::transaction(function() use ($request) {
            $student = new Student;
            $student->name = $request->name;
            $student->gender = $request->gender;
            $student->date_of_birth = $request->date_of_birth;
            $student->nrc = $request->nrc;
            $student->section_id = $request->section_id;

            $student->save();

            try
            {
                if($request->hasFile("profile"))
                {
                    //dd("Yes");
                    $file = $request->file("profile");
                    $path = Storage::path("public/uploads/students/".$student->id);
                    $fileName = $student->id.".".$file->getClientOriginalExtension();

                    if(File::exists($path))
                    {
                        Storage::deleteDirectory("public/uploads/students/".$student->id);
                    }

                    $filePath = $request->file("profile")->storeAs("uploads/students/".$student->id, $fileName, "public");

                    $student->profile = "/storage/".$filePath;
                    $student->save();
                    //dd($path);
                }
            }
            catch(Exception $e)
            {
                dd($e->getMessage());
            }

        });

        return redirect()->route("student.index");

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
        $sections = Section::all();
        return view("student.edit", compact("student", "sections"));
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
        //dd($request->all());
        $request->validate([
            "name" => ["required", Rule::unique("students")->ignore($student->id)->where(function($query) use ($request) {
                return $query->where("section_id", $request->section_id);
            })],
            "gender" => "required",
            "profile" => "mimes:jpeg,png",
            "nrc" => ["required", Rule::unique("students")->ignore($student->id)],
            "date_of_birth" => "required",
            "section_id" => "required|numeric"
        ]);

        DB::transaction(function() use ($request, $student) {

            try
            {
                if($request->hasFile("profile"))
                {
                    //dd("Yes");
                    $file = $request->file("profile");
                    $path = Storage::path("public/uploads/students/".$student->id);
                    $fileName = $student->id.".".$file->getClientOriginalExtension();

                    if(File::exists($path))
                    {
                        Storage::deleteDirectory("public/uploads/students/".$student->id);
                    }

                    $filePath = $request->file("profile")->storeAs("uploads/students/".$student->id, $fileName, "public");

                    $student->profile = "/storage/".$filePath;

                    //dd($path);
                }


                $student->name = $request->name;
                $student->gender = $request->gender;
                $student->date_of_birth = $request->date_of_birth;
                $student->nrc = $request->nrc;
                $student->section_id = $request->section_id;
                $student->save();
            }
            catch(Exception $e)
            {
                dd($e->getMessage());
            }

        });

        return redirect()->route("student.index");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Student  $student
     * @return \Illuminate\Http\Response
     */
    public function destroy(Student $student)
    {
        $student->delete();
        return redirect()->route("student.index");
    }
}
