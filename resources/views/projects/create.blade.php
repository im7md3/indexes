@extends('layouts.master')
@section('css')

    @section('title')
    إنشاء مشروع جديد
    @stop
        @endsection
        @section('page-header')
        <!-- breadcrumb -->
        @section('PageTitle')
        إنشاء مشروع جديد
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
                            <form action="{{ Route('projects.store') }}" method="POST">
                                @csrf
                                <div class="form-group">
                                    <label for="name">اسم المشروع</label>
                                    <input class="form-control" type="text" name="name" id="name"
                                        placeholder="أدخل اسم المشروع">
                                </div>
                                <div class="form-group">
                                    <label for="notes">ملاحظات على المشروع</label>
                                    <textarea class="form-control" type="text" name="notes" id="notes"
                                        placeholder="يمكنك هنا كتابة ملاحظات عن المشروع"></textarea>
                                </div>
                                <div class="form-group">
                                    <label for="password">كلمة سر المشروع</label>
                                    <input class="form-control" type="text" name="password" id="password"
                                        placeholder="أدخل كلمة سر المشروع">
                                </div>
                                <div class="form-group">
                                    <label for="name">حالة المشروع</label>
                                    <select name="status"  class="custom-select">
                                        <option>اختر حالة المشروع</option>
                                        <option value="منجز">منجز</option>
                                        <option value="قيد الإنجاز">قيد الإنجاز</option>
                                        <option value="مغلق">مغلق</option>
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

                @endsection
