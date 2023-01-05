<?php

namespace App\Http\Controllers;

use App\Models\Teacher;
use App\Models\Grade;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;

class TeacherController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $teachers = Teacher::orderBy("id", "desc")->paginate(4);
        return view("teacher.index", compact("teachers"));
    }

    public function deletedList()
    {
        $teachers = Teacher::onlyTrashed()->paginate(4);
        return view("teacher.deletedList", compact("teachers"));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $grades = Grade::all();
        return view("teacher.create", compact("grades"));
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
            "name" => "required",
            "profile" => "required|mimes:jpeg,png",
            "email" => "required|unique:teachers,email",
            "phone" => "required|size:8",
            "gender" => "required",
            "date_of_birth" => "required",
            "education" => "required",
        ]);

        //dd($request->all());
        DB::transaction(function() use($request) {
            $teacher = new Teacher;
            $teacher->name = $request->name;
            $teacher->email = $request->email;
            $teacher->gender = $request->gender;
            $teacher->phone = $request->phone;
            $teacher->date_of_birth = $request->date_of_birth;
            $teacher->education = $request->education;

            $teacher->save();

            $teacher->grades()->attach($request->grades);

            if($request->hasFile("profile"))
            {
                try
                {
                    if($request->hasFile("profile"))
                    {
                        //dd("Yes");
                        $file = $request->file("profile");
                        $path = Storage::path("public/uploads/teachers/".$teacher->id);
                        $fileName = $teacher->id.".".$file->getClientOriginalExtension();

                        if(File::exists($path))
                        {
                            Storage::deleteDirectory("public/uploads/teachers/".$teacher->id);
                        }

                        $filePath = $request->file("profile")->storeAs("uploads/teachers/".$teacher->id, $fileName, "public");

                        $teacher->profile = "/storage/".$filePath;
                        $teacher->save();
                        //dd($path);
                    }
                }
                catch(Exception $e)
                {
                    dd($e->getMessage());
                }
            }
        });



        return redirect()->route("teacher.index");
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Teacher  $teacher
     * @return \Illuminate\Http\Response
     */
    public function show(Teacher $teacher)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Teacher  $teacher
     * @return \Illuminate\Http\Response
     */
    public function edit(Teacher $teacher)
    {
        $grades = Grade::all();
        return view("teacher.edit", ["teacher" => $teacher, "grades" => $grades]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Teacher  $teacher
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Teacher $teacher)
    {
        $request->validate([
            "name" => "required",
            "profile" => "mimes:jpeg,png",
            "email" => ["required", Rule::unique("teachers")->ignore($teacher->id)],
            "gender" => "required",
            "phone" => "required|size:8",
            "date_of_birth" => "required",
            "education" => "required",
        ]);

        DB::transaction(function() use ($request, $teacher) {

            if($request->hasFile("profile"))
            {
                try
                {
                    if($request->hasFile("profile"))
                    {
                        //dd("Yes");
                        $file = $request->file("profile");
                        $path = Storage::path("public/uploads/teachers/".$teacher->id);
                        $fileName = $teacher->id.".".$file->getClientOriginalExtension();

                        if(File::exists($path))
                        {
                            Storage::deleteDirectory("public/uploads/teachers/".$teacher->id);
                        }

                        $filePath = $request->file("profile")->storeAs("uploads/teachers/".$teacher->id, $fileName, "public");

                        $teacher->profile = "/storage/".$filePath;

                        //dd($path);
                    }
                }
                catch(Exception $e)
                {
                    dd($e->getMessage());
                }
            }

            $teacher->name = $request->name;
            $teacher->email = $request->email;
            $teacher->gender = $request->gender;
            $teacher->phone = $request->phone;
            $teacher->date_of_birth = $request->date_of_birth;
            $teacher->education = $request->education;

            $teacher->save();

            $teacher->grades()->sync($request->grades);
        });


        return redirect()->route("teacher.index");
    }

    public function restore($id)
    {
        Teacher::onlyTrashed()->where("id", $id)->restore();
        return redirect()->route("teacher.index");
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Teacher  $teacher
     * @return \Illuminate\Http\Response
     */
    public function destroy(Teacher $teacher)
    {
        $teacher->delete();
        return redirect()->route("teacher.index");
    }
}
