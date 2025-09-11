<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SellerJobController extends Controller
{
    public function markCompleted(Request $request, $jobId)
    {
        $userId = session('user')->id;

        // Ensure job belongs to this worker
        $job = DB::table('hf_jobs')
            ->where('job_id', $jobId)
            ->where('worker_id', $userId)
            ->first();

        if (!$job) {
            return back()->with('error', 'Job not found or not assigned to you.');
        }

        // Mark worker completion
        DB::table('hf_jobs')
            ->where('job_id', $jobId)
            ->update([
                'worker_completed' => 1,
                'date_modify' => now(),
            ]);

        // Check if client already marked completed
        $job = DB::table('hf_jobs')->where('job_id', $jobId)->first();

        if ($job->client_completed == 1) {
            // ✅ Both sides done → mark job completed + trigger payment release
            DB::table('hf_jobs')
                ->where('job_id', $jobId)
                ->update([
                    'job_status' => 1, // completed
                    'date_modify' => now(),
                ]);

            // 🔹 Payment release logic (to Stripe)
            app(PaymentController::class)->releasePayment($jobId);
        }

        return back()->with('msg', 'Job marked as completed from your side!');
    }
}
