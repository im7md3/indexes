<?php

namespace App\Http\Controllers;

use App\Models\Branch;
use App\Models\Department;
use App\Models\Project;
use Illuminate\Http\Request;

class BranchController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $projects=Project::with(['departments.branches'])->get();
        return view('branches.index',compact('projects'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $projects=Project::all();
        $departments=Department::all();
        return view('branches.create',compact('projects','departments'));
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
            'name'=>['required','max:255'],
            'project_id'=>['required'],
            'department_id'=>['required'],
            'title'=>['required','max:255'],
            'description'=>['required'],
        ],[
            'name.required'=>'يرجى إدخال اسم الفرع',
            'title.required'=>'يرجى إدخال عنوان الفرع',
            'description.required'=>'يرجى إدخال وصف الفرع',
            'project_id.required'=>'يرجى إختيار اسم المشروع',
            'department_id.required'=>'يرجى إختيار اسم القسم',
        ]);
        Branch::create($request->all());
        return redirect()->back();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Branch  $branch
     * @return \Illuminate\Http\Response
     */
    public function show(Branch $branch)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Branch  $branch
     * @return \Illuminate\Http\Response
     */
    public function edit(Branch $branch)
    {
        $projects=Project::all();
        $departments=Department::where('project_id',$branch->project_id)->get();
        return view('branches.edit',compact('projects','departments','branch'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Branch  $branch
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Branch $branch)
    {

        $request->validate([
            'name'=>['required','max:255'],
            'project_id'=>['required'],
            'department_id'=>['required'],
            'title'=>['required','max:255'],
            'description'=>['required'],
        ],[
            'name.required'=>'يرجى إدخال اسم الفرع',
            'title.required'=>'يرجى إدخال عنوان الفرع',
            'description.required'=>'يرجى إدخال وصف الفرع',
            'project_id.required'=>'يرجى إختيار اسم المشروع',
            'department_id.required'=>'يرجى إختيار اسم القسم',
        ]);
        $branch->update($request->all());
        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Branch  $branch
     * @return \Illuminate\Http\Response
     */
    public function destroy(Branch $branch)
    {
        $branch->delete();
        return redirect()->back();
    }
}
