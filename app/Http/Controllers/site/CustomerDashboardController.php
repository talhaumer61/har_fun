<?php

namespace App\Http\Controllers\site;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Job;
use Illuminate\Support\Facades\DB;


class CustomerDashboardController extends Controller
{
   // Customer
    public function index(){
        $jobCount = DB::table('hf_jobs')
                        ->where('id_customer', session('user')->id)
                        ->where('is_deleted', false)
                        ->count();
        return view('site.customer.dashboard', compact('jobCount'));    
    }
    public function customer_profile($id = null){
    return view('site.customer.customer_profile');
    }
    
    public function saved_sellers(){
        return view('site.customer.saved_sellers');
    }
    public function memberships(){
        return view('site.customer.memberships');
    }
}
