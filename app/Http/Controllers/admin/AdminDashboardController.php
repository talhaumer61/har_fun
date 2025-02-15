<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\JobCategory;
use Illuminate\Support\Str;

class AdminDashboardController extends Controller
{
    // public function index(){
    //     return view('admin.dashboard');
    // }
    public function index()
    {
        return view('admin.'.get_logintypes(session('user')->login_type).'.dashboard');
    }

    public function job_categories(Request $request, $action = 'list', $href = null)
    {
         // Fetch only active and not deleted categories
         $categories = JobCategory::where('is_deleted', false)
        ->select('cat_id', 'cat_status', 'cat_name', 'cat_href', 'cat_icon')
        ->where('cat_status', 1)
        ->get();
        // dd($categories);

       // Fetch specific category if action is 'edit'
        $edit_category = null;
        if ($action == 'edit' && $href) {
            $edit_category = JobCategory::where('cat_href', $href)->first();
        }

        return view('admin.headoffice.categories', compact('action', 'href', 'categories', 'edit_category'));

    }

    public function add_job_category(Request $request)
    {
        $request->validate([
            'cat_name' => 'required|string|max:255',
            'cat_status' => 'required|in:1,2', // Assuming 1 = Active, 2 = Inactive
            'cat_desc' => 'nullable|string|max:500',
            'cat_detail' => 'nullable|string',
            'cat_icon' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:3072'
        ]);

        $iconPath = null;
        if ($request->hasFile('cat_icon')) {
            // Generate a unique filename
            $filename = Str::slug($request->cat_name, '_') . '_' . now()->format('YmdHis') . '.' . $request->file('cat_icon')->getClientOriginalExtension();
            
            // Store in the desired directory
            $iconPath = $request->file('cat_icon')->move(public_path('uploads/category_icons'), $filename);

            // Save only the relative path in the database
            $iconPath = 'uploads/category_icons/' . $filename;
        }

        JobCategory::create([
            'cat_name' => $request->cat_name,
            'cat_href' => Str::slug($request->cat_name, '-'),
            'cat_status' => $request->cat_status,
            'cat_desc' => $request->cat_desc,
            'cat_detail' => $request->cat_detail,
            'cat_icon' => $iconPath,
            'id_added' => session('user')->id,
            'date_added' => now()
        ]);

        return redirect()->route('admin.categories')->with('success', 'Category added successfully!');
    }


    // Update existing category
    public function update_job_category(Request $request)
    {
        $category = JobCategory::where('cat_href', $request->cat_href)->firstOrFail();

        $request->validate([
            'cat_name' => 'required|string|max:255',
            'cat_href' => 'required|string|max:255',
            'cat_status' => 'required|integer',
            'cat_desc' => 'nullable|string|max:500',
            'cat_detail' => 'nullable|string',
            'cat_icon' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:3072',
        ]);

        // Handle icon upload if a new one is uploaded
        if ($request->hasFile('cat_icon')) {
            // Generate a unique filename
            $filename = Str::slug($request->cat_name, '_') . '_' . now()->format('YmdHis') . '.' . $request->file('cat_icon')->getClientOriginalExtension();
            
            // Store in the desired directory
            $iconPath = $request->file('cat_icon')->move(public_path('uploads/category_icons'), $filename);

            // Save only the relative path in the database
            $iconPath = 'uploads/category_icons/' . $filename;

            // Delete old icon if exists
            if ($category->cat_icon && file_exists(public_path($category->cat_icon))) {
                unlink(public_path($category->cat_icon));
            }
        } else {
            $iconPath = $category->cat_icon;
        }

        $category->update([
            'cat_name' => $request->cat_name,
            'cat_status' => $request->cat_status,
            'cat_desc' => $request->cat_desc,
            'cat_detail' => $request->cat_detail,
            'cat_icon' => $iconPath,
            'cat_href' => Str::slug($request->cat_name, '-'),
        ]);

        return redirect()->route('admin.categories')->with('success', 'Category updated successfully!');
    }

}

?>