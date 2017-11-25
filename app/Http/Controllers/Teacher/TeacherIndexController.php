<?php
//By Sao Guang

namespace App\Http\Controllers\Teacher;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class TeacherIndexController extends Controller
{
    public function index()
    {
        return view('teacher.index');
    }
}