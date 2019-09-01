<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\View\Middleware\ShareErrorsFromSession;

use Session;
use App\Validuser;

class LoginController extends Controller
{
    public function Index()
    {
    	if(Session::has('user_id'))
    	{
    		return redirect('dashboard');
    	}
    	else
    	{
    		return view('login');
    	}
    }

    public function Login(Request $request)
    {
        // dd($request);
        // die("23");
    	$query_ok=0;
		$flag=0;
		$visitor_ip = "UNKNOWN_".$_SERVER['REMOTE_ADDR'];

    	$username = trim($request->username);
      	$password = trim($request->password);

      	$encrypted_pass = hash_hmac('SHA256', trim($username), trim($password));

      	$query = Validuser::where('user_id', $username)->where('pass_in_encryption', $encrypted_pass)->where('pass_in_encryp_enable', "1")->first();
        if(isset($query))
        {

            $user_type = $query['user_type'];
            $user_dept = $query['department_id'];
            $user_company = $query['company_id'];
            $mask_mobile_no = $query['mask_mobile_no'];
            $mask_mobile_no_pushpull = $query['mask_mobile_no_pushpull'];
            $mask_bulk_text = $query['mask_bulk_text'];
            $sms_download_fail = $query['sms_download_fail'];
            $sms_authorization = $query['sms_authorization'];
            $sms_authorization_limit = $query['sms_authorization_limit'];
            $user_status = $query['user_status'];
            $id = $query['id'];
            
            if($user_status == "0")
            {
            	$query_ok=1;
	      		\Session::flash('flash_message', 'Username Inactive Please Communicate With Admin!');
	        	return redirect('/')->withInput();
            }
            else
            {
            	session([
            	'user_id'=> $username, 
            	'id'=> $id, 
            	'user_type'=> $user_type, 
            	'user_dept'=> $user_dept, 
            	'user_company'=> $user_company, 
            	'mask_mobile_no'=> $mask_mobile_no, 
            	'mask_mobile_no_pushpull'=> $mask_mobile_no_pushpull, 
            	'mask_bulk_text'=> $mask_bulk_text, 
            	'sms_download_fail'=> $sms_download_fail, 
            	'sms_authorization'=> $sms_authorization, 
            	'sms_authorization_limit'=> $sms_authorization_limit]);

            	return redirect('dashboard');
            }
        }
        else
      	{
      		$query_ok=1;
      		\Session::flash('flash_message', 'Username & Password Invalide!');
        	return redirect('/')->withInput();
      	}
    }
    public function Logout(Request $request)
	{
	    $request->session()->flush();
	    return redirect('/');
	}
}
