<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\View\Middleware\ShareErrorsFromSession;

use Session;
use App\Validuser;

class SslCare extends Controller
{
    public function Index()
    {
    	return view('login');	
    }

    public function Show()
    {
    	echo "SSLCARE";
    	echo session('user_id').session('id').session('user_type').session('user_dept').session('user_company').session('mask_mobile_no').session('mask_mobile_no_pushpull').session('mask_bulk_text').session('sms_download_fail').session('sms_authorization').session('sms_authorization_limit');
    }

    public function Login(Request $request)
    {
    	$query_ok=0;
		$flag=0;
		$visitor_ip = "UNKNOWN_".$_SERVER['REMOTE_ADDR'];

    	$username = trim($request->username);
      	$password = trim($request->password);
      
      	$encrypted_pass = hash_hmac('SHA256', trim($username), trim($password));
      	$login = Validuser::where('user_id', $username)->where('pass_in_encryp_enable', "1")->where('user_status', "1")->first();
      	if(isset($login))
      	{
      		$query = Validuser::where('user_id', $username)->where('pass_in_encryption', $encrypted_pass)->where('pass_in_encryp_enable', "1")->first();
            if(isset($query))
            {
                $flag = 1;
                echo $flag;
            }
            elseif($flag==0)
            {
                $pass=crypt(trim($password),trim($username));
           		$query = Validuser::where('user_id', $username)->where('pass', $password)->where('user_status', "1")->first();
                if(isset($query))
                {
                    $flag=2;
                }
            }
            else
            {
            	$query = Validuser::where('user_id', $username)->where('ldap', "1")->where('user_status', "1")->first();
                if(isset($query))
                {
                    $user=trim($username);
                    $pass=trim($password);
                }
            }
            if($flag==1 || $flag==2|| $flag==3)
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

                echo $id = $query['id'];

                session(['user_id'=> $username, 'id'=> $id, 'user_type'=> $user_type, 'user_dept'=> $user_dept, 'user_company'=> $user_company, 'mask_mobile_no'=> $mask_mobile_no, 'mask_mobile_no_pushpull'=> $mask_mobile_no_pushpull, 'mask_bulk_text'=> $mask_bulk_text, 'sms_download_fail'=> $sms_download_fail, 'sms_authorization'=> $sms_authorization, 'sms_authorization_limit'=> $sms_authorization_limit]);

                if(empty($query['pass_change_time']))
                {
                	session(['change_pass'=> 1]);
                }
                else
                {
                	session(['change_pass'=> 0]);
                }
                $query_ok=1;
                /* Password up gradation Start*/
                if($flag==2)
                {
                    Validuser::where('user_id', $username)->update(['pass_in_encryp_enable'=> '1', 'pass_in_encryption'=> $encrypted_pass]);
                }
                /* Password up gradation End*/

                //user_access_log(dbconnection required=1 else 0,user_id,user_name,current_page,purpose);
                // user_access_log(1,$_SESSION['id'],$_SESSION['user_id'],"Index_db","Login");
                // CreateLogs($visitor_ip, "Login successful. Going to home page.");
                // header("Location: home.php");
                echo "Success";
            }
            else
	      	{
	      		$query_ok=1;
	      		\Session::flash('flash_message', 'Username or Password Invalide!');
	        	return redirect('/')->withInput();
	      	}
      	}
      	else
      	{
      		\Session::flash('flash_message', 'Username or Password Invalide!');
        	return redirect('/')->withInput();
      	}
    }
}
