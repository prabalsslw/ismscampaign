<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\View\Middleware\ShareErrorsFromSession;
use Illuminate\Support\Facades\Input;

use Session;
use DB;
use App\Validuser;
use App\PermissionMenu;
use App\SmsPermissionTab;
use App\PermissionBulk;
use App\PermissionAdmin;
use App\CampaignCategory;
use App\SmsStatusTb;
use App\SmsPermissionStakeholder;
use App\StakeHolderTb;
use App\CampaignHistory;
use App\IsmsSummary;


class DashboardController extends Controller
{
    public function Index()
    {
    	if(Session::has('user_id'))
    	{
            $campaign_category = CampaignCategory::where('is_parent','1')->orderby('category','ASC')->paginate(6);
            
    		return view('dashboard', compact('campaign_category'));
    	}
    	else
    	{
    		return redirect('/');
    	}
    }

    public function CampaignLeftBar()
    {
        date_default_timezone_set('Asia/Dhaka');
        $date = date('Y-m-d');

        if(Session::has('user_id'))
        {
            $user_id = session('id');
            $user_type = session('user_type');
            // $campaign_catagory = CampaignCategory::orderby('category', 'ASC')->get();
            $campaign_catagory = CampaignCategory::orderby('category', 'ASC')->where('is_parent','1')->get();
            // $sms_tab = SmsPermissionTab::select('tab_id')->where('left_menu_id', '13')->where('user_id', '1445')->groupBy('tab_id')->get();
            $sms_tab = SmsPermissionTab::select('tab_id')->where('left_menu_id', '13')->where('user_id', session('id'))->groupBy('tab_id')->get();

            $campaign_history = DB::select("SELECT sms_status_tb.*, cc.category,campaign_category.category AS sub_category,stake_holder_tb.stake_holder AS stake_holder,campaign_history.number_start_from,campaign_history.number_end_to,campaign_history.total_number,sms_status.smsstatus FROM `sms_status_tb` LEFT JOIN `campaign_history` ON `campaign_history`.`sms_status_tb_id` = `sms_status_tb`.`id` LEFT JOIN `stake_holder_tb` ON `stake_holder_tb`.`id` = `sms_status_tb`.`stakeholder_id` LEFT JOIN `campaign_category` ON `campaign_category`.`id` = `campaign_history`.`sub_category_id` LEFT JOIN `sms_status` ON `sms_status_tb`.`sms_status` = `sms_status`.`id` LEFT JOIN `campaign_category` AS `cc` ON  `campaign_history`.`parent_category_id`= `cc`.`id` WHERE stake_holder_tb.id IN (SELECT sht.id FROM sms_permission_stakeholder AS sps LEFT JOIN stake_holder_tb AS sht ON sht.id = sps.permited_stakeholder WHERE user_id= '$user_id') AND sms_status_tb.send_user_id = '$user_id' AND `sms_status_tb`.`campaign_type` = 2 AND DATE(`campaign_history`.`campaign_time`) = '$date' ");

            // dd($campaign_history);
            if($user_type == "admin")
            {
                $sql = DB::table('stake_holder_tb')
                ->orderby('stake_holder', 'ASC')
                ->get();
            }
            if($user_type == "user")
            {
                $sql = DB::table('sms_permission_stakeholder')
                ->leftJoin('stake_holder_tb', function($join)
                {
                    $join->on('sms_permission_stakeholder.permited_stakeholder', '=', 'stake_holder_tb.id');
                })
                ->where('sms_permission_stakeholder.user_id', $user_id)
                ->orderby('stake_holder_tb.stake_holder', 'ASC')
                ->get(); 
            }
            return view('campaign', compact('campaign_catagory','sms_tab','campaign_history','sql'));
        }
        else
        {
            return redirect('/');
        }
        
    }

    public function AjaxCampaign($data)
    {
        $campid = CampaignCategory::where('category', $data)->first();
        $id = $campid['id'];
        if($campid['is_parent'] == "1")
        {
            $campcatg = CampaignCategory::select('category','total_number','is_parent')->where('parent_id', $id)->get();
        }
        else
        {
            $campcatg = CampaignCategory::select('category','total_number','is_parent')->where('category', $data)->get();
        }
        return json_encode($campcatg);
    }

