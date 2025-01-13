<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AdminDashboardController extends Controller
{
    // public function index(){
    //     return view('admin.dashboard');
    // }
    public function index()
    {
        return view('admin.'.get_logintypes(session('user')->login_type).'.dashboard');
    }
    // public function login(){
    //     return view('admin.login');
    // }
}

?>