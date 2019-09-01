<?php 
//include("dbconfig_full.php");


function check4bangla_stakeholder($stake_holder)
{
    $bangla=0;
     $sql_bangla = "select count(*) as total from stake_holder_tb where stake_holder='$stake_holder' and bangla=1";
    //  echo $sql_bangla;
    $result_bangla = mysql_query($sql_bangla) or die("Error ". mysql_error());
    $num_rows_bangla=mysql_fetch_array($result_bangla) or die("Error ". mysql_error());
    //  echo "bangla=".$num_rows_bangla['total'];
    if($num_rows_bangla['total']>0)
    {
        $bangla=1;
        return true;
    }
    else
        return false;


    /* End of bangla SMS check */

}

function check_sms_count($sms,$type)
{
    $msg_len=strlen($sms);
    if($type==1)// Bangla
    {
        $no_sms= ceil($msg_len/280);
        if($no_sms>1)
        {
            $no_sms= ceil($msg_len/268);
        }
    }
    else
    {
        $no_sms= ceil($msg_len/160);
        if($no_sms>1)
        {
            $no_sms= ceil($msg_len/153);
        }

    }
    return $no_sms;

}
//
//function hex2bin($hex) {
//    if (strlen($hex) % 2)
//        $hex = "0".$hex;
//    $bin = '';
//    for ($i = 0; $i < strlen($hex); $i += 2) {
//        $bin .= chr(hexdec(substr($hex, $i, 2)));
//    }
//
//    return $bin;
//}

function LogSQLError($mysql_error_msg,$script, $sql,  $user_id, $log_date, $table)
{

echo "ok";
    $sql = str_replace("'", "|", $sql);
    $mysql_error_msg = str_replace("'", "|", $mysql_error_msg);
    $sql="INSERT into mysql_error_log_tb (mysql_error_log, script_name, query, user_id, datetime,table_name)values('".$mysql_error_msg."', '".$script."', '".$sql."','".$user_id."','".$log_date."','".$table."')";
	
	$log_result=mysql_query($sql) or die("error:".mysql_error());
	//$log_result=mysql_query($sql) or CreateLogFile('mysql', 'LogSQLError', '', 'Could not insert into mysql_error_logs table! SQL: '.$sql.' MySQL Error:' . mysql_error());
}


function user_access_log($dbconnect=1,$user_id,$user_name,$page,$purpose)
{

    if($dbconnect==1)
        include("dbconfig_full.php");


    $sql="INSERT into user_access_log (user_id,user_name,page_name,purpose,datetime,date)values('".$user_id."', '".$user_name."', '".$page."','".$purpose."','".date("Y-m-d H:i:s")."','".date("Y-m-d")."')";

    $log_result=mysql_query($sql) or die("error:".mysql_error());

    if($dbconnect==1)
        mysql_close();
}

function multi_unique($array)
 {
        foreach ($array as $k=>$na)
		{
            $new[$k] = serialize($na);
		}	
        $uniq = array_unique($new);
        foreach($uniq as $k=>$ser)
            $new1[$k] = unserialize($ser);
        return ($new1);
  }

 function masking($cardno)
 {
 	return substr($cardno,0,3)."***".substr($cardno,-3,3);
 }
 
 
 
function SaveFile($filename, $contents) {
	try{
		$handle = fopen($filename, 'a');
		if($handle) {
			fputs($handle, $contents."\n");
			fclose($handle);
			//echo "File saved to $filename";
			return true;
		} else {
			return false;
		}
	}catch(exception $ex){
		//echo "Caught exception during saving of logs. Exception: $ex";
		return false;
	}		
}
function CreateLogs($initials, $log, $filename="") {
	//return false;
	try{
		// Desired folder structure
		$mdir = $initials;
		$subdir = date("Ymd");
		//$structure = 'http://localhost/sslcare/live/user_logs/'.$mdir.'/'.$subdir.'/';
		$structure = '/var/www/logs/ismscampaign/user_logs/'.$mdir.'/'.$subdir.'/';
		if(is_dir($structure)) 
		{
			$time = date("Y-m-d-H");
			if($filename=="" || $filename==null)
				$filename=$initials."_".$time.".txt"; //$filename=$time."_$initials".".txt";
			$Log_File = $structure.$filename;
			$now = date("Y-m-d H:i:s");
			return SaveFile($Log_File, $now." - ".$log);
		} else if (mkdir($structure, 0777, true)) 
		{
			// To create the nested structure, the $recursive parameter
			// to mkdir() must be specified.
			//chmod('logs/'.$mdir, 0777);
			//chmod('logs/'.$mdir.'/'.$subdir, 0777);
			//echo "Directory created $structure";
			$time = date("Y-m-d-H");
			if($filename=="" || $filename==null)
				$filename=$initials."_".$time.".txt"; //$filename=$time."_$initials".".txt";
			$Log_File = $structure.$filename;
			$now = date("Y-m-d H:i:s");
			return SaveFile($Log_File, $now." - ".$log);
		} 
		else 
		{
			//die('Failed to create folders...');
			//SendAdminAlert($visitor_ip, "$stakeholder balance is low at BDT $balance. Pls recharge immediately.");
			//echo "Failed to create logs.";
			return false;
		}
	}catch(exception $ex){
		//SendAdminAlert($visitor_ip, "$stakeholder balance is low at BDT $balance. Pls recharge immediately.");
		//echo "Caught exception during creation of logs. Exception: $ex";
		return false;
	}
}
	
?>