    public function AjaxGetStakeholder($data)
    {
        $user_id = session('id');
        if($data == "0")
        {
            $sql = DB::table('sms_permission_stakeholder')
            ->leftJoin('stake_holder_tb', function($join)
            {
                $join->on('sms_permission_stakeholder.permited_stakeholder', '=', 'stake_holder_tb.id');
            })
            ->where('sms_permission_stakeholder.user_id', $user_id)->where('stake_holder_tb.bangla', '0')
            ->orderby('stake_holder_tb.stake_holder', 'ASC')
            ->get(); 
        }
        if($data == "1")
        {
            $sql = DB::table('sms_permission_stakeholder')
            ->leftJoin('stake_holder_tb', function($join)
            {
                $join->on('sms_permission_stakeholder.permited_stakeholder', '=', 'stake_holder_tb.id');
            })
            ->where('sms_permission_stakeholder.user_id', $user_id)->where('stake_holder_tb.bangla', '1')
            ->orderby('stake_holder_tb.stake_holder', 'ASC')
            ->get(); 
        }
        return json_encode($sql);
        // return $sql;

        #** Need to update userid
    }

    public function SendSms(Request $request)
    {
        // exit;
        $datalength = Input::get("datalength");

        date_default_timezone_set('Asia/Dhaka');
        $sms_status = '0'; // Initiated
        $schedule  = '0';

        $campaign_name = Input::get("campaign_name");
        $campaign_catagory = Input::get("campaign_catagory");
        $text_tupe = Input::get("text_tupe");
        $stakeholder = Input::get("stakeholder");
        $totalsms = Input::get("totalsms");
        $msgcount = Input::get("msgcount");
        $total_processing=$totalsms;
        $total_pause=0;
        // echo $stakeholder; exit;
        if ($text_tupe == '1') 
        {
            $message = trim(Input::get("unicode"));
        }
        else
        {
            $message = trim(Input::get("message"));
            $special[0]="‘’";
	        $normal[0]='"';
	        $special[1]="“";
	        $normal[1]='"';
	        $special[2]="”";
	        $normal[2]='"';
	        $special[3]=":";
	        $normal[3]=":";
	        $special[4]=";";
	        $normal[4]=";";
	        $special[5]="~";
	        $normal[5]="~";
	        $special[6]="`";
	        $normal[6]="'";
	        $special[7]="!";
	        $normal[7]="!";
	        $special[8]="@";
	        $normal[8]="@";
	        $special[9]="#";
	        $normal[9]="#";
	        $special[10]="$";
	        $normal[10]="$";
	        $special[11]="%";
	        $normal[11]="%";
	        $special[12]="^";
	        $normal[12]="^";
	        $special[13]="&";
	        $normal[13]="&";
	        $special[14]="*";
	        $normal[14]="*";
	        $special[15]="(";
	        $normal[15]="(";
	        $special[16]=")";
	        $normal[16]=")";
	        $special[17]="’";
	        $normal[17]="'";
	        $special[18]="–";
	        $normal[18]="-";
	        $special[19]="‘";
	        $normal[19]="'";
	        $special[20]="‘";
	        $normal[20]="'";

	        $msg1 = preg_replace('/^\s|\s$/','',trim($message));
	        $message=str_replace($special,$normal,$msg1);
        }

        $user_id = session('id');
        $data = date("Y-m-d H:i:s");
        $campaign_type = '2';
        if(!empty(Input::get("schedule_time")))
        {            
            $schedule_time = Input::get("schedule_time");
            $sms_status = '0'; //Initiated
            $schedule  = '1'; 
            $scheduled_by  = $user_id;
            $total_processing=0;
            $total_pause=$totalsms;
        }

        $savestatus = false;
        $saves_tatus_history = false;
        $sessionid = md5(uniqid(rand(), true));

        $SmsStatusTb = new SmsStatusTb;   
        // Input::get("category$i")."<br>";
        // Input::get("from$i")."<br>";
        // Input::get("to$i")."<br>";
        // Input::get("smscount$i")."<br>";
        // echo "<br>--------------<br>";
        $SmsStatusTb->upload_user_id = $user_id;
        $SmsStatusTb->send_user_id = $user_id;
        $SmsStatusTb->sms_session_id = $sessionid;
        $SmsStatusTb->total_sms = $totalsms;
        $SmsStatusTb->upload_time = $data;
        $SmsStatusTb->send_time = $data;
        $SmsStatusTb->stakeholder_id =  $stakeholder;
        $SmsStatusTb->sms_status = $sms_status;
        $SmsStatusTb->campaign_name = $campaign_name;
        if(!empty(Input::get("schedule_time")))
        {
            $SmsStatusTb->scheduletime = $schedule_time;
        }
        $SmsStatusTb->scheduled = $schedule;
        $SmsStatusTb->scheduletime_previous = $data;
        $SmsStatusTb->smsfrom = "1";
        $SmsStatusTb->tb = "isms_data";
        $SmsStatusTb->campaign_type = "2";
        $SmsStatusTb->only_local = "1";
        $SmsStatusTb->sms_text = $message;
        $SmsStatusTb->schedulechange_by = "0";
        $SmsStatusTb->cancel_by = "0";
        $SmsStatusTb->cancel_remarks = "";

        $savestatus = $SmsStatusTb->save();

        for($i=0; $i<$datalength; $i++)
        {
            if(!empty(Input::get("category$i")))
            {             
                if($savestatus == true)
                {
                    $campid = SmsStatusTb::where('sms_session_id', $sessionid)->first();
                    $parent_catagory_id = CampaignCategory::where('category', $campaign_catagory)->first();
                    $sub_catagory_id = CampaignCategory::where('category', Input::get("category$i"))->first();

                    $campaignhistory = new CampaignHistory;

                    $campaignhistory->sms_status_tb_id = $campid['id'];
                    $campaignhistory->parent_category_id = $parent_catagory_id['id'];
                    $campaignhistory->campaign_session = $campid['sms_session_id'];
                    $campaignhistory->sub_category_id = $sub_catagory_id['id'];
                    $campaignhistory->campaign_time = $data;
                    $campaignhistory->number_start_from = Input::get("from$i");
                    $campaignhistory->number_end_to = Input::get("to$i");
                    $campaignhistory->total_number = Input::get("smscount$i");
                    $saves_tatus_history = $campaignhistory->save();
                }
                // echo $sessionid."==========".$campid['id']."==========".$campid['sms_session_id']."==========".$parent_catagory_id['id']."==========".$sub_catagory_id['id']."<br>";
            }
        }
        $ismssummary = new IsmsSummary;
        $ismssummary->session_id = $sessionid;
        $ismssummary->total_upload = $totalsms;
        $ismssummary->total_processing = $total_processing;
        $ismssummary->total_pause = $total_pause;
        $ismssummary->upload_date = date("Y-m-d");
        $saves_tatus_summary = $ismssummary->save();

        session(['msgcount'=> $msgcount]);

        if(($savestatus == true) && ($saves_tatus_summary == true))
        {
            $data = SmsStatusTb::where('sms_session_id', $sessionid)->first();
            return view('confirm', compact('data', 'schedule', 'sms_status'));
        }
        \Session::flash('flash_message', 'Please Select A Sub Category');
        return redirect('campaign');
    }

