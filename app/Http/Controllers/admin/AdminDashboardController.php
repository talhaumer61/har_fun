<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\JobCategory;
use Illuminate\Support\Str;
use App\Models\User;
use Yajra\DataTables\DataTables;



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
        ->where('cat_status', 1)
        ->select('cat_id', 'cat_status', 'cat_name', 'cat_href', 'cat_icon')
        ->orderBy('cat_name', 'asc') // Optional: Sorting
        ->paginate(10); // Display 10 records per page

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

    // Users
    // public function users(Request $request, $action = 'list', $href = null)
    // {
    //      // Fetch only active and not deleted categories
    //     $categories = JobCategory::where('is_deleted', false)
    //     ->where('cat_status', 1)
    //     ->select('cat_id', 'cat_status', 'cat_name', 'cat_href', 'cat_icon')
    //     ->orderBy('cat_name', 'asc') // Optional: Sorting
    //     ->paginate(10); // Display 10 records per page

    //     // dd($categories);

    //    // Fetch specific category if action is 'edit'
    //     $edit_category = null;
    //     if ($action == 'edit' && $href) {
    //         $edit_category = JobCategory::where('cat_href', $href)->first();
    //     }

    //     return view('admin.headoffice.users', compact('action', 'href', 'categories', 'edit_category'));

    // }

    // public function users(Request $request, $action = 'list', $href = null)
    // {
    //     if ($request->ajax()) {
    //         $users = User::whereIn('login_type', [2, 3]) // Fetch only clients (2) and sellers (3)
    //                      ->where('is_deleted', false) // Exclude deleted users
    //                      ->select(['id', 'name', 'username', 'email', 'phone', 'photo', 'login_type']);
    
    //         return DataTables::of($users)
    //             ->addColumn('photo', function ($user) {
    //                 return '<img src="'. asset($user->photo ?? 'default.png') .'" width="40" class="rounded-circle">';
    //             })
    //             ->addColumn('user_type', function ($user) {
    //                 return $user->login_type == 2 ? 'Client' : 'Seller';
    //             })
    //             ->addColumn('action', function ($user) {
    //                 return '
    //                     <a href="'. route('admin.users', ['action' => 'edit', 'id' => $user->id]) .'" class="btn btn-sm btn-info">
    //                         <i class="ri-edit-line"></i>
    //                     </a>
    //                     <button class="btn btn-sm btn-danger deleteUser" data-id="'.$user->id.'">
    //                         <i class="ri-delete-bin-line"></i>
    //                     </button>';
    //             })
    //             ->rawColumns(['photo', 'action'])
    //             ->make(true);
    //     }

    //     return view('admin.headoffice.users',compact('action', 'href'));
    // }
    public function users(Request $request, $action = 'list', $href = null)
    {
        if ($request->ajax()) {
            // Fetch only Clients and Sellers (Exclude Admins)
            $query = User::where('is_deleted', false)
                         ->whereIn('login_type', [2, 3]); // Only Clients & Sellers
    
            // Apply filter if specific user type is selected
            if ($request->filled('user_type')) {
                $query->where('login_type', $request->user_type);
            }
    
            return DataTables::of($query)
                ->addIndexColumn()
                ->addColumn('photo', function ($user) {
                    return '<img src="'. asset($user->photo ?? 'default.png') .'" width="40" class="rounded-circle">';
                })
                ->addColumn('user_type', function ($user) {
                    return $user->login_type == 2 ? '<span class="label label-warning rounded p-1">Client</span>' : '<span class="label label-dark rounded p-1">Seller</span>';
                })
                // ->addColumn('action', function ($user) {
                //     return '
                //         <a href="'. route('admin.users', ['action' => 'edit', 'id' => $user->id]) .'" class="btn btn-sm btn-info">
                //             <i class="ri-edit-line"></i>
                //         </a>
                //         <button class="btn btn-sm btn-danger deleteUser" data-id="'.$user->id.'">
                //             <i class="ri-delete-bin-line"></i>
                //         </button>';
                // })
                // ->rawColumns(['photo', 'action','user_type'])
                
                ->addColumn('status', function ($user) {
                    return get_admstatus($user->status); // Call function to get badge
                })
                ->rawColumns(['photo', 'user_type','status'])
                ->make(true);
        }
    
        return view('admin.headoffice.users',compact('action', 'href'));
    }

}

?>