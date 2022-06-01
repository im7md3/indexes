@extends('layouts.master')
@section('css')
<link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.css" rel="stylesheet">

@section('title')
إنشاء قسم جديد
@stop
    @endsection
    @section('page-header')
    <!-- breadcrumb -->
    @section('PageTitle')
    إنشاء قسم جديد
    @stop
        <!-- breadcrumb -->
        @endsection
        @section('content')
        <!-- row -->
        <div class="row">
            <div class="col-md-12 mb-30">
                <div class="card card-statistics h-100">
                    <div class="card-body">
                        @if($errors->any())
                            <ul class=" alert alert-danger">
                                @foreach($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        @endif
                        <form action="{{ Route('departments.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group">
                                <label for="name">اسم القسم</label>
                                <input class="form-control" type="text" name="name" id="name"
                                    placeholder="أدخل اسم القسم">
                            </div>

                            <div class="form-group">
                                <label for="title">عنوان القسم</label>
                                <input class="form-control" type="text" name="title" id="title"
                                    placeholder="أدخل عنوان القسم">
                            </div>

                            <div class="form-group">
                                <label for="description">وصف القسم</label>
                                <textarea class=" form-control" type="text" name="description"
                                    placeholder="أدخل وصف القسم" id="summernote" ></textarea>
                            </div>
                            <div class='file file--uploading'>
                                <label for='input-file'>
                                    <i style="margin: 5px;" class="fas fa-paperclip"></i> ارفاق ملف
                                </label><br>
                                <input id='input-file' type='file' name="depart_file[]" accept="image/jpeg,image/gif,image/png,application/pdf" multiple/>
                            </div>
                    </div>
                    <div class="form-group">
                        <label for="project_id">اختر المشروع</label>
                        <select name="project_id" class="custom-select">
                            <option disabled selected>اختر المشروع</option>
                            @foreach($projects as $project)
                                <option value="{{ $project->id }}">{{ $project->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="parent_id">اختر نوع القسم</label>
                        <select name="type" id="" class="custom-select">
                            <option value="0">قسم رئيسي</option>
                            <option value="1">قسم فرعي</option>
                            <option value="2">قسم فرعي آخر</option>
                        </select>
                    </div>
                    <div class="form-group" style="display: none">
                        <label for="parent_id">اختر القسم الرئيسي</label>
                        <select name="parent_id" class="custom-select">
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="parent_id">السماح بالتعليقات</label>
                        <select name="isComment" id="" class="custom-select">
                            <option value="1">نعم</option>
                            <option value="0">لا</option>
                        </select>
                    </div>
                    <button class="btn btn-primary" type="submit">إنشاء</button>
                    </form>
                </div>
            </div>
        </div>
        </div>
        <!-- row closed -->
        @endsection
        @section('js')
        <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.js"></script>

        <script>
            $(document).ready(function () {
                $('#summernote').summernote({
                    placeholder: 'أدخل وصف القسم',
                    tabsize: 2,
                    height: 200
                });
                $('select[name="type"]').on('change', function () {
                    var depart = $(this).val();
                    if (depart == '1' || depart == '2') {
                        $('select[name="parent_id"]').parent().show()
                    } else {
                        $('select[name="parent_id"]').parent().hide()
                    }
                })
            });

        </script>

        @endsection
