<?php

function valid_msisdn($msisdn)
{

	if(substr($msisdn,0,1)=='+')
	{
				$temp=explode("+",$msisdn);
				$msisdn=$temp['1'];
	}
	
	if(CheckNumber($msisdn)) // check valid local msisdn
	{	
		
		return true;
	}
	else
	{
			
			if(is_numeric($msisdn) && substr($msisdn,0,4)!='8801' && substr($msisdn,0,2)!='80' && strlen($msisdn)>=9 && strlen($msisdn)<=15)
			{			
					if(substr($msisdn,0,3)=='011' || substr($msisdn,0,3)=='015' || substr($msisdn,0,3)=='016' || substr($msisdn,0,3)=='017' || substr($msisdn,0,3)=='018' || substr($msisdn,0,3)=='019'){
							return false;
						}
						else
							return true;
					
			}
			else
				return false;
	 }		

 }

function CheckNumber($msisdn) 
{
	$regexp = "/^(88|)01[1,5,6,7,8,9]{1}[0-9]{8}$/";
	if(preg_match($regexp, $msisdn)) return true;
	return false;
} 

function valid_msisdn_only_local($msisdn)
{

	if(substr($msisdn,0,1)=='+')
	{
				$temp=explode("+",$msisdn);
				$msisdn=$temp['1'];
	}
	
	if(CheckNumber($msisdn)) // check valid local msisdn
	{	
		return true;
	}
	else
	{
		return false;
	}		

 }
//$msisdn='8801913900620';
//echo valid_msisdn_only_local($msisdn);
	

?>