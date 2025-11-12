<?php

namespace App\Http\Controllers\site;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SiteSellersController extends Controller
{
    // public function index($category = null)
    // {
    //     $sellers = DB::table('users')
    //         ->leftJoin('worker_profiles', 'users.id', '=', 'worker_profiles.user_id')
    //         ->leftJoin('cities', 'worker_profiles.city_id', '=', 'cities.id')
    //         ->leftJoin('hf_job_categories', 'worker_profiles.category_id', '=', 'hf_job_categories.cat_id')
    //         ->select(
    //             'users.id',
    //             'users.name',
    //             'users.photo',
    //             'worker_profiles.headline',
    //             'worker_profiles.profile_picture',
    //             'worker_profiles.tagline',
    //             'worker_profiles.experience_years',
    //             'worker_profiles.availability',
    //             'worker_profiles.working_hours',
    //             'worker_profiles.category_id',
    //             'hf_job_categories.cat_name as category_name',
    //             'cities.name as city_name'
    //         )
    //         ->where('users.login_type', 3)
    //         ->where('users.is_deleted', 0)
    //         ->get();

    //     return view('site.sellers', compact('sellers'));
    // }

    public function index($category = null)
    {
        $sellers = DB::table('users')
            ->leftJoin('worker_profiles', 'users.id', '=', 'worker_profiles.user_id')
            ->leftJoin('cities', 'worker_profiles.city_id', '=', 'cities.id')
            ->leftJoin('hf_job_categories', 'worker_profiles.category_id', '=', 'hf_job_categories.cat_id')
            ->leftJoin('hf_reviews', 'users.id', '=', 'hf_reviews.worker_id')
            ->select(
                'users.id',
                'users.name',
                'users.photo',
                'worker_profiles.headline',
                'worker_profiles.profile_picture',
                'worker_profiles.tagline',
                'worker_profiles.experience_years',
                'worker_profiles.availability',
                'worker_profiles.working_hours',
                'worker_profiles.category_id',
                'hf_job_categories.cat_name as category_name',
                'cities.name as city_name',
                DB::raw('ROUND(AVG(hf_reviews.rating), 1) as avg_rating')
            )
            ->where('users.login_type', 3)
            ->where('users.is_deleted', 0)
            ->groupBy(
                'users.id', 'users.name', 'users.photo', 'worker_profiles.headline',
                'worker_profiles.profile_picture', 'worker_profiles.tagline',
                'worker_profiles.experience_years', 'worker_profiles.availability',
                'worker_profiles.working_hours', 'worker_profiles.category_id',
                'hf_job_categories.cat_name', 'cities.name'
            )
            ->get();

        return view('site.sellers', compact('sellers'));
    }

    // public function searchSellers(Request $request)
    // {
    //     $query = $request->input('query');

    //     $sellers = DB::table('users')
    //         ->leftJoin('worker_profiles', 'users.id', '=', 'worker_profiles.user_id')
    //         ->leftJoin('cities', 'worker_profiles.city_id', '=', 'cities.id')
    //         ->leftJoin('hf_job_categories', 'worker_profiles.category_id', '=', 'hf_job_categories.cat_id')
    //         ->select(
    //             'users.id',
    //             'users.name',
    //             'users.photo',
    //             'worker_profiles.headline',
    //             'worker_profiles.profile_picture',
    //             'worker_profiles.tagline',
    //             'worker_profiles.experience_years',
    //             'worker_profiles.availability',
    //             'worker_profiles.working_hours',
    //             'hf_job_categories.cat_name as category_name',
    //             'cities.name as city_name'
    //         )
    //         ->where('users.login_type', 3)
    //         ->where('users.is_deleted', 0)
    //         ->when($query, function ($q) use ($query) {
    //             $q->where('users.name', 'like', "%{$query}%")
    //             ->orWhere('worker_profiles.headline', 'like', "%{$query}%")
    //             ->orWhere('worker_profiles.tagline', 'like', "%{$query}%")
    //             ->orWhere('hf_job_categories.cat_name', 'like', "%{$query}%");
    //         })
    //         ->get();

    //     // Only return sellers list (not full layout)
    //     return view('site.components.sellers.list', compact('sellers'));
    // }


    public function searchSellers(Request $request)
    {
        $query = $request->input('query');

        $sellers = DB::table('users')
            ->leftJoin('worker_profiles', 'users.id', '=', 'worker_profiles.user_id')
            ->leftJoin('cities', 'worker_profiles.city_id', '=', 'cities.id')
            ->leftJoin('hf_job_categories', 'worker_profiles.category_id', '=', 'hf_job_categories.cat_id')
            // join ratings table (adjust name if different)
            ->leftJoin('hf_reviews', 'users.id', '=', 'hf_reviews.worker_id')
            ->select(
                'users.id',
                'users.name',
                'users.photo',
                'worker_profiles.headline',
                'worker_profiles.profile_picture',
                'worker_profiles.tagline',
                'worker_profiles.experience_years',
                'worker_profiles.availability',
                'worker_profiles.working_hours',
                'hf_job_categories.cat_name as category_name',
                'cities.name as city_name',
                DB::raw('ROUND(AVG(hf_reviews.rating), 1) as avg_rating'),
                DB::raw('COUNT(hf_reviews.rating) as ratings_count')
            )
            ->where('users.login_type', 3)
            ->where('users.is_deleted', 0)
            ->when($query, function ($q) use ($query) {
                $q->where('users.name', 'like', "%{$query}%")
                ->orWhere('worker_profiles.headline', 'like', "%{$query}%")
                ->orWhere('worker_profiles.tagline', 'like', "%{$query}%")
                ->orWhere('hf_job_categories.cat_name', 'like', "%{$query}%");
            })
            // must group by non-aggregated selected columns
            ->groupBy(
                'users.id', 'users.name', 'users.photo',
                'worker_profiles.headline', 'worker_profiles.profile_picture', 'worker_profiles.tagline',
                'worker_profiles.experience_years', 'worker_profiles.availability', 'worker_profiles.working_hours',
                'hf_job_categories.cat_name', 'cities.name'
            )
            ->get();

        // Return only the sellers list partial
        return view('site.components.sellers.list', compact('sellers'));
    }

    public function show($slug)
    {
        $user = User::where('id', $slug)
            ->with([
                'workerProfile.category',
                'reviewsReceived.customer' // also load customer details for name/photo
            ])
            ->firstOrFail();

        $profile = $user->workerProfile->with('category')->first();
        $portfolios = \App\Models\WorkerPortfolio::where('user_id', $user->id)->get();

        // dd($user);

        return view('site.sellers', compact('user', 'profile', 'portfolios'));
    }



}
