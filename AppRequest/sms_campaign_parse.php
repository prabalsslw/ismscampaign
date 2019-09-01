<?php
if(isset($_SERVER['HTTP_REFERER']))
{
$temp=explode("?",$_SERVER['HTTP_REFERER']);
$ref_page=$temp[0];
}
else
    $ref_page="Unknown";
//$ref_page="local";
//echo $ref_page;
include('common.php');
include('validate.php');
include('dbconfig.php');
if(isset($_REQUEST['user_id']))
{
    $user_id=trim($_REQUEST['user_id']);
}
else
    $user_id="Unknown";

$visitor_ip = $user_id."_".$_SERVER['REMOTE_ADDR'];	
$request_ip=trim($_SERVER['REMOTE_ADDR']);
CreateLogs_campaign_parse($visitor_ip, "*****************************************************************");	
CreateLogs_campaign_parse($visitor_ip, "*********************Start of SMS Campaign parse*******************");
CreateLogs_campaign_parse($visitor_ip, "Comming from page : ".$ref_page);

//http://demo.sslwireless.com/care/sms/sms_file_parse.php?user_id=application&pass=1103sslpass@2016&ses_id=587cca38901da9.323051887527206
//http://localhost/ismscampaign/AppRequest/sms_campaign_parse.php?user_id=application&pass=1103sslpass@2016&ses_id=7419e1e207879b2fd6166f06cb16195d
//if(1==1)
if($request_ip=='192.168.69.165' || $request_ip=='192.168.69.182' || $request_ip=='192.168.91.153' || $request_ip=='192.168.69.169' || $request_ip=='192.168.70.141'||$request_ip=='::1')
{
		
if((isset($_REQUEST['user_id']) && !empty($_REQUEST['user_id'])) && (isset($_REQUEST['pass']) && !empty($_REQUEST['pass']))&& (isset($_REQUEST['ses_id']) && !empty($_REQUEST['ses_id'])))
	{
			set_time_limit(600);
			ini_set('memory_limit','2000M');
			date_default_timezone_set('Asia/Dhaka');
			$ses_id=trim($_REQUEST['ses_id']);
			$user_id=trim($_REQUEST['user_id']);
			$pass=trim($_REQUEST['pass']);
			if($user_id=='application' && $pass=='1103sslpass@2016')
			{

					try{
						
					
											CreateLogs_campaign_parse($visitor_ip, "User and session id is ok");						 
											CreateLogs_campaign_parse($visitor_ip, "Trying to connect : bulk.sslwireless.com");
										    //$dbcon1 = mysql_connect('bulk.sslwireless.com','stakecreate','1SMS.slTake.C') or CreateLogs_campaign_parse($visitor_ip, "Connection Error : ".mysql_error());
										
											CreateLogs_campaign_parse($visitor_ip, date("Y-m-d H:i:s---")."Trying to connect : 192.168.81.9");
										//	$dbcon1 = mysql_connect('localhost','root','') or CreateLogs_campaign_parse($visitor_ip, date("Y-m-d H:i:s---")."Connection Error : ".mysql_error());
											//$dbcon1 = mysql_connect('demo.sslwireless.com','demouser','demouser@ssl') or CreateLogs_campaign_parse($visitor_ip, date("Y-m-d H:i:s---")."Connection Error : ".mysql_error());
                                           // $dbcon1 = mysql_connect('bulk.sslwireless.com','stakecreate','1SMS.slTake.C') or CreateLogs_campaign_parse($visitor_ip,"Connection Error : ".mysql_error());
                                            //$dbcon1 = mysql_connect('192.168.81.9','sslcare_db','Ssl#124ljYfy6') or CreateLogs_campaign_parse($visitor_ip,"Connection Error : ".mysql_error());
                       // $dbcon1 = mysql_connect('192.168.181.17','sslcare_db','Ssl#124ljYfy6') or CreateLogs_campaign_parse($visitor_ip,"Connection Error : ".mysql_error());

                                        //    mysql_select_db('sslcare_db',$dbcon1) or CreateLogs_campaign_parse($visitor_ip, "Connection Error : ".mysql_error());
											//echo "<br /> Query to find campaign=".date("Y-m-d H:i:s");	
                                             // Status 14 =File Processing Start
     									// 	   $q="update  sms_status_tb set sms_status='14',file_process_start='".date("Y-m-d H:i:s")."',status_update_time='".date("Y-m-d H:i:s")."' where sms_status='12' and sms_status_tb.sms_session_id='".mysql_real_escape_string($ses_id)."'";
                                           //  $result56 = mysql_query($q) or CreateLogs_campaign_parse($visitor_ip, "Update Query:".$q."  Update Error : ".mysql_error());
                                       echo       $sql = "update  sms_status_tb set sms_status='14',file_process_start='".date("Y-m-d H:i:s")."',status_update_time='".date("Y-m-d H:i:s")."' where sms_status='12' and sms_status_tb.sms_session_id='".$ses_id."'";

                                            //$STH = $DBH->query($sql);
                                             $STH = $DBH->prepare($sql);
                                             $STH->execute();

                                             $num_rows = $STH->rowCount();
                                            if($num_rows>0)
                                            {

												CreateLogs_campaign_parse($visitor_ip, date("Y-m-d H:i:s---")."Query: ".$sql);
											//echo "<br /> Query to update campaign as read=".date("Y-m-d H:i:s");	
                                              //  $result4 = mysql_query($q4) or  CreateLogs_campaign_parse($visitor_ip, "Select Query:".$q4."  Select Error : ".mysql_error());

                                            echo "<br />".   $sql2 = "SELECT campaign_history.sub_category_id,campaign_history.number_start_from,campaign_history.total_number,stake_holder_tb.bangla,stake_holder_tb.guid,stake_holder_tb.stake_holder,sms_status_tb.sms_text,sms_status_tb.remove_duplicate_on,sms_status_tb.only_local,sms_status_tb.sms_session_id,sms_status_tb.file_name,sms_status_tb.scheduled,sms_status_tb.total_sms,stake_holder_tb.priority_level,stake_holder_tb.priority_table
FROM sms_status_tb
LEFT JOIN stake_holder_tb ON stake_holder_tb.id=sms_status_tb.stakeholder_id
LEFT JOIN `campaign_history` ON campaign_history.campaign_session=sms_status_tb.sms_session_id
WHERE  campaign_history.pull_status='0' and sms_status_tb.sms_status='14' AND sms_status_tb.campaign_type='2' and sms_status_tb.sms_session_id='".$ses_id."' order by sms_status_tb.id";

                                                $STH2 = $DBH->query($sql2);
                                                $num_rows2 = $STH2->rowCount();
                                                if($num_rows2>0)
                                                {
                                                    $all_data =  array();
                                                    $i=0;
                                                    $total_inserted=0;
                                                    $f=0;
                                                    $uploaded_total=0;
                                                    $row = 1;
                                                    $wrong_data=0;
                                                    $first_data=0;
                                                    $last_data=0;
                                                    $chk_data=0;
                                                    $total_valid_data=0;
                                                    $all_data =  array();

                                                    while($fetch2=$STH2->fetch())
                                                    {
                                                        $remove_duplicate_on= $fetch2['remove_duplicate_on'];
                                                       // echo "<br />st=".
                                                            $fetch_stake_holder=$fetch2['stake_holder'];
                                                      //  echo "<br />guid=".
                                                            $fetch_guid=$fetch2['guid'];
                                                      //  echo "<br />text=".
                                                            $fetch_sms_text=$fetch2['sms_text'];
                                                        $total_sms=trim($fetch2['total_sms']);
                                                        $file_name=trim($fetch2['file_name']);
                                                        $text_type=trim($fetch2['bangla']);
                                                        $total_pause=0;
                                                        $total_processing=0;
                                                        $ses_id=$fetch2['sms_session_id'];
                                                        $only_local=$fetch2['only_local'];


                                                        // for 2007 formated excel file. with extansion xlsx

                                                        //	echo "<br /> After upload=".date("Y-m-d H:i:s");

                                                        $limit_from=$fetch2['number_start_from']-1;
                                                        $limit_to=$fetch2['total_number'];

                                                      //  $result1 = mysql_query($q1) or  CreateLogs_campaign_parse($visitor_ip, "Select Query Select campaign_data:".$q1."  Select Error : ".mysql_error());
                                                   echo "<br />".   $sq3 = "SELECT * FROM campaign_data WHERE category_id='".$fetch2['sub_category_id']."' LIMIT ".$limit_from.",".$limit_to."";

                                                        $STH3 = $DBH->query($sq3);
                                                        $num_rows3 = $STH3->rowCount();
                                                        if($num_rows3>0)
                                                        {
                                                            $n=0;
                                                          //  echo "<br /> Category".$fetch2['sub_category_id'];
                                                            while($fetch3=$STH3->fetch())
                                                            {
                                                              //  echo "<br /> Mobile No".$fetch3['mobile_no'];
                                                                $all_data[$i++]=$fetch3['mobile_no'];
                                                                $n++;
                                                            }

                                                        }
                                                        echo "<br />".            $sq4 = "update campaign_history set pull_status='1', pull_count='".$n."',pull_complete_time='".date("Y-m-d H:i:s")."' where campaign_session='".$ses_id."' and sub_category_id='".$fetch2['sub_category_id']."'";
                                                       // $STH4 = $DBH->query($sql4);
                                                        $STH4 = $DBH->prepare($sq4);
                                                        $STH4->execute();
                                                    //  echo  $q6="update campaign_history set pull_status='1', pull_count='".$n."',pull_complete_time='".date("Y-m-d H:i:s")."' where campaign_session='".$ses_id."' and sub_category_id='".$fetch2['sub_category_id']."'";
                                                     //   mysql_query($q6) or  CreateLogs_campaign_parse($visitor_ip,"campaign_history update Query:".$q6." Error : ".mysql_error());
                                                    }


//                                                    	echo "<pre>";
//                                                    echo print_r($all_data);
//                                                    echo "<pre/>";
                                                   // die();
																//echo "<br /> File read complete=".date("Y-m-d H:i:s");	
															CreateLogs_campaign_parse($visitor_ip, "File read complete. Sessionid=".$ses_id);
																 
			//***********************************************start checking duplicate number*****************************************
															// echo "<br /> before duplicate check=".date("Y-m-d H:i:s");
															 $valid_data =  array();															 
															 CreateLogs_campaign_parse($visitor_ip, "Check duplicate field value: ".$remove_duplicate_on.". Sessionid=".$ses_id);
                                                           //  echo "Duplicate=".$remove_duplicate_on;
															  if($remove_duplicate_on==1)
															 {
																 
																CreateLogs_campaign_parse($visitor_ip," Check duplicate started. Sessionid=".$ses_id);
															 	$valid_data=multi_unique($all_data);
															 	CreateLogs_campaign_parse($visitor_ip, "Check duplicate completed. Sessionid=".$ses_id);
															  
															 }
															 else
															 $valid_data=$all_data;
															 $total_valid_data=count($valid_data);

													//	echo "valid-data=".var_dump($valid_data);
                                                  //  die(1);
															CreateLogs_campaign_parse($visitor_ip, "total data fount:".$total_valid_data);
//*******************************************************End checking duplicate number*****************************************	
													//	echo "<br /> after duplicate check=".date("Y-m-d H:i:s");			
																 if($total_valid_data>0)
																{  // update summary table to view from sms status report when its scheduled
                                                                    if($fetch2['scheduled']==1)
                                                                    {
                                                                       //  $q5="update isms_summary set total_pause='0',total_processing='".$total_sms."',update_time='".date("Y-m-d H:i:s")."' where session_id='".$ses_id."'";
                                                                     //   mysql_query($q5) or  CreateLogs_campaign_parse($visitor_ip,"summary update Query:".$q5." Error : ".mysql_error());
                                                                       // mysql_query($q5) or  die("summary update Query:".$q5." Error : ".mysql_error());
                                                                        echo "<br />".           $sq5 = "update isms_summary set total_pause='0',total_processing='".$total_sms."',update_time='".date("Y-m-d H:i:s")."' where session_id='".$ses_id."'";
                                                                       // $STH5 = $DBH->query($sql5);
                                                                       
                                                                        $STH5 = $DBH->prepare($sq5);
                                                                        $STH5->execute();
                                                                    }

																		
																		if($fetch2['priority_level']==1)
                                                                        {
                                                                            $isms_table=trim($fetch2['priority_table']);

                                                                            if($total_valid_data>=500)// when total uploaded sms is more than it will send by regular apps. Others will be send by separate apps. so that small quantity can go faster.
                                                                                $priority=10;
                                                                            else
                                                                                $priority=1;

                                                                        }
                                                                        else
                                                                        {
                                                                            $isms_table='isms_data';
                                                                            if($total_valid_data>=10000)// when total uploaded sms is more than it will send by regular apps. Others will be send by separate apps. so that small quantity can go faster.
                                                                                $priority=10;
                                                                            else if($total_valid_data>=5000)
                                                                                $priority=6;
                                                                            else if($total_valid_data>=500)
                                                                                $priority=4;
                                                                            else
                                                                                $priority=1;
                                                                        }

																		//echo "<br /> <br /> <br />Start of data insert=".date("Y-m-d H:i:s");	
																		CreateLogs_campaign_parse($visitor_ip, "Start of data insert. Sessionid=".$ses_id);
																	$j=0;
																	$q2="";
																	$i=0;
                                                                     if($text_type=='1')// Bangla text.
																	    $bulk_insert_no='500';
                                                                     else               //English text
                                                                         $bulk_insert_no='1000';


																	$left_data=	$total_valid_data;

                                                                   // $sq5 = "update isms_summary set total_pause='0',total_processing='".$total_sms."',update_time='".date("Y-m-d H:i:s")."' where session_id='".$ses_id."'";
                                                                   // $STH5 = $DBH->query($sql5);
                                                                   		$q="insert ignore into $isms_table (smsto,stakeholder,clguid,message,in_msg_id,smsdate,sms_status,session_id,priority) values";
                                                                // 	for($i=0;$i<$total_valid_data;$i++)
																	foreach($valid_data as $vd)	
																	{
																			$j++;
																			$in_msg_id=$ses_id."-".$i++;																		
																			if($j==1)
																			$q2.=" ('".$vd."','".$fetch_stake_holder."','".$fetch_guid."','".$fetch_sms_text."','".$in_msg_id."','".date("Y-m-d H:i:s")."','processing','".$ses_id."','".$priority."')";
																			else
																			$q2.=", ('".$vd."','".$fetch_stake_holder."','".$fetch_guid."','".$fetch_sms_text."','".$in_msg_id."','".date("Y-m-d H:i:s")."','processing','".$ses_id."','".$priority."')";
																			
																		
																			$total_inserted++;
																		if($j==$bulk_insert_no && $left_data<=$total_valid_data)
																		{

                                                                            $query=$q.$q2;

                                                                            $STH6 = $DBH->prepare($query);
                                                                            if($STH6->execute())
																			{
																				$left_data=$left_data-$j;
																				$j=0;
																				$q2="";
																			}
																			else
																			{
																				CreateLogs_campaign_parse($visitor_ip, "insert Query:".$query."  Insert Error : ");
																			}
																		}
																		else if( $left_data==$j)
																		{
																			
																			$query=$q.$q2;

                                                                            $STH6 = $DBH->prepare($query);
                                                                            if($STH6->execute())
                                                                            {
																					$left_data=$left_data-$j;
																					$j=0;
																					$q2="";
																				//	echo "<br /><br />.Less then; Bulk insert query: ".$query;
																			}
																			else
																			{
																				//echo "<br /><br />insert Query:".$query."  Insert Error : ".mysql_error();
																				//echo "<br /><br /> Insert Error : ".mysql_error();
																				CreateLogs_campaign_parse($visitor_ip, "insert Query:".$query."  Insert Error : ");
																			}
																		}

																	}	
																	
																	//echo "<br /> End of data insert=".date("Y-m-d H:i:s");	
																	CreateLogs_campaign_parse($visitor_ip, "End of data insert. Sessionid=".$ses_id);
																}
																// echo "<br /> After database insert=".date("Y-m-d H:i:s");
																
																if($total_inserted>0)
																{
																	$sms_status='15';// File parsed successfully.
                                                                    if($fetch2['scheduled']==1)             // scheduled =2 need to update
																	    $q3="update  sms_status_tb set file_process_end='".date("Y-m-d H:i:s")."',file_total_data_inserted='".$total_inserted."',sms_status='".$sms_status."',scheduled='2',status_update_time='".date("Y-m-d H:i:s")."' where sms_session_id='".$ses_id."'";
																	else
                                                                        $q3="update  sms_status_tb set file_process_end='".date("Y-m-d H:i:s")."',file_total_data_inserted='".$total_inserted."',sms_status='".$sms_status."',status_update_time='".date("Y-m-d H:i:s")."' where sms_session_id='".$ses_id."'";


                                                                    CreateLogs_campaign_parse($visitor_ip, "Data Inserted Successfully");
																	$response=array('status'=>'Success','message'=>'Data Inserted Successfully','count'=>$total_inserted,'session_id'=>$ses_id);
																}
																else
																{
																	
																	$sms_status='13';// File parsed failed.
																	$q3="update  sms_status_tb set file_process_end='".date("Y-m-d H:i:s")."',sms_status='".$sms_status."',status_update_time='".date("Y-m-d H:i:s")."' where sms_session_id='".$ses_id."'";
																	CreateLogs_campaign_parse($visitor_ip, "Fail to insert Data");
																	$response=array('status'=>'Fail','message'=>'Fail to insert Data');
																}

                                                               //  mysql_query($q3) or  die("Update Query:".$q3."  Update Error : ".mysql_error());
                                                                CreateLogs_campaign_parse($visitor_ip," Update query:".$q3);
																//mysql_query($q3) or  CreateLogs_campaign_parse($visitor_ip, "Update Query:".$q3."  Update Error : ".mysql_error());
															//	mysql_close($dbcon1);
                                                    echo "<br />".  $q3;

                                                                $STH7 = $DBH->prepare($q3);
                                                                if($STH7->execute())
                                                                {

                                                                }
                                                                else
                                                                {
                                                                    CreateLogs_campaign_parse($visitor_ip, "Update Query:".$q3."  Update Error : ");
                                                                }

																CreateLogs_campaign_parse($visitor_ip, "End of sms send successfully");
													}
													else
													{
														
														CreateLogs_campaign_parse($visitor_ip, "No data found for the campaign");
														$response=array('status'=>'Fail','message'=>'No data found for the campaign');
										
													}

                                                   
                                                }
                                                else
                                                {
													CreateLogs_campaign_parse($visitor_ip, "Unable to change campaign status. To parse File.");
													$response=array('status'=>'Fail','message'=>'Unable to change campaign status. To parse File.');
													                                                   
                                                }
					}
					catch(Exception $e)
					{
						CreateLogs_campaign_parse($visitor_ip, "Exception occured".$e->getMessage());
						$response=array('status'=>'Fail','message'=>'Exception occured'.$e->getMessage());
													  
					}

		}
		else
		{
			CreateLogs_campaign_parse($visitor_ip, "Invalid User or password");
			$response=array('status'=>'Fail','message'=>'Invalid User or password');
			
		 }	
	}	 
	else
	{
		CreateLogs_campaign_parse($visitor_ip, "All the parameter not found");
	    $response=array('status'=>'Fail','message'=>'All the parameter not found');
			
	}
 
 }
