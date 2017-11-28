<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = Auth::user();
        if($user->isRole('STUDENT'))
            return redirect('/student');
        elseif ($user->isRole('TEACHER'))
            return redirect('/teacher');
        elseif ($user->isRole('ADMIN'))
            return redirect('/admin');
        else
            return response()->view('errors.503');
    }
}
