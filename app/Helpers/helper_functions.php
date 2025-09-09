<?php
use App\Models\Log;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Request;

// CHECK EXISTANCE GLOBAL VAR
if (!function_exists('globalVar')) {
    function globalVar($key)
    {
        return config('globals.' . $key);
    }
}

// CLEANVARS
function cleanvars($str){ 
	$str = trim($str);
	return is_array($str) ? array_map('cleanvars', $str) : str_replace("\\", "\\\\", htmlspecialchars((stripslashes($str)), ENT_QUOTES)); 
}

// LASTEST ID
function lastId() {
    // Retrieve the last inserted ID using raw SQL
    $lastId = DB::select('SELECT LAST_INSERT_ID() as id')[0]->id;
    
    // Return the last inserted ID
    return $lastId;
}

//Status 
$admstatus = array (
    array('id'=>1, 'name'=>'Active'), 
    array('id'=>2, 'name'=>'Inactive')
);

function get_admstatus($id = '') {
    $admstatus = array (
        array('id'=>1, 'name'=>'Active'), 
        array('id'=>2, 'name'=>'Inactive')
    );
    $listadmstatus= array (
        '1' => '<span class="label label-success rounded p-1">Active</span>', 
        '2' => '<span class="label label-danger rounded p-1">Inactive</span>'
    );
    if(!empty($id)){
        return $listadmstatus[$id];
    }else{
        return $admstatus;
    }
}

// LOGIN TYPES
function get_logintypes($id = '') {
	$listlogintypes = array (
								   '1'	=> 'headoffice',
								   '2'	=> 'customer',
								   '3'	=> 'seller'
							);
	if(!empty($id)){
		return $listlogintypes[$id];
	}else{
		return $listlogintypes;
	}
}

// ADMIN TYPES
function get_admtypes($id = '') {
	$listadmtypes = array (
								   '1'	=> 'Super Admin'
							);
	if(!empty($id)){
		return $listadmtypes[$id];
	}else{
		return $listadmtypes;
	}
}

// LOGFILE ACTION
function get_log_action($id = '') {
	$listlogaction = array (
							  '1' => 'Add'		 
							, '2' => 'Update'		 
							, '3' => 'Delete'		
							, '4' => 'Login'	
						 );
	if(!empty($id)){
		return $listlogaction[$id];
	}else{
		return $listlogaction;
	}
}

// SESSION MESSAGE
function sessionMsg($title = "", $msg = "", $type = "") {
	if (!empty($title) && !empty($msg)&& !empty($type)){
        session([
            'msg' => [
                'title' => $title,
                'text' => $msg,
                'type' => $type,
            ]
        ]);
        return true;
	} else {
		return false;
	}
}

// SEND REMARKS
function sendRemark($remarks = "", $action = "", $id_record = "") {
    // Validate the input
    if (!empty($remarks) && !empty($action) && !empty($id_record)) {

        // Retrieve the current logged-in user from session
        $user = session('user');
        
        // Check if the user is authenticated
        if (!$user) {
            return false; // User is not logged in
        }

        // Prepare the data to be logged
        $values = [
            'id_user'        => $user->id,  // Authenticated user's ID
			'urlpath'		 => Request::path(), // full url
            'action'         => cleanvars($action), // Clean and sanitize action
            'id_record'      => cleanvars($id_record), // Clean and sanitize record ID
            'dated'          => now(), // Current timestamp using Laravel's now() helper
            'ip'             => cleanvars(Request::ip()), // Get the IP address of the request
            'remarks'        => cleanvars($remarks), // Clean and sanitize remarks
        ];

        // Insert the log entry into the logs table
        $log = Log::create($values);

        // Return true if the log was created successfully, otherwise false
        return $log ? true : false;
    }

    // Return false if required parameters are missing
    return false;
}


function getCategories() {
    // Fetch categories from the database
    $categories = DB::table('hf_job_categories')
                    ->where('cat_status', 1)  // Assuming cat_status = 1 means active
                    ->where('is_deleted', 0)  // Assuming is_deleted = 0 means not deleted
                    ->limit(6)
                    ->get();

    // Return the categories
    return $categories;
}

function get_jobstatus($id = '') {
    $jobstatus = array (
        array('id'=>0, 'name'=>'Cancelled'), 
        array('id'=>1, 'name'=>'Completed'),
        array('id'=>2, 'name'=>'Pending'),
        array('id'=>3, 'name'=>'In Progress'),
    );
    $listjobstatus= array (
        '0' => '<span class="label label-danger rounded p-1">Cancelled</span>', 
        '1' => '<span class="label label-success rounded p-1">Completed</span>',
        '2' => '<span class="label label-warning rounded p-1">Pending</span>',
        '3' => '<span class="label label-primary rounded p-1">In Progress</span>',
    );
    if(!empty($id)){
        return $listjobstatus[$id];
    }else{
        return $jobstatus;
    }
}
