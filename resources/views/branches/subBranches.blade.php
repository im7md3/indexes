@extends('layouts.master')
@section('css')
    @toastr_css
@section('title')
قائمة الأقسام الفرعية
@stop
@endsection
@section('page-header')
<!-- breadcrumb -->
@section('PageTitle')
قائمة الأقسام الفرعية للقسم الفرعي {{$department->name}}
@stop
<!-- breadcrumb -->
@endsection
@section('content')
<!-- row -->
<div class="row">

    <div class="col-xl-12 mb-30">
        <div class="card card-statistics h-100">
            <div class="card-body">

                <div class="table-responsive">
                    <table id="datatable" class="table  table-hover table-sm table-bordered p-0"
                        data-page-length="50" style="text-align: center">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>اسم القسم</th>
                                <th>العمليات</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $i = 0; ?>
                            @foreach($department->branches as $branch)
                                <tr>
                                    <?php $i++; ?>
                                    <td>{{ $i }}</td>
                                    <td>{{ $branch->name }}</td>

                                    <td class="d-flex justify-content-center">
                                        <a target="_blank" href="{{ route('show.project',[$branch->project_id,$department,$branch]) }}"
                                            class="btn btn-info btn-sm mr-3" title="عرض المشروع">عرض المشروع</a>
                                        <a href="{{ route('departments.edit',$branch) }}"
                                            class="btn btn-info btn-sm mr-3" title="تعديل المشروع"><i
                                                class="fa fa-edit"></i></a>
                                        <form
                                            action="{{ route('departments.destroy',$branch) }}"
                                            method="POST">
                                            @method('DELETE')
                                            @csrf
                                            <button type="submit" class="btn btn-danger btn-sm"
                                                title="حذف المشروع"><i class="fa fa-trash"></i></button>
                                        </form>

                                    </td>
                                </tr>

                            @endforeach
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- row closed -->
@endsection
@section('js')
@toastr_js
@toastr_render


@endsection
