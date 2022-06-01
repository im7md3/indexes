@extends('layouts.master')
@section('css')
    <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.css" rel="stylesheet">

@section('title')
    تعديل قسم
@stop
@endsection
@section('page-header')
<!-- breadcrumb -->
@section('PageTitle')
    تعديل قسم
@stop
<!-- breadcrumb -->
@endsection
@section('content')
<!-- row -->
<div class="row">
    <div class="col-md-12 mb-30">
        <div class="card card-statistics h-100">
            <div class="card-body">
                @if ($errors->any())
                    <ul class=" alert alert-danger">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                @endif
                <form action="{{ Route('departments.update', $department) }}" method="POST"
                    enctype="multipart/form-data">
                    @method('PUT')
                    @csrf
                    <div class="form-group">
                        <label for="name">اسم القسم</label>
                        <input class="form-control" type="text" name="name" id="name" placeholder="أدخل اسم المشروع"
                            value="{{ $department->name }}">
                    </div>
                    <div class="form-group">
                        <label for="title">عنوان القسم</label>
                        <input class="form-control" type="text" name="title" id="title" placeholder="أدخل عنوان القسم"
                            value="{{ $department->title }}">
                    </div>

                    <div class="form-group">
                        <label for="description">وصف القسم</label>
                        <textarea class="form-control" type="text" name="description" placeholder="أدخل وصف القسم"
                            id="summernote">{{ $department->description }}</textarea>
                    </div>
                    <div class='file file--uploading'>
                        <label for='input-file'>
                            <i style="margin: 5px;" class="fas fa-paperclip"></i> ارفاق ملف
                        </label><br>
                        <input id='input-file' type='file' name="depart_file[]"
                            accept="image/jpeg,image/gif,image/png,application/pdf" multiple />
                    </div>

                    <div class="form-group">
                        <label for="name">اختر المشروع</label>
                        <select name="project_id" class="custom-select">
                            <option>اختر حالة المشروع</option>
                            @foreach ($projects as $project)
                                <option value="{{ $project->id }}"
                                    {{ $project->id == $department->project_id ? 'selected' : '' }}>
                                    {{ $project->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="parent_id">اختر نوع القسم</label>
                        <select name="type" id="" class="custom-select">
                            <option value="0">قسم رئيسي</option>
                            <option value="1" {{ $department->type == '1' ? 'selected' : '' }}>قسم فرعي</option>
                            <option value="2" {{ $department->type == '2' ? 'selected' : '' }}>قسم فرعي آخر</option>
                        </select>
                    </div>
                    <div class="form-group"
                        style="{{ $department->parent_id ? 'display: block' : 'display: none' }}">
                        <label for="parent_id">اختر القسم الرئيسي</label>
                        <select name="parent_id" class="custom-select">
                            <option disabled selected>اختر القسم الرئيسي</option>
                            @foreach ($departments as $ddeparment)
                                <option value="{{ $ddeparment->id }}"
                                    {{ $ddeparment->id == $department->parent_id ? 'selected' : '' }}>
                                    {{ $ddeparment->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="parent_id">السماح بالتعليقات</label>
                        <select name="isComment" id="" class="custom-select">
                            <option value="1" {{$department->isComment==1?'selected':''}}>نعم</option>
                            <option value="0" {{$department->isComment==0?'selected':''}}>لا</option>
                        </select>
                    </div>
                    <button class="btn btn-primary" type="submit">تعديل</button>
                </form>
            </div>
            <div>
                مرفقات القسم
                @if ($department->files->count() > 0)

                    <ul class="d-flex list-unstyled ">
                        @foreach ($department->files as $file)
                            <li class="p-3 ml-3">
                                @if ($file->ext == 'pdf')
                                    <a href="#">{{ Str::afterLast($file->name, '/') }}</a> <i style="margin: 5px;"
                                        class="fas fa-paperclip"></i>
                                @else
                                    <img src="{{ asset('storage/' . $file->name) }}" alt="" width="100">
                                @endif
                                <button type="button " class="btn btn-danger btn-sm d-block" data-toggle="modal"
                                    data-target="#delete{{ $file->id }}">
                                    <i class="fa fa-trash">
                                    </i>
                                </button>
                            </li>

                            <!-- delete_modal_file-->
                            <div class="modal fade" id="delete{{ $file->id }}" tabindex="-1" role="dialog"
                                aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 style="font-family: 'Cairo', sans-serif;" class="modal-title"
                                                id="exampleModalLabel">
                                                هل تريد حذف المرفق؟
                                            </h5>
                                            <button type="button" class="close" data-dismiss="modal"
                                                aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <form action="{{ route('files.destroy', $file) }}" method="post">
                                                @method('DELETE')
                                                @csrf

                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary"
                                                        data-dismiss="modal">إغلاق</button>
                                                    <button type="submit" class="btn btn-danger">تأكيد</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </ul>
                @else
                    <p>لا يوجد مرفقات لهذا القسم</p>
                @endif

            </div>
        </div>
    </div>
</div>


<!-- row closed -->
@endsection
@section('js')
<script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.js"></script>

<script>
    $(document).ready(function() {
        $('#summernote').summernote({
            placeholder: 'أدخل وصف القسم',
            tabsize: 2,
            height: 200,
        });

        $('select[name="type"]').on('change', function() {
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
