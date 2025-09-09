<?php

namespace App\Http\Controllers\site;

use App\Http\Controllers\Controller;
use App\Models\JobProposal;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SiteJobsController extends Controller
{
    public function index($category = null)
    {
        if ($category) {
            // Find the category by href
            $category = DB::table('hf_job_categories')
                ->where('cat_href', $category)
                ->where('is_deleted', false)
                ->where('cat_status', 1)
                ->first();

            if ($category) {
                // Fetch jobs of that category, with cat_icon
                $jobs = DB::table('hf_jobs')
                    ->join('hf_job_categories', 'hf_jobs.id_cat', '=', 'hf_job_categories.cat_id')
                    ->where('hf_jobs.id_cat', $category->cat_id)
                    ->where('hf_jobs.job_status', 2)
                    ->where('hf_jobs.is_deleted', false)
                    ->select('hf_jobs.*', 'hf_job_categories.cat_icon')
                    ->get();

                return view('site.jobs', [
                    'category' => $category,
                    'jobs' => $jobs
                ]);
            } else {
                // Invalid category href
                return redirect('/jobs');
            }
        } else {
            // All active jobs with cat_icon
            $jobs = DB::table('hf_jobs')
                ->join('hf_job_categories', 'hf_jobs.id_cat', '=', 'hf_job_categories.cat_id')
                ->where('hf_jobs.job_status', 2)
                ->where('hf_jobs.is_deleted', false)
                ->select('hf_jobs.*', 'hf_job_categories.cat_icon')
                ->get();

            return view('site.jobs', ['jobs' => $jobs]);
        }
    }

    // SINGLE JOB DETAILS
    public function show($href)
    {
        $job = DB::table('hf_jobs')
            ->join('users', 'hf_jobs.id_customer', '=', 'users.id')
            ->join('cities', 'hf_jobs.id_city', '=', 'cities.id')
            ->join('hf_job_categories', 'hf_jobs.id_cat', '=', 'hf_job_categories.cat_id')
            ->where('hf_jobs.job_href', $href)
            ->where('hf_jobs.job_status', 2)
            ->where('hf_jobs.is_deleted', false)
            ->where('users.is_deleted', false)
            ->select(
                'hf_jobs.*',
                'users.name as customer_name',
                'users.photo as customer_photo',
                'users.email as customer_email',
                'users.phone as customer_phone',
                'cities.name as city_name',
                'hf_job_categories.cat_name as category_name'
            )
            ->first();

        if (!$job) {
            abort(404); // or redirect
        }

        $workerId = session('user') ? session('user')->id : null;
        $hasApplied = false;

        if ($workerId && session('user')->login_type == 3) {
            $hasApplied = JobProposal::where('job_id', $job->job_id)
                ->where('worker_id', $workerId)
                ->where('is_deleted', false)
                ->exists();
        }

        return view('site.jobs', [
            'job' => $job,
            'hasApplied' => $hasApplied,
        ]);
    }



}