    public function Confirm()
    {
        echo $sms_status = Input::get("sms_status");
        echo $sessionid = Input::get("sessionid");
        $update_status = SmsStatusTb::where('sms_session_id', $sessionid)->update(['sms_status' => $sms_status]);
        \Session::flash('success', 'SMS Uploaded Successfully');
        return redirect('campaign');
    }
    public function IsmsSummery()
    {
        date_default_timezone_set('Asia/Dhaka');
        $date = date('Y-m-d');
        if(Session::has('user_id'))
        {
            $user_id = session('id');
            $user_type = session('user_type');

            if($user_type == "admin")
            {
                $sql = DB::table('stake_holder_tb')
                ->orderby('stake_holder', 'ASC')
                ->get();
            }
            if($user_type == "user")
            {
                $sql = DB::table('sms_permission_stakeholder')
                ->leftJoin('stake_holder_tb', function($join)
                {
                    $join->on('sms_permission_stakeholder.permited_stakeholder', '=', 'stake_holder_tb.id');
                })
                ->where('sms_permission_stakeholder.user_id', $user_id)
                ->orderby('stake_holder_tb.stake_holder', 'ASC')
                ->get(); 
            }

            $isms_summary = DB::select("SELECT sms_status_tb.sms_session_id,sms_status_tb.campaign_name ,sms_status_tb.total_sms ,sms_status_tb.scheduletime ,sms_status_tb.upload_time ,sms_status_tb.send_time ,sms_status_tb.sms_status ,sms_status_tb.approve_time ,stake_holder_tb.stake_holder AS stake_holder,sms_status.smsstatus,isms_summary.total_upload,total_success,total_pause,total_processing,total_invalid,total_fail FROM sms_status_tb LEFT JOIN stake_holder_tb ON stake_holder_tb.id=sms_status_tb.stakeholder_id LEFT JOIN sms_status ON sms_status.id=sms_status_tb.sms_status LEFT JOIN isms_summary ON isms_summary.session_id=sms_status_tb.sms_session_id WHERE stake_holder_tb.id IN (SELECT sht.id FROM sms_permission_stakeholder AS sps LEFT JOIN stake_holder_tb AS sht ON sht.id=sps.permited_stakeholder WHERE user_id= '$user_id') AND  DATE(sms_status_tb.upload_time) = '$date' and sms_status_tb.campaign_type = '2'");

            return view('smsstatus', compact('sql','isms_summary'));
        }
        else
        {
            return redirect('/');
        }
        
    }

