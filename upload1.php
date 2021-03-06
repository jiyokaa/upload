<!DOCTYPE html>
<html lang="th">
<head>
  <title>Picture Upload</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
  <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
</head>
<body>
<div class="container">
	<div class="row">
		<div class="col-sm-2"></div>
		<div class="col-sm-8">
			<h3>Upload Picture to information center</h3>
			<p>The system is support only "JPG" type.</p>
		</div>
		<div class="col-sm-2"></div>
	</div>
	
	<div class="row">
		<div class="col-sm-2"></div>
		<div class="col-sm-8">
<?php
session_start();
/*
* 	   Simple file Upload system with PHP.
* 	   Created By Tech Stream
* 	   Original Source at http://techstream.org/Web-Development/PHP/Single-File-Upload-With-PHP
*      This program is free software; you can redistribute it and/or modify
*      it under the terms of the GNU General Public License as published by
*      the Free Software Foundation; either version 2 of the License, or
*      (at your option) any later version.
*      
*      This program is distributed in the hope that it will be useful,
*      but WITHOUT ANY WARRANTY; without even the implied warranty of
*      MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
*      GNU General Public License for more details.
*     
*/
error_reporting(0);
	require 'db/connect.php' ;
	require 'function/security.php';
	include "lib/WideImage.php";
	if(isset($_FILES['image'])){
		
		//for expire date
		if (!$_POST["expire"]){
			echo "<div class=\"alert alert-danger\">";
			echo  "<strong>Error!</strong> Please input the expire date.";
			echo "</div>";
			echo "<input type=\"button\" onclick=\"history.back();\" value=\"Back\" class=\"btn btn-primary\">";
			die();
		}
		
		$date = DateTime::createFromFormat('Y-m-d', $_POST["expire"]);
		//echo $date->format('Ymd');
		//end for expire date
		$errors= array();
		//$file_name = $_FILES['image']['name'];
		$file_name = "pr ".$date->format('Ymd').$_FILES['image']['name'];
		$file_size =$_FILES['image']['size'];
		$file_tmp =$_FILES['image']['tmp_name'];
		$file_type=$_FILES['image']['type'];   
		$file_ext=strtolower(end(explode('.',$_FILES['image']['name'])));
		
		$expensions= array("jpeg","jpg"); 		
		if(in_array($file_ext,$expensions)=== false){
			$errors[]="extension not allowed, please choose a JPEG file.";
		}
		if($file_size > 2097152){
		$errors[]='File size must be excately 2 MB';
		}				
		if(empty($errors)==true){
			move_uploaded_file($file_tmp,"wallpaper/All/".$file_name);
			$path ="All"; //For paht log
			if($_POST["Classroom1"]=="true"){
				copy("wallpaper/All/".$file_name, "wallpaper/Classroom/".$file_name);
				$image = WideImage::load("wallpaper/Classroom/".$file_name);
				$resized = $image->resize(1024, 768);
				$resized->saveToFile("wallpaper/Classroom/".$file_name);
				$path.=", Classroom1";
			}
			if($_POST["Classroom2"]=="true"){
				copy("wallpaper/All/".$file_name, "wallpaper/Classroom2/".$file_name);
				$image = WideImage::load("wallpaper/Classroom2/".$file_name);
				$resized = $image->resize(1024, 768);
				$resized->saveToFile("wallpaper/Classroom2/".$file_name);
				$path.=", Classroom2";
			}
			if($_POST["Dormitory"]=="true"){
				copy("wallpaper/All/".$file_name, "wallpaper/Dormitory/".$file_name);
				$image = WideImage::load("wallpaper/Dormitory/".$file_name);
				$resized = $image->resize(1980, 1080);
				$resized->saveToFile("wallpaper/Dormitory/".$file_name);
				$path.=", Dormitory";
			}
			if($_POST["ITMT"]=="true"){
				copy("wallpaper/All/".$file_name, "wallpaper/ITMT/".$file_name);
				$image = WideImage::load("wallpaper/ITMT/".$file_name);
				$resized = $image->resize(1980, 1080);
				$resized->saveToFile("wallpaper/ITMT/".$file_name);
				$path.=", ITMT";
			}
			if($_POST["LAB"]=="true"){
				copy("wallpaper/All/".$file_name, "wallpaper/LAB/".$file_name);	
				$image = WideImage::load("wallpaper/LAB/".$file_name);
				$resized = $image->resize(1980, 1080);
				$resized->saveToFile("wallpaper/LAB/".$file_name);	
				$path.=", LAB";
			}				
			if($_POST["Sirindralai"]=="true"){
				copy("wallpaper/All/".$file_name, "wallpaper/Sirindralai/".$file_name);
				$image = WideImage::load("wallpaper/Sirindralai/".$file_name);
				$resized = $image->resize(1980, 1080);
				$resized->saveToFile("wallpaper/Sirindralai/".$file_name);
				$path.=", Sirindralai";				
			}				
			//เขียน Log
			
			$username=$_SESSION["username"];
			$fileName=$_FILES['image']['name'];
			$expire=$_POST["expire"];
			
			
			
				$insert=$db->prepare("INSERT INTO log (id, username, fileName, path, expire, updateTime) VALUES (NULL, ?, ?, ?, ?, NOW())");
				$insert->bind_param('ssss',$username, $fileName, $path, $expire);
				
				if($insert->execute()){
			echo "<div class=\"alert alert-success\">";
			echo  "<strong>Success!</strong> For the logs.";
			echo "</div>";			
					
				}
						
			
			//จบการเขียน Log
			echo "<div class=\"alert alert-success\">";
			echo  "<strong>Success!</strong> Click OK Button to return to the index page.";
			echo "</div>";			
			echo "<a href=\"upload.php\" class=\"btn btn-primary\">OK</a>";
		}else{
			print_r($errors);
		}
	}

	//echo date("Ymd",$_POST["expire"]);
	
	?>
	
		</div>
		<div class="col-sm-2"></div>
	</div>
</div>




</body>

</html>