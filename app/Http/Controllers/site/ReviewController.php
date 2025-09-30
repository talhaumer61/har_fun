<?php

namespace App\Http\Controllers\site;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ReviewController extends Controller
{
    public function store(Request $request, $jobId)
    {
        $request->validate([
            'rating' => 'required|integer|min:1|max:5',
            'review_text' => 'nullable|string|max:1000',
        ]);

        $userId = session('user')->id;

        // Get job details
        $job = DB::table('hf_jobs')
            ->where('job_id', $jobId)
            ->where('id_customer', $userId)
            ->first();

        if (!$job) {
            return back()->with('error', 'Invalid job for review.');
        }

        // Prevent duplicate review
        $existing = DB::table('hf_reviews')
            ->where('job_id', $jobId)
            ->where('customer_id', $userId)
            ->first();

        if ($existing) {
            return back()->with('error', 'You already submitted a review for this job.');
        }

        DB::table('hf_reviews')->insert([
            'job_id'      => $jobId,
            'customer_id' => $userId,
            'worker_id'   => $job->worker_id,
            'rating'      => $request->rating,
            'review_text' => $request->review_text,
            'created_at'  => now(),
            'updated_at'  => now(),
        ]);

        return back()->with('msg', 'Your review has been submitted!');
    }

}
