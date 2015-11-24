<?php

	$db=new mysqli('127.0.0.1','root','','wallpaper');
	
	if($db->connect_errno){
		
		echo $db->connect_error;
		//die('Sorry we are having some problem.');
		
	}
	

