@extends('layouts.master')
@section('css')
@toastr_css
    @section('title')
    إعدادات الموقع
    @stop
        @endsection
        @section('page-header')
        <!-- breadcrumb -->
        @section('PageTitle')
        إعدادات الموقع
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
                            <form action="{{ Route('settings.update') }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                @method('PUT')
                                <input type="hidden" name='id' value="{{$settings->id}}">
                                <div class="form-group">
                                    <label for="name">اسم الموقع</label>
                                    <input class="form-control" type="text" name="site_name" id="site_name" value="{{$settings->site_name}}">
                                </div>
                                <div class="form-group">
                                    <label for="image">شعار الموقع</label>
                                    <input type="file" name='image' class="form-control" accept="image/*" id="input_img">
                                <img src="{{asset('storage/'.$settings->logo)}}" alt="" width="100" id="preview_img">
                                    
                                </div>
                                <button class="btn btn-primary" type="submit">تعديل</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <!-- row closed -->
            @endsection
            @section('js')
            @toastr_js
            @toastr_render
            <script>
                $(document).ready(function(){
                     $("#input_img").change(function(){
                        var reader = new FileReader();
                        reader.onload = function()
                        {
                            $("#preview_img").attr("src", reader.result);
                        }
                        reader.readAsDataURL(event.target.files[0]);
                    });
            
                });
            </script>
                @endsection
