@extends('layouts.layoutSidebar')

@section('sidebar')
    @include('student.sidebar')
@endsection
@section('content')
    <div class="container">
        <table class="table">
            <thead>
            <tr>
                <th>操作</th>
                <th>ID</th>
                <th>第一说明</th>
                <th>第二说明</th>
                <th>第三说明</th>
                <th>状态</th>
            </tr>
            </thead>
            <tbody>

            @foreach ($my as $mine)
                        <tr>
                            <td>
                                <a href="{{url('/open_looking')}}/{{$mine->opening_report_id}}"><button class="btn btn-link" value="">查看</button></a>
                                <a href="/"><button class="btn btn-danger" value="">删除</button></a>
                            </td>
                            <td>{{ $mine->opening_report_id }}</td>
                            <td>{{ $mine->opening_report_content1 }}</td>
                            <td>{{ $mine->opening_report_content2 }}</td>
                            <td>{{ $mine->opening_report_content3 }}</td>
                            @if($mine->opening_report_status=='未过审')
                                <td style="color: red">{{$mine->opening_report_status}}</td>
                            @elseif($mine->opening_report_status=='过审')
                                <td style="color: green">{{$mine->opening_report_status}}</td>
                            @elseif($mine->opening_report_status=='审查中')
                                <td style="color: blue">{{$mine->opening_report_status}}</td>
                            @endif
                        </tr>
            @endforeach
            </tbody>
        </table>
    </div>
    <div class="text-center">
    {{ $my->links() }}
    </div>
@endsection