<?php

namespace App\Http\Controllers\site;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;


class CustomerDashboardController extends Controller
{
   // Customer
    public function index(){
        return view('site.customer.dashboard');    
    }
    public function customer_profile($id = null){
    return view('site.customer.customer_profile');
    }
    public function my_jobs($id = null){
        return view('site.customer.my_jobs');
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
