<?php

namespace App\Http\Controllers\site;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


class CustomerMyJobsController extends Controller
{
    
    public function index($action = null, $href = null) 
    {
        $userId = session('user')->id;

        $my_jobs = DB::table('hf_jobs')
            ->join('hf_job_categories', 'hf_jobs.id_cat', '=', 'hf_job_categories.cat_id')
            ->leftJoin(DB::raw('(SELECT job_id, COUNT(*) as proposal_count 
                                FROM hf_job_proposals 
                                WHERE status = 2 AND is_deleted = 0 
                                GROUP BY job_id) as proposals'),
                    'hf_jobs.job_id', '=', 'proposals.job_id')
            ->where('hf_jobs.id_customer', $userId)
            ->where('hf_jobs.is_deleted', 0)
            ->select(
                'hf_jobs.*',
                'hf_job_categories.cat_name',
                DB::raw('COALESCE(proposals.proposal_count, 0) as pending_proposals')
            )
            ->get();

        $job_proposals = [];

        if ($action === 'proposals' && $href) {
            $job = DB::table('hf_jobs')
                ->where('job_href', $href)
                ->where('id_customer', $userId)
                ->where('is_deleted', 0)
                ->first();

            if ($job) {
                $job_proposals = DB::table('hf_job_proposals as p')
                    ->join('users as u', 'p.worker_id', '=', 'u.id')
                    ->where('p.job_id', $job->job_id)
                    ->where('p.status', 2)
                    ->where('p.is_deleted', 0)
                    ->select('p.*', 'u.name', 'u.email') // Add other fields as needed
                    ->get();
            }
        }

        return view('site.customer.my_jobs', compact('my_jobs', 'action', 'href', 'job_proposals'));
    }



}
