<?php

namespace App\Http\Controllers\site;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SellerDashboardController extends Controller
{
        public function index(){
                return view('site.seller.dashboard');    
        }
        public function seller_profile($id = null){
                return view('site.seller.seller_profile');
                
        }
        public function my_resume($id = null){
                return view('site.seller.my_resume');
                
        }
        
        public function job_alerts(){
                return view('site.seller.job_alerts');
                
        }
        public function ongoing_jobs()
        {
        $userId = session('user')->id;

        // Fetch all jobs assigned to this worker with status "in progress" (3 for example)
        $jobs = DB::table('hf_jobs')
                ->where('worker_id', $userId)
                ->where('job_status', 3) // ongoing
                ->get();

        return view('site.seller.ongoing_jobs', compact('jobs'));
        }


    
}
