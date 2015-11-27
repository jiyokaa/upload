<?php
	session_start();
	error_reporting(E_ALL);
	require 'db/connect.php' ;
	require 'function/security.php';
	
	$records = array();
	$error = null;
	$errorCode = null;
	if(!empty($_POST)){
			
		if(isset($_POST["oldPass"], $_POST["newPass"], $_POST["newPass2"])){
			
			//กรณีกรอกค่ามาไม่ครบ
			if($_POST["oldPass"]==''|| $_POST["newPass"]=='' || $_POST["newPass2"]==''){
				
				$errorCode=1;
				$error="<div class=\"alert alert-danger\">";
				$error.=  "<a href=\"#\" class=\"close\" data-dismiss=\"alert\" aria-label=\"close\">&times;</a>";
				$error.=  "<strong>Error!</strong> Please input your data in every box.";
				$error.= "</div>";
			}
			// กรณีกรอกค่าพาสวิร์ดใหม่ไม่เหมือนกันสองช่อง
			if( $_POST["newPass"] != $_POST["newPass2"]){
				$errorCode=1;
				$error="<div class=\"alert alert-danger\">";
				$error.=  "<a href=\"#\" class=\"close\" data-dismiss=\"alert\" aria-label=\"close\">&times;</a>";
				$error.=  "<strong>Error!</strong> New password & Confirm password mismatch.";
				$error.= "</div>";
			}
			//เรียกฐานข้อมูลเพื่อเช็คเงื่อนไข
				$username = $_SESSION["username"];
				$oldPass=hash("sha512",$_POST["oldPass"]);
				$select=$db->query("SELECT * FROM admin where username like '$username'");

				if($select->num_rows){
					while($row=$select->fetch_object()) {
						$records[]=$row;	
					}
				} $select->free();
				
			//เช็คเงื่อนไข
				foreach($records as $r){
					//กรอกพาสเวิร์ดไม่ตรง
					if($r->password!=$oldPass){
						$errorCode=1;
						$error="<div class=\"alert alert-danger\">";
						$error.=  "<a href=\"#\" class=\"close\" data-dismiss=\"alert\" aria-label=\"close\">&times;</a>";
						$error.=  "<strong>Error!</strong> Your old password is mismatch from our database.";
						$error.= "</div>";						
					}
				}
				
			//	else{
			//		$errorCode=1;
			//		$error="<div class=\"alert alert-danger\">";
			//		$error.=  "<a href=\"#\" class=\"close\" data-dismiss=\"alert\" aria-label=\"close\">&times;</a>";
			//		$error.=  "<strong>Error!</strong> Your old password is mismatch from our database.";
			//		$error.= "</div>";
			//	} 
		}
		
	}
	
	if(!empty($_POST)){
		if(isset($_POST['name'], $_POST['username'], $_POST['password'])){
			
			$name=trim($_POST['name']);
			$username=trim($_POST['username']);
			$password=hash("sha512",trim($_POST['password']));
			//$password=hash("sha512",$_POST['password']);
			$isAdmin = $_POST['isAdmin'];
			if(!empty($name) && !empty($username) && !empty($password)){
				$insert=$db->prepare("Insert Into admin (name, username, password, isAdmin) value (?, ?, ?, ?)");
				$insert->bind_param('ssss',$name, $username, $password, $isAdmin);
				
				if($insert->execute()){
					header('Location: user.php');
					die();
					
				}
			}
		}
		
	}
	

	include("include/view.inc.php");
	
	getHeader("Change the password","Change the password");	
	getNav();
?>

<body>


<div class="container">
	<div class="row">
		<div class="col-sm-2"></div><!-- end col -->
		<div class="col-sm-8">
		<!-- for error -->
		<p><?php echo ($errorCode=1?$error:'');?></p>
		<!-- form submit -->
			<form action="" method="post" role="form">
			
				<div class="form-group">
					<label for="oldPass">Your old password:</label>
					<input type="text" name="oldPass" id="oldPass" class="form-control" autocomplete="off">
				</div>
				<div class="form-group">
					<label for="newPass">Your new password:</label>
					<input type="text" name="newPass" id="newPass" class="form-control" autocomplete="off">
				</div>
				<div class="form-group">
					<label for="newPass2">Your new password (again):</label>
					<input type="text" name="newPass2" id="newPass2" class="form-control" autocomplete="off">
				</div>

				<input type="submit" value="Insert" class="btn btn-primary">
			</form>
		</div><!-- end col -->
		<div class="col-sm-2"></div><!-- end col -->
	</div><!-- end row -->
</div><!-- end container -->

	

		
	</body>
<?php
	getFooter();