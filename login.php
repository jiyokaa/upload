<?php
	session_start();
	error_reporting(0);
	//echo $_SESSION["auth"];
	//echo $_SESSION["username"];
	if($_SESSION["auth"] == true){
		//echo "test".$_SESSION["auth"];
		header("Location: upload.php");
		//die();
		}
	include("include/view.inc.php");
	
	getHeader("Login page for upload wallpaper","Login page for upload wallpaper");
	
	//Login Script
	require 'db/connect.php' ;
	require 'function/security.php';
	
	$records = array();
	
	if(!empty($_POST)){
		if(isset($_POST['username'], $_POST['password'])){
			
			$username=$_POST['username'];
			$password=hash("sha512",$_POST['password']);
			//echo "SELECT * FROM admin where username = '$username' and password = '$password' ";
			
			
			if(!empty($username) && !empty($password)){
				if($results=$db->query("SELECT * FROM admin where username = '$username' and password = '$password' ")){
					if($results->num_rows){
						$_SESSION["username"] = $username ;
						$_SESSION["password"] = $password ;
						$_SESSION["auth"] = true;
						header("Location: upload.php");
					}else {
						
						echo "<div class=\"alert alert-danger\">";
						echo " <a href=\"#\" class=\"close\" data-dismiss=\"alert\" aria-label=\"close\">&times;</a>";
						echo  "<strong>Login Error!</strong> Wrong username or password.";
						echo "</div>";
						
					} $results->free();
					
				} 
			}
		}
		
	}
	
?>

<main>
	<div class="container">
			<div class="row">
			<div class="col-sm-4"></div>
			<div class="col-sm-4">
				<img src="images\logo.jpg" class="img-rounded" alt="Cinque Terre" width="100%">
			</div>
			<div class="col-sm-4"></div>
		</div>
		<div class="row">
			<div class="col-sm-4"></div>
			<div class="col-sm-4">
			
				<h3>Welcome to the upload wallpaper page</h3>
				<form method = "post" action = "" role="form">
				  <div class="form-group">
					<label for="username">Username:</label>
					<input type="text" class="form-control" id="username" name="username">
				  </div>
				  <div class="form-group">
					<label for="password">Password:</label>
					<input type="password" class="form-control" id="password" name="password">
				  </div>
					
				  <button type="submit" class="btn btn-default">Submit</button>
				  <?php 
				  //if(isset($_POST['username'], $_POST['password'])){
				  //echo $_SESSION["username"].$_SESSION["password"] ; 
				  //echo $username.$password ;
				  //}
				  
				  ?>
				</form>
			
			</div>
			<div class="col-sm-4"></div>
		</div>

	</div>
</main>


<?php
	getFooter();
?>