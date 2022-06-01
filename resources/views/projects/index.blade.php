@extends('layouts.master')
@section('css')
@toastr_css
    @section('title')
    قائمة المشاريع
    @stop
        @endsection
        @section('page-header')
        <!-- breadcrumb -->
        @section('PageTitle')
        قائمة المشاريع
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
                                            <th>اسم المشروع</th>
                                            <th>كلمة سر المشروع</th>
                                            <th>تاريخ إضافة المشروع</th>
                                            <th>أقسام المشروع </th>
                                            <th>حالة المشروع</th>
                                            <th>العمليات</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php $i = 0; ?>
                                        @foreach($projects as $project)
                                            <tr>
                                                <?php $i++; ?>
                                                <td>{{ $i }}</td>
                                                <td>{{ $project->name }}</td>
                                                <td>{{ $project->password }}</td>
                                                <td>{{ $project->created_at->diffForHumans() }}</td>
                                                <td>
                                                    <a href="{{route('show_departments_by_project',$project)}}">
                                                        <i class="fa fa-eye"></i>
                                                        {{ $project->departments_count }}
                                                    </a>
                                                </td>

                                                <td>{{ $project->status }}</td>
                                                <td class="d-flex justify-content-center">
                                                    <a target="_blank" href="{{ route('project.password',$project) }}"
                                                        class="btn btn-info btn-sm mr-3" title="عرض المشروع">عرض المشروع</a>
                                                        
                                                    <a href="{{ route('projects.edit',$project) }}"
                                                        class="btn btn-info btn-sm mr-3" title="تعديل المشروع"><i
                                                            class="fa fa-edit"></i></a>
                                                    <form
                                                        action="{{ route('projects.destroy',$project) }}"
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
