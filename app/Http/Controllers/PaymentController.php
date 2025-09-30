<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PaymentController extends Controller
{
    public function success(Request $request)
    {
        $jobId     = $request->job_id;
        $workerId  = $request->worker_id;
        $paymentId = $request->payment_id;

        // Update job as paid
        DB::table('hf_jobs')
            ->where('job_id', $jobId)
            ->update([
                'payment_status' => 'paid',
                'date_modify' => now(),
            ]);
        
        DB::table('hf_job_proposals')
            ->where('job_id', $jobId)
            ->where('worker_id', $workerId)
            ->update([
                'status' => '1',
                'date_modify' => now(),
            ]);

        // Update payment record
        DB::table('hf_payments')
            ->where('id', $paymentId)
            ->update([
                'status' => 'paid',
                'updated_at' => now(),
            ]);

        return redirect('/my-jobs')->with('msg', 'Payment successful, funds held in escrow!');
    }

    public function cancel(Request $request)
    {
        $jobId     = $request->job_id;
        $paymentId = $request->payment_id;

        // Update payment record
        DB::table('hf_payments')
            ->where('id', $paymentId)
            ->update([
                'status' => 'pending',
                'updated_at' => now(),
            ]);

        // Optionally update job
        DB::table('hf_jobs')
            ->where('job_id', $jobId)
            ->update([
                'job_status' => '2',
                'date_modify' => now(),
            ]);

        return redirect('/my-jobs')->with('error', 'Payment canceled.');
    }

    public function releasePayment($jobId)
    {
        $job = DB::table('hf_jobs')->where('job_id', $jobId)->first();

        if (!$job || $job->payment_status !== 'paid') {
            return false;
        }

        $worker = DB::table(env('USERS'))->where('id', $job->worker_id)->first();

        if (!$worker || empty($worker->stripe_account_id)) {
            return false;
        }

        $commissionRate = 0.10;
        $conversionRate = 0.0036; // PKR -> USD

        // ----- Original job amount in PKR -----
        $jobAmountPKR = $job->job_amount;

        // ----- Convert to USD for Stripe -----
        $jobAmountUSD = $jobAmountPKR * $conversionRate;
        $commissionUSD = $jobAmountUSD * $commissionRate;
        $payoutAmountUSD = $jobAmountUSD - $commissionUSD;
        $payoutAmountUSD = $payoutAmountUSD + 30;

        // Convert to cents for Stripe transfer
        $payoutAmountCents = intval(round($payoutAmountUSD * 100));

        \Stripe\Stripe::setApiKey(config('services.stripe.secret'));

        \Stripe\Transfer::create([
            'amount' => $payoutAmountCents,
            'currency' => 'usd',
            'destination' => $worker->stripe_account_id,
            'transfer_group' => 'JOB_' . $job->job_id,
        ]);

        // ----- Convert commission & payout back to PKR for DB -----
        $commissionPKR   = $commissionUSD / $conversionRate;
        // $workerAmountPKR = $payoutAmountUSD / $conversionRate;
        $workerAmountPKR = $jobAmountPKR - $commissionPKR;

        // Update DB payments table
        DB::table('hf_payments')->insert([
            'job_id'        => $jobId,
            'worker_id'     => $job->worker_id,
            'client_id'     => $job->id_customer,
            'amount'        => $jobAmountPKR,     // original job amount in PKR
            'commission'    => round($commissionPKR, 2),
            'worker_amount' => round($workerAmountPKR, 2),
            'status'        => 'released',
            'created_at'    => now(),
        ]);

        DB::table('hf_jobs')
            ->where('job_id', $jobId)
            ->update(['payment_status' => 'released']);

        return true;
    }



}
