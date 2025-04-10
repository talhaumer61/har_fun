<?php

namespace App\Http\Controllers\site;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SiteHomeController extends Controller
{
    public function index(){
        return redirect('/home');
    }

    public function home(){
        $categories = DB::table('hf_job_categories')
        ->where('cat_status', 1)
        ->where('is_deleted', 0)
        ->inRandomOrder()
        ->limit(6)
        ->get();
        
         // Fetch the latest 4 jobs
         $latest_jobs = DB::table('hf_jobs')
         ->join('hf_job_categories', 'hf_jobs.id_cat', '=', 'hf_job_categories.cat_id')
         ->join('users', 'hf_jobs.id_customer', '=', 'users.id')  // Joining with the users table
         ->where('hf_jobs.job_status', 1)
         ->where('hf_jobs.is_deleted', false)
         ->orderBy('hf_jobs.date_added', 'desc')
         ->limit(4)
         ->select('hf_jobs.*', 'hf_job_categories.*', 'users.*')  // Fetching adm_fullname from the users table
         ->get();
     
     

        // Pass both categories and latest jobs to the view
        return view('site.home', compact('categories', 'latest_jobs'));
    }
    
    public function account_settings(){
        return view('site.account_settings');
    }
    public function change_password(){
        return view('site.change_password');
    }
    
    public function contact(){
        return view('site.contact');
    }

    public function about_us(){
        return view('site.about_us');
    }
    
    public function faq(){
        return view('site.faq');
    }

    public function sign_up(){
        return view('site.customer.sign_up');
    }
    public function seller_sign_up(){
        return view('site.seller.sign_up');
    }
    
    public function sign_in(){
        return view('site.sign_in');
    }
}
