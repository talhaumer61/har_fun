<?php

namespace App\Http\Controllers\site;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

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
    public function seller_messages(){
            return view('site.seller.seller_messages');
        
    }
    public function job_alerts(){
            return view('site.seller.job_alerts');
        
    }
    public function saved_jobs(){
            return view('site.seller.saved_jobs');
        
    }

    
}
