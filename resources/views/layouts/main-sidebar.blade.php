<div class="container-fluid">
    <div class="row">
        <!-- Left Sidebar start-->
        <div class="side-menu-fixed">


            <div class="scrollbar side-menu-bg" style="overflow: scroll">
                <ul class="nav navbar-nav side-menu" id="sidebarnav">
                    <!-- الرئيسية-->
                    <li>
                        <a href="{{ route('projects.index') }}">
                            <div class="pull-left"><i class="ti-home"></i><span class="right-nav-text">الرئيسية</span>
                            </div>
                            <div class="clearfix"></div>
                        </a>
                    </li>
                    <!-- المشاريع-->
                            <li class="d-flex align-items-center"><a href="{{route('projects.index')}}">قائمة المشاريع </a><span class="ml-5 text-white">{{\App\Models\Project::count()}}</span></li>
                            <li><a href="{{route('projects.create')}}">أضف مشروع جديد</a></li>
                            <li><a href="{{route('departments.create')}}">أضف قسم جديد</a></li>
                            <li><a href="{{route('settings.index')}}">الإعدادات</a></li>
                    

                </ul>
            </div>

        </div>

        <!-- Left Sidebar End-->

        <!--=================================
