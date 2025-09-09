<?php

namespace App\Http\Controllers\site;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SiteSellersController extends Controller
{
    public function index($id = null)
    {
        $sellers = DB::table('users')
            ->leftJoin('worker_profiles', 'users.id', '=', 'worker_profiles.user_id')
            ->leftJoin('cities', 'worker_profiles.city_id', '=', 'cities.id')
            ->leftJoin('hf_job_categories', 'worker_profiles.category_id', '=', 'hf_job_categories.cat_id')
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
                'cities.name as city_name'
            )
            ->where('users.login_type', 3)
            ->where('users.is_deleted', 0)
            ->get();

        return view('site.sellers', compact('sellers'));
    }


    public function show($slug)
    {
        $user = User::where('id', $slug)->firstOrFail();

        $profile = $user->workerProfile()->with('category')->first();

        $portfolios = \App\Models\WorkerPortfolio::where('user_id', $user->id)->get();

        return view('site.sellers', compact('user', 'profile', 'portfolios'));
    }



}
