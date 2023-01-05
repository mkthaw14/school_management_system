<?php

namespace App\Http\Controllers;
use App\Models\Day;
use Illuminate\Http\Request;

class DayController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $days = Day::paginate(3);
        return view("day.index", compact("days"));
    }

    public function deletedList()
    {
        $days = Day::onlyTrashed()->paginate(3);
        return view("day.deletedList", compact("days"));
    }

    public function restore($id)
    {
        Day::onlyTrashed()->where("id", $id)->restore();
        return redirect()->route("day.index");
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view("day.create");
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $day = new Day;
        $day->name = $request->name;
        $day->save();
        return redirect()->route("day.index");
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $day = Day::find($id);
        return view("day.edit", compact("day"));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $day = Day::find($id);
        $day->name = $request->name;
        $day->save();
        return redirect()->route("day.index");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $day = Day::find($id);
        $day->delete();
        return redirect()->route("day.index");
    }
}
