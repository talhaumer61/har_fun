<?php

namespace App\Http\Controllers\site;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class SiteSellersController extends Controller
{
    public function index($id = null){
        if ($id) {
            // Fetch single seller details
            $seller = [
                'name' => 'Seller ' . $id, 
            ];
            return view('site.sellers',compact('seller'));

        } else {
            // Fetch seller list
            return view('site.sellers');
            
        }
        
    }
}
