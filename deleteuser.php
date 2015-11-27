<?php
	
	error_reporting(E_ALL);
	require 'db/connect.php' ;
	require 'function/security.php';
	

	
	if(!empty($_GET)){
		if(isset($_GET['id'])){
			
			$id=$_GET['id'];
			//$password=hash("sha512",$_POST['password']);
			//$isAdmin = $_POST['isAdmin'];
			if(!empty($id)){
				$delete=$db->prepare("DELETE FROM `wallpaper`.`admin` WHERE `admin`.`id` = ?");
				$delete->bind_param('i',$id);
				$delete->execute();
				//$delete->bind_result($id);
				header('Location: user.php');
			}
		}
		
	}
	