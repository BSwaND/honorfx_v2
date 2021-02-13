<?php
	if(isset($_GET['k']))
	{
		require_once(JPATH_BASE . '/templates/custom/crypt/Aes.php');
		require_once(JPATH_BASE . '/templates/custom/crypt/Aesctr.php');
		$encryption_key = 'honorfx.com';
		
		$aesctr = str_replace(['-', '_', '*', '.'], ['+', '/', '=', ','], $_GET['k']);
		$decrypt = Aesctr::decrypt($aesctr, $encryption_key, 256);
		$user_id = number_format($decrypt, 0);
		
		$now_date = date("Y-m-d H:i:s");
		$date_half_year = time() + (strtotime('1 year')-time())/2;
		
		$reg_first_user = md5('bonus.?IB?.first_user.reg_link');
		$reg_first_user_date = md5('bonus.?IB?.first_user.reg_link.date');
		
		$reg_second_user = md5('bonus.?IB?.second_user.reg_link');
		$reg_second_user_date = md5('bonus.?IB?.second_user.reg_link.date');
		
		if(array_key_exists($reg_first_user, $_COOKIE) && $_COOKIE[$reg_first_user] != '') {
			
			if(!array_key_exists($reg_second_user, $_COOKIE) && $_COOKIE[$reg_second_user] == '' && $_COOKIE[$reg_first_user] != $user_id) {
				
				$date_year = strtotime($_COOKIE[$reg_first_user_date]) + (strtotime('1 year')-time());
				
				setcookie($reg_second_user, $user_id, $date_year, '/', 'honorfx.com');
				setcookie($reg_second_user_date, $now_date, $date_year, '/', 'honorfx.com');
			}
		}else{
			
			setcookie($reg_first_user, $user_id, $date_half_year, '/', 'honorfx.com');
			setcookie($reg_first_user_date, $now_date, $date_half_year, '/', 'honorfx.com');
		}
		
	}