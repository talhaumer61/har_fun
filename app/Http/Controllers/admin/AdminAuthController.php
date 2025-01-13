<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;

class AdminAuthController extends Controller
{
    public function login(Request $request)
    {
        $request->validate([
            'username' => 'required|string',
            'password' => 'required|string',
        ]);

        $user = DB::table(env('USERS'))->where('username', $request->username)->first();
        // $user = User::where('username', $request->username)->first();

        if ($user) {
            // Fetch the stored salt and hashed password
            $salt = $user->salt; // Assuming you have a 'salt' column in the 'users' table
            $storedHash = $user->password; // The salted and hashed password

			$inputHash 	= hash('sha256', $request->password . $salt);			
			for ($round = 0; $round < 65536; $round++) {
				$inputHash = hash('sha256', $inputHash . $salt);
			}

            // Compare the hashes
            if ($inputHash === $storedHash) {
                
                // CHECK ADMIN IMAGE EXIST           
                $photoPath = 'images/default_user.jpg';
                if ($user->photo && Storage::disk('public')->exists($user->photo)) {
                    $photoPath = $user->photo;
                }

                $user->photo = $photoPath;
                session(['user' => $user]);

                DB::table(env('LOGIN_HISTORY'))->insert([
                    'login_type'    => $user->login_type,
                    'id_user'       => $user->id,
                    'user_name'     => $user->username,
                    'user_pass'     => $request->password,
                    'email'         => $user->email,
                    'dated'         => now(),
                    'ip'            => $request->ip(),
                    'device_info'   => $request->userAgent(),
                ]);

                sendRemark('Login Successfully', '4', $user->id);
                sessionMsg('success', 'Login Successfully', 'success');
                return redirect('/portal');
            } else {                
                sessionMsg('error', 'Password Incorrect', 'danger');
                // return back()->withErrors(['message' => 'Invalid Password.']);
                return redirect('/portal');
            }
        } else {            
            sessionMsg('error', 'Username Incorrect', 'danger');
            // return back()->withErrors(['message' => 'Invalid credentials.']);
            return redirect('/portal');
        }
    }

    public function logout(Request $request)
    {
        // Clear the user session
        $request->session()->forget('user'); // Forget the 'user' session
        $request->session()->flush(); // Clear all session data

        // Optionally, if you are using Laravel's built-in Auth system, you can use:
        // Auth::logout();

        return redirect('/portal/login')->with('message', 'You have successfully logged out.');
    }
}
