<?php
//By Sao Guang

namespace App\Http\Controllers\Teacher;

use App\Http\Controllers\Controller;
use App\Http\Models\Role;
use App\Http\Models\UserBasicInfo;
use Illuminate\Support\Facades\Auth;

class ProjectChecklistController extends Controller
{
    public function index()
    {
//        if(!Auth::user()->hasPermission('1.1'))
//            return response()->view('errors.503');
        dd(Auth::user()->hasPermission('1.1'));
    }
}