<?php
	/*$user="pushapi";
	$host="";
	$pass="";

	$database="";
	mysql_connect($host,$user,$pass) or die(mysql_error());
	mysql_select_db($database) or die(mysql_error());*/
	
	
	
//	$host = "localhost";
//$user_id= "root";
//$password = "";
//	$db = "";

	
//	$host = "";
//	$user_id= "";
//	$password = "";
//	$db = "";
	
	/*$host2 = "";	
	$user2= "";		
	$pass2 = "";	
	$db2 = "";*/

	$host = "";
	$user_id= "";
	$password = "";
	$db = "";

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