    public function SummarySearch(Request $request)
    {
        date_default_timezone_set('Asia/Dhaka');
        $date_from = Input::get("date_from");
        $date_to = Input::get("date_to");
        $stakeholder = Input::get("stakeholder");
        $user_id = session('id');
        $user_type = session('user_type');

        if($user_type == "admin")
        {
            $sql = DB::table('stake_holder_tb')
            ->orderby('stake_holder_tb.stake_holder', 'ASC')
            ->get();
        }
        if($user_type == "user")
        {
            $sql = DB::table('sms_permission_stakeholder')
            ->leftJoin('stake_holder_tb', function($join)
            {
                $join->on('sms_permission_stakeholder.permited_stakeholder', '=', 'stake_holder_tb.id');
            })
            ->where('sms_permission_stakeholder.user_id', $user_id)
            ->orderby('stake_holder_tb.stake_holder', 'ASC')
            ->get(); 
        }

        if (!empty($date_from) && !empty($date_to) && !empty($stakeholder)) 
        {
            $isms_summary = DB::select("SELECT sms_status_tb.sms_session_id,sms_status_tb.campaign_name ,sms_status_tb.total_sms ,sms_status_tb.scheduletime ,sms_status_tb.upload_time ,sms_status_tb.send_time ,sms_status_tb.sms_status ,sms_status_tb.approve_time ,stake_holder_tb.stake_holder AS stake_holder,sms_status.smsstatus,isms_summary.total_upload,total_success,total_pause,total_processing,total_invalid,total_fail FROM sms_status_tb LEFT JOIN stake_holder_tb ON stake_holder_tb.id=sms_status_tb.stakeholder_id LEFT JOIN sms_status ON sms_status.id=sms_status_tb.sms_status LEFT JOIN isms_summary ON isms_summary.session_id=sms_status_tb.sms_session_id WHERE stake_holder_tb.id IN (SELECT sht.id FROM sms_permission_stakeholder AS sps LEFT JOIN stake_holder_tb AS sht ON sht.id=sps.permited_stakeholder WHERE user_id= '$user_id') AND  DATE(sms_status_tb.upload_time) BETWEEN '$date_from' AND '$date_to' and sms_status_tb.campaign_type = '2' and stake_holder_tb.stake_holder = '$stakeholder' ");

            return view('smsstatus', compact('sql','isms_summary'));
        }

        if (!empty($date_from) && !empty($date_to))
        {
            $isms_summary = DB::select("SELECT sms_status_tb.sms_session_id,sms_status_tb.campaign_name ,sms_status_tb.total_sms ,sms_status_tb.scheduletime ,sms_status_tb.upload_time ,sms_status_tb.send_time ,sms_status_tb.sms_status ,sms_status_tb.approve_time ,stake_holder_tb.stake_holder AS stake_holder,sms_status.smsstatus,isms_summary.total_upload,total_success,total_pause,total_processing,total_invalid,total_fail FROM sms_status_tb LEFT JOIN stake_holder_tb ON stake_holder_tb.id=sms_status_tb.stakeholder_id LEFT JOIN sms_status ON sms_status.id=sms_status_tb.sms_status LEFT JOIN isms_summary ON isms_summary.session_id=sms_status_tb.sms_session_id WHERE stake_holder_tb.id IN (SELECT sht.id FROM sms_permission_stakeholder AS sps LEFT JOIN stake_holder_tb AS sht ON sht.id=sps.permited_stakeholder WHERE user_id= '$user_id') AND  DATE(sms_status_tb.upload_time) BETWEEN '$date_from' AND '$date_to' and sms_status_tb.campaign_type = '2' ");

            return view('smsstatus', compact('sql','isms_summary'));
        }

        if (!empty($stakeholder)) 
        {
            $isms_summary = DB::select("SELECT sms_status_tb.sms_session_id,sms_status_tb.campaign_name ,sms_status_tb.total_sms ,sms_status_tb.scheduletime ,sms_status_tb.upload_time ,sms_status_tb.send_time ,sms_status_tb.sms_status ,sms_status_tb.approve_time ,stake_holder_tb.stake_holder AS stake_holder,sms_status.smsstatus,isms_summary.total_upload,total_success,total_pause,total_processing,total_invalid,total_fail FROM sms_status_tb LEFT JOIN stake_holder_tb ON stake_holder_tb.id=sms_status_tb.stakeholder_id LEFT JOIN sms_status ON sms_status.id=sms_status_tb.sms_status LEFT JOIN isms_summary ON isms_summary.session_id=sms_status_tb.sms_session_id WHERE stake_holder_tb.id IN (SELECT sht.id FROM sms_permission_stakeholder AS sps LEFT JOIN stake_holder_tb AS sht ON sht.id=sps.permited_stakeholder WHERE user_id= '$user_id') and sms_status_tb.campaign_type = '2' AND  stake_holder_tb.stake_holder = '$stakeholder' ");

            return view('smsstatus', compact('sql','isms_summary'));
        }
        
        else
        {
            \Session::flash('flash_message', 'Select Inputs!');
            return redirect('smsstatus')->withInput();
        }
        

    }

