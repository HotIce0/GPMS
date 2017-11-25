<?php
//By Sao Guang

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class AdminIndexController extends Controller
{
    public function index()
    {
        return view('admin.index');
    }
}