<?php
	/*$user="pushapi";
	$host="bulk.sslwireless.com";
	$pass="Push138.ap1";

	$database="sslcare_db";
	mysql_connect($host,$user,$pass) or die(mysql_error());
	mysql_select_db($database) or die(mysql_error());*/
	
	
	
//	$host = "localhost";
//$user_id= "root";
//$password = "";
//	$db = "sslcare_db";

	
//	$host = "192.168.181.17";
//	$user_id= "sslcare_db";
//	$password = "Ssl#124ljYfy6";
//	$db = "sslcare_db";
	
	/*$host2 = "bulk.sslwireless.com";	
	$user2= "pushapi";		
	$pass2 = "Push138.ap1";	
	$db2 = "sslcare_db";*/

	$host = "192.168.81.9";
	$user_id= "stakecreate";
	$password = "Ste#2lC3faTe";
	$db = "sslcare_db";

  try {  
	 //database connect
	  # MySQL with PDO_MYSQL  
	  $DBH = new PDO("mysql:host=$host;dbname=$db", $user_id, $password);
	  //$DBH->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
	  $DBH->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );
	  
	 /* $DBH2 = new PDO("mysql:host=$host2;dbname=$db2", $user2, $pass2);
	  //$DBH->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
	  $DBH2->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION ); */
 
      }  
  catch(PDOException $e) {  
	 // file_put_contents('PDOErrors.txt', $e->getMessage(), FILE_APPEND);
	  echo $e->getMessage();
		//file_put_contents('PDOErrors.txt', $e->getMessage(), FILE_APPEND); 
    }
	
	
	
	?>