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
    public function my_jobs()
    {
        $userId = session('user')->id; // Get the logged-in user ID from session
        // $jobs = DB::table('hf_jobs')->where('id_customer', $userId)->paginate(10); // Paginate results
        $my_jobs = DB::table('hf_jobs')
        ->join('hf_job_categories', 'hf_jobs.id_cat', '=', 'hf_job_categories.cat_id') // Join with categories table
        ->where('hf_jobs.id_customer', $userId) // Filter by logged-in user
        ->select('hf_jobs.*', 'hf_job_categories.cat_name') // Select all job fields + category name
        ->get();

        return view('site.customer.my_jobs', compact('my_jobs')); // Pass jobs to view
    }


    public function customer_messages(){
            return view('site.customer.customer_messages');
        
    }
    
    public function saved_sellers(){
        return view('site.customer.saved_sellers');
    }
    public function memberships(){
        return view('site.customer.memberships');
    }
}
