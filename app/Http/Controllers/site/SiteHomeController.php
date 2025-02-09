<?php

namespace App\Http\Controllers\site;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class SiteHomeController extends Controller
{
    public function index(){
        return redirect('/home');
    }

    public function home(){
        return view('site.home');
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