    public function AllData(Request $request)
    {
        $user_id = session('id');
        if(($request->fdat != "" & $request->fdat != "null") &&  ($request->todat != "" & $request->todat != "null") && ($request->stak != "" & $request->stak != "null"))
        {
            $campaign_history = DB::select("SELECT sms_status_tb.*, cc.category,campaign_category.category AS sub_category,stake_holder_tb.stake_holder AS stake_holder,campaign_history.number_start_from,campaign_history.number_end_to,campaign_history.total_number,sms_status.smsstatus FROM `sms_status_tb` LEFT JOIN `campaign_history` ON `campaign_history`.`sms_status_tb_id` = `sms_status_tb`.`id` LEFT JOIN `stake_holder_tb` ON `stake_holder_tb`.`id` = `sms_status_tb`.`stakeholder_id` LEFT JOIN `campaign_category` ON `campaign_category`.`id` = `campaign_history`.`sub_category_id` LEFT JOIN `sms_status` ON `sms_status_tb`.`sms_status` = `sms_status`.`id` LEFT JOIN `campaign_category` AS `cc` ON  `campaign_history`.`parent_category_id`= `cc`.`id` WHERE stake_holder_tb.id IN (SELECT sht.id FROM sms_permission_stakeholder AS sps LEFT JOIN stake_holder_tb AS sht ON sht.id = sps.permited_stakeholder WHERE user_id= '$user_id') AND sms_status_tb.send_user_id = '$user_id' AND `sms_status_tb`.`campaign_type` = 2 AND stake_holder_tb.stake_holder = '$request->stak' AND DATE(`campaign_history`.`campaign_time`) BETWEEN '$request->fdat' AND  '$request->todat' ");

            $arrayName2 = array('data' => $campaign_history);
            return json_encode($arrayName2);
        }
        else if(($request->fdat != "" & $request->fdat != "null") &&  ($request->todat != "" & $request->todat != "null") && ($request->stak == "null"))
        {
            $campaign_history = DB::select("SELECT sms_status_tb.*, cc.category,campaign_category.category AS sub_category,stake_holder_tb.stake_holder AS stake_holder,campaign_history.number_start_from,campaign_history.number_end_to,campaign_history.total_number,sms_status.smsstatus FROM `sms_status_tb` LEFT JOIN `campaign_history` ON `campaign_history`.`sms_status_tb_id` = `sms_status_tb`.`id` LEFT JOIN `stake_holder_tb` ON `stake_holder_tb`.`id` = `sms_status_tb`.`stakeholder_id` LEFT JOIN `campaign_category` ON `campaign_category`.`id` = `campaign_history`.`sub_category_id` LEFT JOIN `sms_status` ON `sms_status_tb`.`sms_status` = `sms_status`.`id` LEFT JOIN `campaign_category` AS `cc` ON  `campaign_history`.`parent_category_id`= `cc`.`id` WHERE stake_holder_tb.id IN (SELECT sht.id FROM sms_permission_stakeholder AS sps LEFT JOIN stake_holder_tb AS sht ON sht.id = sps.permited_stakeholder WHERE user_id= '$user_id') AND sms_status_tb.send_user_id = '$user_id' AND `sms_status_tb`.`campaign_type` = 2 AND DATE(`campaign_history`.`campaign_time`) BETWEEN '$request->fdat' AND  '$request->todat' ");

            $arrayName2 = array('data' => $campaign_history);
            return json_encode($arrayName2);
        }
        else if($request->fdat == "null" &&  $request->todat == "null" && ($request->stak != "" && $request->stak != "null"))
        {
            $campaign_history = DB::select("SELECT sms_status_tb.*, cc.category,campaign_category.category AS sub_category,stake_holder_tb.stake_holder AS stake_holder,campaign_history.number_start_from,campaign_history.number_end_to,campaign_history.total_number,sms_status.smsstatus FROM `sms_status_tb` LEFT JOIN `campaign_history` ON `campaign_history`.`sms_status_tb_id` = `sms_status_tb`.`id` LEFT JOIN `stake_holder_tb` ON `stake_holder_tb`.`id` = `sms_status_tb`.`stakeholder_id` LEFT JOIN `campaign_category` ON `campaign_category`.`id` = `campaign_history`.`sub_category_id` LEFT JOIN `sms_status` ON `sms_status_tb`.`sms_status` = `sms_status`.`id` LEFT JOIN `campaign_category` AS `cc` ON  `campaign_history`.`parent_category_id`= `cc`.`id` WHERE stake_holder_tb.id IN (SELECT sht.id FROM sms_permission_stakeholder AS sps LEFT JOIN stake_holder_tb AS sht ON sht.id = sps.permited_stakeholder WHERE user_id= '$user_id') AND sms_status_tb.send_user_id = '$user_id' AND `sms_status_tb`.`campaign_type` = 2 AND stake_holder_tb.stake_holder = '$request->stak' ");

            $arrayName2 = array('data' => $campaign_history);
            return json_encode($arrayName2);
        }
    }

    public function test()
    {
        $user_id = session('id');
        $campaign_history = DB::table('sms_status_tb')
        ->leftJoin('stake_holder_tb', function($join)
        {
            $join->on('stake_holder_tb.id', '=', 'sms_status_tb.stakeholder_id');
        })
        ->leftJoin('sms_permission_stakeholder', function($join)
        {
            $join->on('stake_holder_tb.id', '=', 'sms_permission_stakeholder.permited_stakeholder');
        })
        ->leftJoin('campaign_history', function($join)
        {
            $join->on('campaign_history.sms_status_tb_id', '=', 'sms_status_tb.id');
        })
        ->leftJoin('campaign_category', function($join)
        {
            $join->on('campaign_category.id', '=', 'campaign_history.sub_category_id');
        })
        ->where('sms_status_tb.send_user_id', session('id'))
        ->where('campaign_history.campaign_time', 'like', date('Y-m-d').'%')
        ->get();
        echo date('Y-m-d');
        echo "<pre>";
        print_r($sql);
    }
    
}
