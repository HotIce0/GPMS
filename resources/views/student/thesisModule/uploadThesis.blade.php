@extends('layouts.layoutSidebar')

@section('sidebar')
    @include('student.sidebar')
@endsection

@section('content')

    @if (session('success'))
        <div class="alert alert-success alert-dismissible">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            {{ session('success') }}
        </div>
    @endif

    @if (count($errors) > 0)
        <div class="alert alert-danger alert-dismissible">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div style="padding: 100px 0px;text-align: center">
        <h2>上传我的论文</h2>
        <form method="post" action="{{ url('/student/uploadThesis') }} " target="_self" enctype="multipart/form-data">
            {{ csrf_field() }}
            <button type="button" class="btn btn-default" onclick="transferClick()" style="margin: 40px">
                <span class="glyphicon glyphicon-inbox" style="font-size: 100px"></span>
            </button><br>
            <p id="nameTarget">请选择文件</p>
            <input type="file" name="thesis" id="thesis" accept="application/msword,application/vnd.openxmlformats-officedocument.wordprocessingml.document" onchange="showFilename()" style="padding: 10px;display:none">
            <button type="submit" class="btn btn-default">提交</button>
        </form>
    </div>

    <script>

        function transferClick() {
            document.getElementById("thesis").click();
        }

        function showFilename() {
            var file=document.getElementById("thesis");
            var nameTarget=document.getElementById("nameTarget");
            var filename = null;
            if(file.files[0] != undefined){
                filename=file.files[0].name;
            }
            nameTarget.innerText=filename;
        }
    </script>

@endsection