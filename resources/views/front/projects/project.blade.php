<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.11.2/css/all.min.css">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <title>Document</title>
    @toastr_css
</head>

<body>
    <main>
        <div class="top-header">
            <div class="wrapper">
                <div class="logo"><img src="{{ asset('storage/' . $settings->logo) }}" alt="" width="100">
                </div>
                <div class="title-site">
                    <h2>{{ $settings->site_name }}</h2>
                    <div class="bars">
                        <span class="line"></span>
                        <span class="line"></span>
                        <span class="line"></span>
                        <span class="line"></span>
                    </div>
                </div>
            </div>
        </div>

        <div class="content">
            <div class="wrapper">
                <div style="max-width: 1000px;margin: auto;padding:20px">
                    <h2> {{ $branch->title }}</h2>
                    {!! $branch->description !!}
                    @if ($branch->files->count() > 0)
                        <div class="">
                            مرفقات القسم
                            <ul class="d-flex ">
                                @foreach ($branch->files as $file)
                                    <li class="ml-5">
                                        @if ($file->ext == 'pdf')
                                            <a href="#">{{ Str::afterLast($file->name, '/') }}</a> <i
                                                style="margin: 5px;" class="fas fa-paperclip"></i>
                                        @else
                                            <img src="{{ asset('storage/' . $file->name) }}" alt="" width="100">
                                        @endif
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    <div>
                        @if ($branch->comments->count() > 0)
                            @foreach ($branch->comments as $comment)
                                <div class="commented d-flex justify-content-between flex-wrap pr-3 mt-4">
                                    <div class="d-flex justify-content-between align-items-start">
                                        <img style="width: 50px;border-radius: 50%;height: 50px;"
                                            src="https://sothis.es/wp-content/plugins/all-in-one-seo-pack/images/default-user-image.png"
                                            alt="">
                                        <div class="mr-3">
                                            <div class="client-info mb-1">
                                                <span class="name font-weight-bold">{{ $comment->name }}</span>
                                            </div>
                                            <div>
                                                <p>{{ $comment->content }}</p>
                                            </div>
                                            @if ($comment->file)
                                                @if ($comment->file_ext == 'pdf')
                                                    <a href="#">{{ Str::afterLast($comment->file, '/') }}</a> <i
                                                        style="margin: 5px;" class="fas fa-paperclip"></i>
                                                @else
                                                    <img src="{{ asset('storage/' . $comment->file) }}" alt=""
                                                        width="100">
                                                @endif
                                            @endif
                                        </div>
                                    </div>
                                    <div>
                                        <span class="text-muted"> {{ $comment->created_at->diffForHumans() }}
                                        </span>
                                    </div>
                                </div>
                            @endforeach
                        @else
                            <div class="commented d-flex justify-content-between flex-wrap pr-3 mt-4">
                                لا يوجد أي تعليقات لهذا الفرع
                            </div>
                        @endif

                    </div>
                </div>

                @if ($branch->isComment)
                    
                <div class="form">
                    <form action="{{ route('comments.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" name="name_project" value="{{ $branch->project->name }}">
                        <input type="hidden" name="name_branch" value="{{ $branch->name }}">
                        <input type="hidden" name="department_id" value="{{ $branch->id }}">
                        <input type="text" name="name" id="" placeholder="أدحل اسمك" required>
                        <textarea name="content" id="" cols="30" rows="10" placeholder="ضع رسالتك" required></textarea>
                        <div>
                            <div class='file file--uploading'>
                                <label for='input-file'>
                                    <i style="margin: 5px;" class="fas fa-paperclip"></i> ارفاق ملف
                                </label>
                                <input id='input-file' type='file' name="comment_file"
                                    accept="image/jpeg,image/gif,image/png,application/pdf" />
                            </div>
                        </div>
                        <button style="display: inline-block;max-width: 200px;margin: 0;" type="submit">ارسال</button>

                    </form>
                </div>
                @endif

            </div>

        </div>
    </main>

    <div class="sidebare">
        <h4>{{ $branch->project->name }}</h4>
        <ul>
            @foreach ($branch->project->departments as $department)
                <li>
                    @if ($department->branches()->count() > 0)
                <li><i class="fab fa-plus 1">+</i> <span style="font-weight:bold">{{ $department->name }}</span>
                </li>
            @else
                <li><a style="color:#00f"
                        href="{{ route('show.project', ['project' => $branch->project->id, 'department' => $department]) }}">{{ $department->name }}</a>
                </li>
            @endif
            <ul class="submenu">
                @foreach ($department->branches as $branch)
                    <li><a style="color:#fff"
                            href="{{ route('show.project', ['project' => $branch->project,'department' => $branch->department,'branch' => $branch]) }}">{{ $branch->name }}</a>
                    </li>
                    <ul class="submenu">
                        @foreach ($branch->subBranches as $sub)
                            <li><a style="color:#fff"
                                    href="{{ route('show.project', ['project' => $sub->project, 'department' => $sub->department, 'branch' => $sub]) }}">{{ $sub->name }}</a>
                            </li>
                        @endforeach
                    </ul>
                @endforeach

            </ul>
            @endforeach


            </li>
        </ul>
    </div>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="{{ asset('js/main.js') }}"></script>
    @toastr_js
    @toastr_render
</body>

</html>
