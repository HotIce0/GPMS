@extends('layouts.layoutSidebar')

@section('sidebar')
    @include('student.sidebar')
@endsection

@section('content')

    <div style="padding: 100px 0px;text-align: center">
        <h2>上传我的论文</h2>
        <form method="post" action="{{ url('/student/uploadThesis') }} " target="_self" enctype="multipart/form-data">
            {{ csrf_field() }}
            <button type="button" class="btn btn-default" onclick="transferclick()" style="margin: 40px">
                <span class="glyphicon glyphicon-inbox" style="font-size: 100px"></span>
            </button><br>
            <p id="nametarget">请选择文件</p>
            <input type="file" name="thesis" id="thesis" accept="application/msword,application/vnd.openxmlformats-officedocument.wordprocessingml.document" onchange="showfilename()" style="padding: 10px;display:none">
            <button type="submit" class="btn btn-default">提交</button>
        </form>
    </div>

    <script>

        function transferclick() {
            document.getElementById("thesis").click();
        }

        function showfilename() {
            var file=document.getElementById("thesis");
            var nametarget=document.getElementById("nametarget");
            var filename = null;
            if(file.files[0] != undefined){
                filename=file.files[0].name;
            }
            nametarget.innerText=filename;
        }
    </script>

@endsection