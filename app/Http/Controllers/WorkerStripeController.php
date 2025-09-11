<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Stripe\Stripe;
use Stripe\Account;
use Stripe\AccountLink;

class WorkerStripeController extends Controller
{
    public function startOnboarding(Request $request)
    {
        $user = session('user');

        if (!$user) {
            return redirect('/login')->with('error', 'Please log in first.');
        }

        Stripe::setApiKey(config('services.stripe.secret'));

        // If worker doesn’t have a Stripe account yet, create one
        if (empty($user->stripe_account_id)) {
            $account = Account::create([
                'type' => 'express',
                'country' => 'US', // change as needed
                'email' => $user->email,
                'capabilities' => [
                    'transfers' => ['requested' => true],
                ],
            ]);

            // Save to DB
            DB::table(env('USERS'))
                ->where('id', $user->id)
                ->update(['stripe_account_id' => $account->id]);

            // Update session
            $user->stripe_account_id = $account->id;
            session(['user' => $user]);
        } else {
            $account = Account::retrieve($user->stripe_account_id);
        }

        // Generate onboarding link
        $accountLink = AccountLink::create([
            'account' => $account->id,
            'refresh_url' => route('worker.connect.refresh'),
            'return_url' => route('worker.connect.return'),
            'type' => 'account_onboarding',
        ]);

        return redirect($accountLink->url);
    }

    public function refreshOnboarding()
    {
        return redirect('/seller-profile')->with('error', 'Onboarding canceled. Please try again.');
    }

    public function returnOnboarding()
    {
        return redirect('/seller-profile')->with('msg', 'Stripe onboarding complete!');
    }
}
