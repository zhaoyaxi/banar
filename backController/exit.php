<?php
	if(!isset($_SESSION)){  
           session_start();  
        } 
	$_SESSION['login'] = 0;
	$_SESSION['name'] = "";
	$_SESSION['level'] = 0;
	$_SESSION['admin_id'] = 0;
	echo "退出成功";
		
?>