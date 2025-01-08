<?php

namespace App\Http\Controllers\site;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class SiteDashboardController extends Controller
{
    public function index($type = null){
        // Check whether user is customer or seller
        if ($type) {
            $admin = [
                'type' => $type, 
            ];
            return view('site.dashboard',compact('admin'));

        } else {
            return redirect('/home');
            
        }
        
    }
    public function seller_profile($id = null){
            return view('site.seller_profile');
        
    }
    public function my_resume($id = null){
            return view('site.my_resume');
        
    }
    public function seller_messages(){
            return view('site.seller_messages');
        
    }
    public function job_alerts(){
            return view('site.job_alerts');
        
    }
    public function saved_jobs(){
            return view('site.saved_jobs');
        
    }

    // Customer
    public function customer_profile($id = null){
        return view('site.customer_profile');
    }
    public function my_jobs($id = null){
        return view('site.my_jobs');
    }
    public function customer_messages(){
            return view('site.customer_messages');
        
    }
    public function post_job(){
            return view('site.post_job');
        
    }
    public function saved_sellers(){
        return view('site.saved_sellers');
    }
    public function memberships(){
        return view('site.memberships');
    }
}
