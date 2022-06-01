@extends('layouts.master')
@section('css')
    @toastr_css
@section('title')
    قائمة الأقسام
@stop
@endsection
@section('page-header')
<!-- breadcrumb -->
@section('PageTitle')
    قائمة الأقسام الرئيسية ل{{ $project->name }}
@stop
<!-- breadcrumb -->
@endsection
@section('content')
<!-- row -->
<div class="row">

    <div class="col-xl-12 mb-30">
        <div class="card card-statistics h-100">
            <div class="card-body">
                <a href="{{route('departments.create')}}" class="btn btn-primary mb-4">أضف قسم جديد</a>
                <div class="table-responsive">
                    <table id="datatable" class="table  table-hover table-sm table-bordered p-0" data-page-length="50"
                        style="text-align: center">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>اسم القسم</th>
                                <th>عدد الأقسام الفرعية</th>
                                <th>العمليات</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $i = 0; ?>
                            @foreach ($departments as $department)
                                <tr>
                                    <?php $i++; ?>
                                    <td>{{ $i }}</td>
                                    <td>{{ $department->name }}</td>
                                    <td>
                                        <a
                                            href="{{ route('branches', ['project' => $department->project_id, 'department' => $department]) }}">
                                            <i class="fa fa-eye"></i>
                                            {{ $department->branches_count }}
                                        </a>
                                    </td>

                                    <td class="d-flex justify-content-center">
                                        <a target="_blanck" href="{{ route('show.project', [$department->project_id, $department]) }}"
                                            class="btn btn-info btn-sm mr-3" title="عرض المشروع">عرض المشروع</a>
                                        <a href="{{ route('departments.edit', $department) }}"
                                            class="btn btn-info btn-sm mr-3" title="تعديل المشروع"><i
                                                class="fa fa-edit"></i></a>
                                        <form action="{{ route('departments.destroy', $department) }}" method="POST">
                                            @method('DELETE')
                                            @csrf
                                            <button type="submit" class="btn btn-danger btn-sm" title="حذف المشروع"><i
                                                    class="fa fa-trash"></i></button>
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
