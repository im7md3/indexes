<?php

namespace App\Http\Controllers;

use App\Models\Department;
use App\Models\File;
use App\Models\Project;
use Illuminate\Http\Request;

class DepartmentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($project)
    {
        $project=Project::findOrFail($project);
        $departments=Department::withCount(['branches'])->whereNull('parent_id')->where('project_id',$project->id)->get();
        return view('departments.index',compact('departments','project'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $projects=Project::all();
        $departments=Department::whereNull('parent_id')->get();
        return view('departments.create',compact('projects','departments'));
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
            'title'=>['nullable'],
            'description'=>['nullable'],
            'type'=>['in:0,1,2','required'],
            'isComment'=>['required']
        ],[
            'name.required'=>'يرجى إدخال اسم القسم',
            'project_id.required'=>'يرجى إختيار اسم القسم',
            'type.required'=>'يرجى إختيار نوع القسم',
            'isComment.required'=>'يرجى تحديد قابلية التعليق'
        ]);
        $depart=Department::create($request->all());
        $name_project=$depart->project->name;
        if($request->hasFile('depart_file')){
            foreach($request->file('depart_file') as $file){
                $nameFile=$file->getClientOriginalName();
                $extFile=$file->getClientOriginalExtension();
                $file=$file->storeAs('attachments/'.$name_project.'/'.$depart->name,$nameFile,'public');
                File::create([
                    'name'=>$file,
                    'department_id'=>$depart->id,
                    'ext'=>$extFile
                ]);
            }
        }
        toastr()->success('تم إضافة القسم بنجاح');
        return redirect()->route('show_departments_by_project',[$request->project_id]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Department  $department
     * @return \Illuminate\Http\Response
     */
    public function show(Department $department)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Department  $department
     * @return \Illuminate\Http\Response
     */
    public function edit(Department $department)
    {
        $department=Department::with('files')->findOrFail($department->id);
        $projects=Project::all();
        $departments=Department::whereNull('parent_id')->get();
        return view('departments.edit',compact('projects','department','departments'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Department  $department
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Department $department)
    {
        $request->validate([
            'name'=>['required','max:255'],
            'project_id'=>['required'],
            'title'=>['nullable'],
            'description'=>['nullable'],
            'type'=>['in:0,1,2','required']
        ],[
            'name.required'=>'يرجى إدخال اسم القسم',
            'project_id.required'=>'يرجى إختيار اسم القسم',
            'type.required'=>'يرجى إختيار نوع القسم',
        ]);
        $department->update($request->all());
        $name_project=$department->project->name;
        if($request->hasFile('depart_file')){
            foreach($request->file('depart_file') as $file){
                $nameFile=$file->getClientOriginalName();
                $extFile=$file->getClientOriginalExtension();
                $file=$file->storeAs('attachments/'.$name_project.'/'.$department->name,$nameFile,'public');
                File::create([
                    'name'=>$file,
                    'department_id'=>$department->id,
                    'ext'=>$extFile
                ]);
            }
        }
        toastr()->success('تم تعديل القسم بنجاح');
        return redirect()->route('show_departments_by_project',[$department->project_id]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Department  $department
     * @return \Illuminate\Http\Response
     */
    public function destroy(Department $department)
    {
        $department->delete();
        toastr()->success('تم حذف القسم بنجاح');
        return redirect()->back();
    }

    public function branches($project,$department){
         $department=Department::with(['branches'=>function($q){
            $q->withCount('branches');
        }])->findOrFail($department);
        return view('branches.branches',compact('department'));
    }
    public function subBranches($project,$department){
        $department=Department::with('branches')->withCount('branches')->findOrFail($department);
        return view('branches.subBranches',compact('department'));
    }


}
