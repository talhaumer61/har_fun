<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\JobCategory;
use Illuminate\Support\Str;
use App\Models\User;
use Yajra\DataTables\DataTables;
    use Illuminate\Support\Facades\DB;




class AdminDashboardController extends Controller
{
    public function index()
    {
        // Total users (only type 2 and 3)
        $totalUsers = DB::table('users')
            ->whereIn('login_type', [2, 3])
            ->count();

        // Total customers (type 2)
        $totalCustomers = DB::table('users')
            ->where('login_type', 2)
            ->count();

        // Total workers (type 3)
        $totalWorkers = DB::table('users')
            ->where('login_type', 3)
            ->count();

        // Fetch recent 5 users with login_type = 2
        $recentType2 = DB::table('users')
            ->where('login_type', 2)
            ->orderBy('id', 'desc')
            ->limit(5)
            ->get();

        // Fetch recent 5 workers (type 3) with profile + city
        $recentType3 = DB::table('users')
            ->join('worker_profiles', 'users.id', '=', 'worker_profiles.user_id')
            ->leftJoin('cities', 'worker_profiles.city_id', '=', 'cities.id')
            ->leftJoin('hf_job_categories', 'worker_profiles.category_id', '=', 'hf_job_categories.cat_id')
            ->where('users.login_type', 3)
            ->orderBy('users.id', 'desc')
            ->limit(5)
            ->select(
                'users.*',
                'worker_profiles.*',
                'hf_job_categories.cat_name as category_name',
                'cities.name as city_name'
            )
            ->get();

        // Finance cards
        $totalPayments = DB::table('hf_payments')
            ->where('status', 'paid')
            ->sum('amount');

        $totalCommission = DB::table('hf_payments')
            ->where('status', 'released')
            ->sum('commission');

        $totalWorkerEarnings = DB::table('hf_payments')
            ->where('status', 'released')
            ->sum('worker_amount');

       $monthlyFinance = DB::table('hf_payments')
            ->select(
                DB::raw("DATE_FORMAT(created_at, '%Y-%m') as month"),
                DB::raw("SUM(CASE WHEN status = 'paid' THEN amount ELSE 0 END) as total_amount"),
                DB::raw("SUM(CASE WHEN status = 'released' THEN commission ELSE 0 END) as total_commission"),
                DB::raw("SUM(CASE WHEN status = 'released' THEN worker_amount ELSE 0 END) as total_worker_amount")
            )
            ->groupBy(DB::raw("DATE_FORMAT(created_at, '%Y-%m')"))
            ->orderBy('month')
            ->get();

            
        return view('admin.' . get_logintypes(session('user')->login_type) . '.dashboard', compact(
            'totalUsers', 'totalCustomers', 'totalWorkers', 'recentType2', 'recentType3'
            , 'totalPayments', 'totalCommission', 'totalWorkerEarnings', 'monthlyFinance'));
    }



    public function jobs_posted()
    {
        $jobs = DB::table('hf_jobs')
            ->join('users', 'hf_jobs.id_customer', '=', 'users.id')
            ->select(
                'hf_jobs.*',
                'users.name as customer_name',
                'users.email as customer_email',
                'users.phone as customer_phone'
            )
            ->where('hf_jobs.is_deleted', false)
            ->orderBy('hf_jobs.date_added', 'desc')
            ->get();

        return view('admin.headoffice.jobs_posted', compact('jobs'));
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