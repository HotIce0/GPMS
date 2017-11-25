<?php
//By Sao Guang

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class StudentIndexController extends Controller
{
    public function index()
    {
        return view('student.index');
    }
}