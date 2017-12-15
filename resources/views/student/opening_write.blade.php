@extends('layouts.layoutSidebar')

@section('sidebar')
    @include('student.sidebar')
@endsection
@section('content')
    <form action="{{url('/student/open')}}" method="post">
        <div class="main">
            <!-- MAIN CONTENT -->
            <div class="main-content">
                <div class="container-fluid">
                    <h3 class="page-title col-md-offset-2">编写开题报告</h3>
                    <div class="row">
                        <div class="col-md-8 col-md-offset-2">
                            <div class="panel">
                                <div class="panel-body">
                                    <div class="input-group">
                                        <span class="input-group-addon">课题名称</span>
                                        <input class="form-control" type="text">
                                    </div>
                                    <br>
                                    <div class="input-group">
                                        <span class="input-group-addon">指导老师</span>
                                        <input class="form-control" type="text">
                                    </div>
                                    <br>
                                    <div class="">
                                        <h5>一：</h5>
                                        <textarea rows="10" name="one" style="resize: none" class="form-control" placeholder="综述国内外对本课题的研究动态，说明选题的依据和意义"></textarea>
                                    </div>
                                    <br>
                                    <div class="">
                                        <h5>二：</h5>
                                        <textarea rows="5" name="two" style="resize: none" class="form-control" placeholder="研究的基本内容，拟解决的问题"></textarea>
                                    </div>
                                    <br>
                                    <div class="">
                                        <h5>三：</h5>
                                        <textarea rows="5" name="three" style="resize: none" class="form-control" placeholder="研究的步骤、方法、措施及进度安排"></textarea>
                                    </div>
                                    <div class="">
                                        <h5>四：</h5>
                                        <textarea rows="5" name="four" style="resize: none" class="form-control" placeholder="主要参考文献"></textarea>
                                    </div>
                                </div>
                                <div class="panel-footer text-center">
                                    {{csrf_field()}}
                                    <input type="submit" value="提交"  class="btn btn-danger" />
                                    {{--&nbsp;&nbsp;--}}
                                    {{--<input type="submit" value="暂存"  class="btn btn-group" />--}}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
@endsection