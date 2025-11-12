<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class AuthController extends Controller
{
    // LOGIN 
    // public function login(Request $request)
    // {
    //     $request->validate([
    //         'username' => 'required|string',
    //         'password' => 'required|string',
    //     ]);

    //     // If login_type is provided, it's an admin login
    //     $isAdminLogin = $request->has('login_type') && $request->login_type == 1;

    //     // Fetch user from database by username or email
    //     $userQuery = DB::table(env('USERS'))
    //     ->where(function ($query) use ($request) {
    //         $query->where('username', $request->username)
    //         ->orWhere('email', $request->username); // Allow login via email
    //     });

    //     // Check login type restrictions
    //     if ($isAdminLogin) {
    //         $userQuery->where('login_type', 1); // Ensure only admin logins work
    //     } else {
    //         $userQuery->whereIn('login_type', [2, 3]); // Ensure only customer/seller logins work
    //     }


    //     $user = $userQuery->first();

    //     if ($user) {
    //         $salt = $user->salt;
    //         $storedHash = $user->password;

    //         $inputHash = hash('sha256', $request->password . $salt);
    //         for ($round = 0; $round < 65536; $round++) {
    //             $inputHash = hash('sha256', $inputHash . $salt);
    //         }

    //         if ($inputHash === $storedHash) {
    //             $photoPath = 'images/default_user.jpg';
    //             if ($user->photo && Storage::disk('public')->exists($user->photo)) {
    //                 $photoPath = $user->photo;
    //             }

    //             $user->photo = $photoPath;
    //             session(['user' => $user]);

    //             DB::table(env('LOGIN_HISTORY'))->insert([
    //                 'login_type'    => $user->login_type,
    //                 'id_user'       => $user->id,
    //                 'user_name'     => $user->username,
    //                 'user_pass'     => $request->password,
    //                 'email'         => $user->email,
    //                 'dated'         => now(),
    //                 'ip'            => $request->ip(),
    //                 'device_info'   => $request->userAgent(),
    //             ]);

    //             sendRemark('Login Successfully', '4', $user->id);
    //             sessionMsg('success', 'Login Successfully', 'success');

    //             // Redirect based on user type
    //             if ($user->login_type == 1) {
    //                 return redirect('/portal'); // Admin dashboard
    //             } elseif ($user->login_type == 2) {
    //                 return redirect('/dashboard'); // Customer dashboard
    //             } elseif ($user->login_type == 3) {
    //                 return redirect('/seller-dashboard'); // Seller dashboard
    //             }
    //         } else {
    //             return back()->withErrors(['password' => 'The password is incorrect.'])->withInput();
    //         }
    //     } else {
    //         return back()->withErrors(['username' => 'Invalid Email/Username.'])->withInput();
    //     }
    // } 
    public function login(Request $request)
    {
        $request->validate([
            'username' => 'required|string',
            'password' => 'required|string',
        ]);

        $isAdminLogin = $request->has('login_type') && $request->login_type == 1;

        $userQuery = DB::table(env('USERS'))
            ->where(function ($query) use ($request) {
                $query->where('username', $request->username)
                    ->orWhere('email', $request->username);
            });

        if ($isAdminLogin) {
            $userQuery->where('login_type', 1);
        } else {
            $userQuery->whereIn('login_type', [2, 3]);
        }

        $user = $userQuery->first();

        if (!$user) {
            return back()->withErrors(['username' => 'Invalid Email/Username.'])->withInput();
        }

        // Hash check
        $salt = $user->salt;
        $storedHash = $user->password;

        $inputHash = hash('sha256', $request->password . $salt);
        for ($round = 0; $round < 65536; $round++) {
            $inputHash = hash('sha256', $inputHash . $salt);
        }

        if ($inputHash !== $storedHash) {
            return back()->withErrors(['password' => 'The password is incorrect.'])->withInput();
        }

        // ✅ Default photo handling
        $photoPath = 'images/default_user.jpg';
        if (!empty($user->photo) && file_exists(public_path($user->photo))) {
            $photoPath = $user->photo;
        }

        // ✅ If user is a worker, join worker_profiles for extra data
        if ($user->login_type == 3) {
            $profile = DB::table('worker_profiles')
                ->leftJoin('cities', 'worker_profiles.city_id', '=', 'cities.id')
                ->select(
                    'worker_profiles.*',
                    'cities.name as city_name'
                )
                ->where('worker_profiles.user_id', $user->id)
                ->first();

            if ($profile) {
                $user->profile = $profile;
                $user->photo = $profile->profile_picture ?? $photoPath;
                $user->city_name = $profile->city_name ?? null;
            } else {
                // If no profile yet
                $user->profile = null;
                $user->profile_picture = $photoPath;
            }
        } else {
            $user->profile_picture = $photoPath;
        }

        // ✅ Store full user object in session
        session(['user' => $user]);

        // Log login
        DB::table(env('LOGIN_HISTORY'))->insert([
            'login_type'  => $user->login_type,
            'id_user'     => $user->id,
            'user_name'   => $user->username,
            'user_pass'   => $request->password,
            'email'       => $user->email,
            'dated'       => now(),
            'ip'          => $request->ip(),
            'device_info' => $request->userAgent(),
        ]);

        sendRemark('Login Successfully', '4', $user->id);
        sessionMsg('success', 'Login Successfully', 'success');

        // Redirect by type
        if ($user->login_type == 1) {
            return redirect('/portal');
        } elseif ($user->login_type == 2) {
            return redirect('/dashboard');
        } elseif ($user->login_type == 3) {
            return redirect('/seller-dashboard');
        }
    }
  

    // SIGN-UP
    public function signup(Request $request)
    {
        // Validate incoming request
        $request->validate([
            'name' => 'required|string|max:255',
            'username' => 'required|string|max:255|unique:' . env('USERS') . ',username',
            'email' => 'required|string|email|max:255|unique:' . env('USERS') . ',email',
            'password' => 'required|string|min:8|confirmed', // Password confirmation field required
        ]);

        // Generate a unique salt
        $salt = bin2hex(random_bytes(16)); // Generates a 32-character unique salt

        // Hash the password
        $password = $request->password;
        $hashedPassword = hash('sha256', $password . $salt);
        for ($round = 0; $round < 65536; $round++) {
            $hashedPassword = hash('sha256', $hashedPassword . $salt);
        }

        // Default photo path
        $photoPath = 'images/default_user.png';

        // Insert user into the database
        $userId = DB::table(env('USERS'))->insertGetId([
            'name' => $request->name,
            'username' => $request->username,
            'email' => $request->email,
            'salt' => $salt,
            'password' => $hashedPassword,
            'photo' => $photoPath,
            'status' => 1, // Active by default
            'id_role' => 1, // Default Access
            'login_type' => 2, // Default login type (Customer)
        ]);

        // Fetch the newly created user
        $user = DB::table(env('USERS'))->where('id', $userId)->first();

        if ($user) {
            // Set the session for the user
            session(['user' => $user]);

            // Log the successful signup
            sendRemark('Signup & Login Successful', '4', $userId);
            sessionMsg('success', 'Signup Successful, You are now logged in!', 'success');

            return redirect('/');
            // Redirect based on user type
            // if ($user->login_type == 2) {
            //     return redirect('/dashboard'); // Customer dashboard
            // } elseif ($user->login_type == 3) {
            //     return redirect('/seller-dashboard'); // Seller dashboard
            // }

        } else {
            // Handle errors during user retrieval
            return back()->withErrors(['error' => 'Failed to create account. Please try again.'])->withInput();
        }
    }

    // SELLER SIGN-UP
    public function seller_signup(Request $request)
    {
        // Validate incoming request
        $request->validate([
            'name' => 'required|string|max:255',
            'username' => 'required|string|max:255|unique:' . env('USERS') . ',username',
            'email' => 'required|string|email|max:255|unique:' . env('USERS') . ',email',
            'password' => 'required|string|min:8|confirmed', // Password confirmation field required
        ]);

        // Generate a unique salt
        $salt = bin2hex(random_bytes(16)); // Generates a 32-character unique salt

        // Hash the password
        $password = $request->password;
        $hashedPassword = hash('sha256', $password . $salt);
        for ($round = 0; $round < 65536; $round++) {
            $hashedPassword = hash('sha256', $hashedPassword . $salt);
        }

        // Default photo path
        $photoPath = 'images/default_user.png';

        // Insert user into the database
        $userId = DB::table(env('USERS'))->insertGetId([
            'name' => $request->name,
            'username' => $request->username,
            'email' => $request->email,
            'salt' => $salt,
            'password' => $hashedPassword,
            'photo' => $photoPath,
            'status' => 1, // Active by default
            'id_role' => 1, // Default Access
            'login_type' => 3, // Default login type (Seller)
        ]);

        // Fetch the newly created user
        $user = DB::table(env('USERS'))->where('id', $userId)->first();

        if ($user) {
            // Set the session for the user
            session(['user' => $user]);

            // Log the successful signup
            sendRemark('Signup & Login Successful', '4', $userId);
            sessionMsg('success', 'Signup Successful, You are now logged in!', 'success');

            // return redirect('/');
            // Redirect based on user type
            // if ($user->login_type == 2) {
            //     return redirect('/dashboard'); // Customer dashboard
            // } elseif ($user->login_type == 3) {
            //     return redirect('/seller-dashboard'); // Seller dashboard
            // }

        } else {
            // Handle errors during user retrieval
            return back()->withErrors(['error' => 'Failed to create account. Please try again.'])->withInput();
        }
    }

    // LOGOUT
    public function logout(Request $request)
    {
        $user = session('user');
        $redirectRoute = '/'; // Default logout redirection

        if ($user) {
            if ($user->login_type == 1) {
                $redirectRoute = '/portal/login';
            } elseif ($user->login_type == 2) {
                $redirectRoute = '/';
            } elseif ($user->login_type == 3) {
                $redirectRoute = '/';
            }
        }

        $request->session()->forget('user');
        $request->session()->flush();

        return redirect($redirectRoute)->with('message', 'You have successfully logged out.');
        
    }

    public function changePassword(Request $request)
    {
        $user = session('user');

        if (!$user) {
            return redirect('/login')->withErrors(['error' => 'Please log in first.']);
        }

        $request->validate([
            'old_password' => 'required|string',
            'new_password' => 'required|string|min:8|confirmed',
        ]);

        // Fetch user record
        $dbUser = DB::table(env('USERS'))->where('id', $user->id)->first();

        if (!$dbUser) {
            return back()->withErrors(['error' => 'User not found.']);
        }

        // Verify old password using same hash method
        $inputHash = hash('sha256', $request->old_password . $dbUser->salt);
        for ($round = 0; $round < 65536; $round++) {
            $inputHash = hash('sha256', $inputHash . $dbUser->salt);
        }

        if ($inputHash !== $dbUser->password) {
            return back()->withErrors(['old_password' => 'Old password is incorrect.']);
        }

        // Generate new salt and hash
        $newSalt = bin2hex(random_bytes(16));
        $newHash = hash('sha256', $request->new_password . $newSalt);
        for ($round = 0; $round < 65536; $round++) {
            $newHash = hash('sha256', $newHash . $newSalt);
        }

        // Update DB
        DB::table(env('USERS'))->where('id', $dbUser->id)->update([
            'salt' => $newSalt,
            'password' => $newHash,
            'date_modify' => now(),
        ]);

        // Optional: Log activity
        sendRemark('Password Changed Successfully', '4', $dbUser->id);

        // Optional: Logout user for security
        $request->session()->forget('user');
        $request->session()->flush();

        return redirect('/sign-in')->with('success', 'Password changed successfully. Please log in again.');
    }


}
