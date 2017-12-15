@extends('layouts.layoutSidebar')

@section('sidebar')
    @include('admin.sidebar')
@endsection

@section('content')
    <!-- MAIN -->
    <div class="main">
        <!-- MAIN CONTENT -->
        <div class="main-content">
            <div class="container-fluid">
                <h3 class="page-title col-md-offset-2">开题报告汇总表</h3>
                <div class="row">
                    <div class="col-md-8 col-md-offset-2">
                        <!-- BASIC TABLE -->
                        <div class="panel">
                            <div class="panel-heading">

                            </div>
                            <div class="panel-body">
                                <table class="table">
                                    <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>First Name</th>
                                        <th>Last Name</th>
                                        <th>Username</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <tr>
                                        <td>1</td>
                                        <td>Steve</td>
                                        <td>Jobs</td>
                                        <td>@steve</td>
                                    </tr>
                                    <tr>
                                        <td>2</td>
                                        <td>Simon</td>
                                        <td>Philips</td>
                                        <td>@simon</td>
                                    </tr>
                                    <tr>
                                        <td>3</td>
                                        <td>Jane</td>
                                        <td>Doe</td>
                                        <td>@jane</td>
                                    </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <!-- END BASIC TABLE -->
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