else
{
	CreateLogs_campaign_parse($visitor_ip,"Invalid rquester. IP is ".$requst_ip);
	$response=array('status'=>'Fail','message'=>'Invalid rquester. IP is '.$request_ip);
}		 

CreateLogs_campaign_parse($visitor_ip,"Response".json_encode($response));
CreateLogs_campaign_parse($visitor_ip, "*************End OF Send SMS Campaign parse *****************");
CreateLogs_campaign_parse($visitor_ip, "*****************************************************************");	
echo json_encode($response);

//try { $stmt->execute();}
//catch(PDOException $e){echo $e->getMessage();}



function SaveFile2($filename, $contents) {
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
function CreateLogs_campaign_parse($initials, $log, $filename="") {
	//return false;
    try{
        // Desired folder structure
        $mdir = $initials;
        $subdir = date("Ymd");
        $structure = '/var/www/logs/ismscampaign/campaign_parse/'.$subdir.'/'.$mdir.'/';
        if(is_dir($structure)) {
            $time = date("Y-m-d-H");
            if($filename=="" || $filename==null)
                $filename=$initials."_".$time.".txt"; //$filename=$time."_$initials".".txt";
            $Log_File = $structure.$filename;
            $now = date("Y-m-d H:i:s");
            return SaveFile($Log_File, $now." - ".$log);
        } else if (mkdir($structure, 0777, true)) {
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