<?php
	session_start();
	//error_reporting(0);
	//echo $_SESSION["auth"];
	//echo $_SESSION["username"];
	//if($_SESSION["auth"] == true){
	//	//echo "test".$_SESSION["auth"];
	//	header("Location: upload.php");
	//	//die();
	//	}
	include("include/view.inc.php");
	
	getHeader("Test storage","Test storage");
	
	
	
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
<div id="result"></div>

<script>
// Check browser support
if (typeof(Storage) !== "undefined") {
    // Store
    localStorage.setItem("lastname", "Smith");
    // Retrieve
    document.getElementById("result").innerHTML = localStorage.getItem("lastname");
} else {
    document.getElementById("result").innerHTML = "Sorry, your browser does not support Web Storage...";
}
</script>
			
			</div>
			<div class="col-sm-4"></div>
		</div>

	</div>
</main>


<?php
	getFooter();
?>