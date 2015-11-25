<?php
	session_start();
	//echo $_SESSION["auth"];
	if (!$_SESSION["auth"])
		header("Location: login.php");
	include("include/view.inc.php");
	
	getHeader("Upload Information Page","Upload Information Page");
?>

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
			<form action="upload1.php" method="POST" enctype="multipart/form-data" role="form">

				<div class="form-group">
				  <label for="image">Image:</label>
				  <input type="file" class="form-control" id="image" name="image"  >
				</div>
				
				<div class="form-group">
				  <label for="expire">Expire date:</label>
				  <input type="date" class="form-control" id="expire" name="expire">
				</div>
				
				<h4>Choose the location for your information appear</h4>
				<div class="checkbox">
				  <label><input type="checkbox" name="Classroom1" value="true">Classroom 1 (4:3)</label>
				</div>
				<div class="checkbox">
				  <label><input type="checkbox" name="Classroom2" value="true">Classroom 2 (4:3)</label>
				</div>
				<div class="checkbox">
				  <label><input type="checkbox" name="Dormitory" value="true">Dormitory (16:9)</label>
				</div>
				<div class="checkbox">
				  <label><input type="checkbox" name="ITMT" value="true">ITMT (16:9)</label>
				</div>
				<div class="checkbox">
				  <label><input type="checkbox" name="LAB" value="true">LAB (16:9)</label>
				</div>
				<div class="checkbox">
				  <label><input type="checkbox" name="Sirindralai" value="true">Sirindralai (16:9)</label>
				</div>
			<input type="submit" class="btn btn-primary" /> 
			<a href="elfinder/fileManage.php" target="_blank" class="btn btn-danger">Delete Picture Page</a> <a href="logout.php" class="btn btn-primary">Logout</a>
			
			</form>
		</div>
		<div class="col-sm-2"></div>
	</div>
</div>


<?php
	
	getFooter();

?>

</body>

</html>