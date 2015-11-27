<?php
	session_start();
	error_reporting(E_ALL);
	require 'db/connect.php' ;
	require 'function/security.php';
	
	$records = array();
	
	if(!empty($_POST)){
		if(isset($_POST['name'], $_POST['username'], $_POST['password'])){
			
			$name=trim($_POST['name']);
			$username=trim($_POST['username']);
			$password=hash("sha512",trim($_POST['password']));
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
	
	if($results=$db->query("SELECT * FROM admin")){
		if($results->num_rows){
			while($row=$results->fetch_object()) {
				$records[]=$row;	
			}	
		}	$results->free();
	}
	include("include/view.inc.php");
	
	getHeader("User Manager","User Manager");	
	getNav();
?>

<body>
<div class="container">
	<div class="row">
		<div class="col-sm-2"></div><!-- end col -->
		<div class="col-sm-">
		
		
					<?php
						if(!count($records)){
							echo 'No records';
						} else {
					?>
				<table class="table table-striped table-hover">
					<thead>
						<tr>
							<th>No.</th>
							<th>Name</th>
							<th>User Name</th>							
							<th>Account Type</th>
							<th>Delete</th>
						</tr>
					</thead>
					<tbody>
						<?php
							$i=1;
						foreach($records as $r){
						?>
						<tr>
							<td><?php echo $i; ?></td>
							<td><?php echo escape($r->name); ?></td>
							<td><?php echo escape($r->username); ?></td>
							
							<td><?php echo ($r->isAdmin=='1'?'Admin':'User'); ?></td>
							<td><?php echo "<a href='deleteuser.php?id=$r->id' onClick=\"return confirm('are you sure you want to delete??');\"><i class=\"fa fa-minus-circle fa-2x\" style=\"color:red\"></i> </a>"; ?></td>
						<tr>
						<?php
							$i++;
							}//end foreach
						}//end else
						?>
					</tbody>
				
				</table>
						
		
		
		</div><!-- end col -->
		<div class="col-sm-2"></div><!-- end col -->
	</div><!-- end row -->
</div><!-- end container -->

<div class="container">
	<div class="row">
		<div class="col-sm-2"></div><!-- end col -->
		<div class="col-sm-8">
		<!-- form submit -->
			<form action="" method="post" role="form">
			
				<div class="form-group">
					<label for="name">Name & Surname:</label>
					<input type="text" name="name" id="name" class="form-control" autocomplete="off">
				</div>
				<div class="form-group">
					<label for="username">User Name:</label>
					<input type="text" name="username" id="username" class="form-control" autocomplete="off">
				</div>
				<div class="form-group">
					<label for="password">Password:</label>
					<input type="password" name="password" id="password" class="form-control" autocomplete="off">
				</div>
				<div class="form-group">
					<label class="radio-inline"><input type="radio" name="isAdmin" value="1">Admin</label>
					<label class="radio-inline"><input type="radio" name="isAdmin" value="0" checked="checked">User</label>
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