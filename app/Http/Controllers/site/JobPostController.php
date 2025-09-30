<?php

namespace App\Http\Controllers\site;

use App\Http\Controllers\Controller;
use App\Models\Job;
use App\Models\JobCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class JobPostController extends Controller
{
    public function index(){
        // Fetch all job categories with cat_id and cat_name
        $categories = JobCategory::where('is_deleted', 0)
                                    ->where('cat_status', 1)
                                    ->select('cat_id', 'cat_name')
                                    ->get();
        // Fetch all cities with id and name
        $cities = DB::table('cities')->select('id', 'name')->orderBy('name', 'asc')->get();
        // Pass categories to the view
        return view('site.customer.post_job', compact('categories', 'cities'));
    }
    public function postJob(Request $request)
    {
        $request->validate([
            'job_title' => 'required|string|max:255',
            'id_cat' => 'nullable|integer',
            'id_city' => 'nullable|integer',
            'job_budget' => 'required|string',
            'job_overview' => 'required|string',
            'job_desc' => 'string',
            'job_photo' => 'nullable|file|mimes:pdf,doc,docx,jpg,jpeg,png|max:2048',
            'job_location' => 'required|string'
        ]);

        $user = session('user');
        if (!$user) {
            return redirect()->back()->with('error', 'User not logged in');
        }

        $filePath = null;
        if ($request->hasFile('job_photo')) {
            $file = $request->file('job_photo');
            $filename = $request->job_title . '-' . time() . '.' . $file->getClientOriginalExtension();
            $destinationPath = public_path('uploads/jobs');
            $file->move($destinationPath, $filename);
            $filePath = 'uploads/jobs/' . $filename;
        }

        $job = new Job();
        $job->id_customer = $user->id;
        $job->job_title = $request->job_title;
        $job->job_href = Str::random(16);
        $job->id_city = $request->id_city;
        $job->id_cat = $request->id_cat;
        $job->job_budget = $request->job_budget;
        $job->job_overview = $request->job_overview;
        $job->job_desc = $request->job_desc;
        $job->job_photo = $filePath;
        $job->job_location = $request->job_location;
        $job->id_added = $user->id; // Storing user ID in id_added column
        $job->date_added = now(); // Storing the current timestamp
        $job->save();

        // return redirect()->back()->with('success', 'Job posted successfully!');
        return redirect('/my-jobs');
    }
}
