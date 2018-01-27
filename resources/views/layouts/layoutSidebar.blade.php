@extends('layouts.layout')
@section('notification')
    <li class="dropdown">
        <a href="#" class="dropdown-toggle icon-menu" data-toggle="dropdown">
            <i class="lnr lnr-alarm"></i>
            <span class="badge bg-danger">5</span>
        </a>
        <ul class="dropdown-menu notifications">
            <li><a href="#" class="notification-item"><span class="dot bg-warning"></span>System space is almost full</a></li>
            <li><a href="#" class="notification-item"><span class="dot bg-danger"></span>You have 9 unfinished tasks</a></li>
            <li><a href="#" class="notification-item"><span class="dot bg-success"></span>Monthly report is available</a></li>
            <li><a href="#" class="notification-item"><span class="dot bg-warning"></span>Weekly meeting in 1 hour</a></li>
            <li><a href="#" class="notification-item"><span class="dot bg-success"></span>Your request has been approved</a></li>
            <li><a href="#" class="more">See all notifications</a></li>
        </ul>
    </li>
@endsection
@section('main')
    @yield('sidebar')
    <!-- MAIN -->
    <div class="main">
        <!-- MAIN CONTENT -->
        <div class="main-content">
            {{--<div class="container-fluid">--}}

            @yield('content')
            {{--</div>--}}
        </div>
        <!-- END MAIN CONTENT -->
    </div>
    <!-- END MAIN -->
@endsection