<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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
            'department_id'=>['required'],
            'content'=>['required'],
            'file'=>['nullable'],
            'file_ext'=>['nullable'],
        ],[
            'name.required'=>'يرجى إدخال اسمك',
            'content.required'=>'يرجى إدخال وصف الفرع',
        ]);
        $file=null;
        $file_ext=null;
        if($request->hasFile('comment_file')){
            
            $nameFile=$request->file('comment_file')->getClientOriginalName();
            $file_ext=$request->file('comment_file')->getClientOriginalExtension();
            $file=$request->file('comment_file')->storeAs('attachments/',$request->name_project.'/'.$request->name_branch.'/'.$nameFile,'public');
        }
        $request->merge([
            'file'=>$file,
            'file_ext'=>$file_ext
        ]);
        Comment::create($request->all());
        toastr()->success('تم إضافة التعليق بنجاح');
        return redirect()->back();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Comment  $comment
     * @return \Illuminate\Http\Response
     */
    public function show(Comment $comment)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Comment  $comment
     * @return \Illuminate\Http\Response
     */
    public function edit(Comment $comment)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Comment  $comment
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Comment $comment)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Comment  $comment
     * @return \Illuminate\Http\Response
     */
    public function destroy(Comment $comment)
    {
        //
    }
}
