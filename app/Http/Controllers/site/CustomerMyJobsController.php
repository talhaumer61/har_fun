<?php

namespace App\Http\Controllers\site;

use App\Http\Controllers\Controller;
use App\Http\Controllers\PaymentController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Stripe\Stripe;
use Stripe\Checkout\Session as CheckoutSession;


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

    public function accept(Request $request)
    {
        $request->validate([
            'job_id' => 'required|integer',
            'worker_id' => 'required|integer',
            'job_amount' => 'required|numeric',
            'proposal_id' => 'required|integer',
        ]);

        // Update job
        DB::table('hf_jobs')
            ->where('job_id', $request->job_id)
            ->update([
                'worker_id' => $request->worker_id,
                'job_amount' => $request->job_amount,
                'job_status' => '3',
                'date_modify' => now(),
            ]);

        // Create pending payment record
        $paymentId = DB::table('hf_payments')->insertGetId([
            'job_id'    => $request->job_id,
            'worker_id' => $request->worker_id,
            'client_id' => session('user')->id,
            'amount'    => $request->job_amount,
            'currency'  => 'pkr',
            'status'    => 'pending',
            'created_at'=> now(),
        ]);

        // Stripe: create checkout session
        Stripe::setApiKey(config('services.stripe.secret'));

        $checkoutSession = CheckoutSession::create([
            'payment_method_types' => ['card'],
            'line_items' => [[
                'price_data' => [
                    'currency' => 'pkr',
                    'product_data' => [
                        'name' => 'Job #' . $request->job_id,
                    ],
                    'unit_amount' => $request->job_amount * 100,
                ],
                'quantity' => 1,
            ]],
            'mode' => 'payment',
            'success_url' => route('payment.success', [
                'job_id'     => $request->job_id,
                'worker_id'  => $request->worker_id,
                'payment_id' => $paymentId,
            ]),
            'cancel_url' => route('payment.cancel', [
                'job_id' => $request->job_id,
                'payment_id' => $paymentId,
            ]),
            'metadata' => [
                'job_id'     => $request->job_id,
                'worker_id'  => $request->worker_id,
                'payment_id' => $paymentId,
            ]
        ]);

        // Save Stripe session id in payments table
        DB::table('hf_payments')
            ->where('id', $paymentId)
            ->update([
                'payment_intent_id' => $checkoutSession->id
            ]);

        return redirect($checkoutSession->url);
    }


    public function markCompletedByCustomer(Request $request, $jobId)
    {
        $userId = session('user')->id;

        // Ensure job belongs to this customer
        $job = DB::table('hf_jobs')
            ->where('job_id', $jobId)
            ->where('id_customer', $userId)
            ->first();

        if (!$job) {
            return back()->with('error', 'Job not found or not assigned to you.');
        }

        // Mark customer completion
        DB::table('hf_jobs')
            ->where('job_id', $jobId)
            ->update([
                'client_completed' => 1,
                'date_modify' => now(),
            ]);

        // Check if worker already marked completed
        $job = DB::table('hf_jobs')->where('job_id', $jobId)->first();

        if ($job->worker_completed == 1) {
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

    // public function accept(Request $request)
    // {
    //     $request->validate([
    //         'job_id' => 'required|integer',
    //         'worker_id' => 'required|integer',
    //         'job_amount' => 'required|numeric',
    //     ]);

    //     // Update the job with the selected worker and agreed amount
    //     DB::table('hf_jobs')
    //         ->where('job_id', $request->job_id)
    //         ->update([
    //             'worker_id' => $request->worker_id,
    //             'job_amount' => $request->job_amount,
    //             'job_status' => '3', // you can customize status
    //             'date_modify' => now(),
    //         ]);
    //     DB::table('hf_job_proposals')
    //         ->where('id', $request->proposal_id)
    //         ->update([
    //             'status' => '1', // you can customize status
    //             'id_modify' => session('user')->id,
    //             'date_modify' => now(),
    //         ]);

    //     return redirect()->back()->with('msg', 'Proposal accepted successfully!');
    // }


}
