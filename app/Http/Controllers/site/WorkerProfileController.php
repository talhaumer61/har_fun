<?php

namespace App\Http\Controllers\site;

use App\Http\Controllers\Controller;
use App\Models\WorkerProfile;
use App\Models\City;
use App\Models\JobCategory;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class WorkerProfileController extends Controller
{
    public function edit()
    {
        $user = session('user');
        $profile = WorkerProfile::firstOrCreate(['user_id' => $user->id]);
        $cities = City::all();
        $categories = JobCategory::where('cat_status', 1)->where('is_deleted', 0)->get(); // active, not deleted

        return view('site.seller.seller_profile', compact('user', 'profile', 'cities', 'categories'));
    }



    public function update(Request $request)
    {
        $workerId = session('user')->id;

        $request->validate([
            'headline'         => 'nullable|string|max:255',
            'address'          => 'nullable|string|max:255',
            'city_id'          => 'nullable|integer|exists:cities,id',
            'category_id'      => 'nullable|integer|exists:hf_job_categories,cat_id',
            'phone'            => 'nullable|string|max:20',
            'bio'              => 'nullable|string',
            'tagline'          => 'nullable|string|max:255',
            'experience_years' => 'nullable|integer',
            'availability'     => 'nullable|string|max:255',
            'working_hours'    => 'nullable|string|max:255',
            'resume'           => 'nullable|file|mimes:pdf,doc,docx|max:2048',
            'profile_picture'  => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        ]);

        $profile = WorkerProfile::where('user_id', $workerId)->first();

        // Handle resume upload if provided
        if ($request->hasFile('resume')) {
            $resume = $request->file('resume');
            $resumeFilename = uniqid() . '.' . $resume->getClientOriginalExtension();
            $resume->move(public_path('uploads/resumes'), $resumeFilename);
            $profile->resume = 'uploads/resumes/' . $resumeFilename;
        }

        // Handle profile picture upload if provided
        if ($request->hasFile('profile_picture')) {
            $image = $request->file('profile_picture');
            $filename = uniqid() . '.' . $image->getClientOriginalExtension();
            $destination = public_path('uploads/workers_profile_photo');
            $image->move($destination, $filename);
            $relativePath = 'uploads/workers_profile_photo/' . $filename;

            $profile->profile_picture = $relativePath;

            // Update in users table as well
            DB::table('users')
                ->where('id', $workerId)
                ->update([
                    'photo' => $relativePath,
                    'date_modify' => now(),
                ]);

            // Update session user photo
            $user = session('user');
            $user->photo = $relativePath;
            session(['user' => $user]);
        }

        // Update remaining profile fields
        $profile->headline = $request->headline;
        $profile->address = $request->address;
        $profile->city_id = $request->city_id;
        $profile->category_id = $request->category_id;
        $profile->phone = $request->phone;
        $profile->bio = $request->bio;
        $profile->tagline = $request->tagline;
        $profile->experience_years = $request->experience_years;
        $profile->availability = $request->availability;
        $profile->working_hours = $request->working_hours;
        $profile->save();

        return redirect()->back()->with('success', 'Profile updated successfully.');
    }


}
