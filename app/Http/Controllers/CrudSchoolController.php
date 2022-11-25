<?php

namespace App\Http\Controllers;

use App\Models\CrudSchool;
use Illuminate\Http\Request;

class CrudSchoolController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // Read resources
		return view('crudschool.index', ['crud_schools'=>CrudSchool::all()]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
		return view('crudschool.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
		(new CrudSchool($request->input()))->saveOrFail();
		// Redirecting to controller actions
		return redirect()->action([CrudSchoolController::class, 'index']);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\CrudSchool  $crudSchool
     * @return \Illuminate\Http\Response
     */
    public function show(CrudSchool $crudSchool)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\CrudSchool  $crudSchool
     * @return \Illuminate\Http\Response
     */
    public function edit(CrudSchool $crudSchool)
    {
        //
		return view('crudschool.edit', ['crud_schools'=>$crudSchool]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\CrudSchool  $crudSchool
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, CrudSchool $crudSchool)
    {
        // Update input resource
		($crudSchool->fill($request->input()))->saveOrFail();
		// Redirecting to controller actions
		return redirect()->action([CrudSchoolController::class, 'index']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\CrudSchool  $crudSchool
     * @return \Illuminate\Http\Response
     */
    public function destroy(CrudSchool $crudSchool)
    {
        // Remove model
		$crudSchool->delete();
		return redirect()->action([CrudSchoolController::class, 'index']);
    }
}
