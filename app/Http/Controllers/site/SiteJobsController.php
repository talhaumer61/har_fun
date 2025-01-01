<?php

namespace App\Http\Controllers\site;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class SiteJobsController extends Controller
{
    public function index($id = null){
        if ($id) {
            // Fetch single job details
            $job = [
                'title' => 'Job ' . $id, 
            ];
            return view('site.jobs',compact('job'));

        } else {
            // Fetch job list
            return view('site.jobs');
            
        }
        
    }
}
