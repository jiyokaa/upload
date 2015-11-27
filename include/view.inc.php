<?php
	
function getHeader($title,$header){
	?>
		<html lang="en">

		<head>
		  <title><?php echo $title ?></title>
		  <meta charset="utf-8">
		  <meta name="viewport" content="width=device-width, initial-scale=1">
		  <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
		  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
		  <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
		  <link rel="stylesheet" href="http://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.4.0/css/font-awesome.min.css">
		  <link rel="stylesheet" href="css/custom.css">
		  <style>
			h1,h2{
				text-align:center ;
			}
		  </style>
		</head>
		
	<body>

	<header>
		<div class="container">
			<div class="row">
				<div class="col-sm-12"><h1><?php echo $header ?></h1></div>
			</div><!-- end row -->
			
		</div><!-- end container -->
	</header>

	<?php
}
function getNav(){
	?>
	<nav class="navbar navbar-inverse navbar-custom">
  <div class="container-fluid">
    <div class="navbar-header">
      <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>                        
      </button>
      <a class="navbar-brand" href="index.php">Welcome <?php echo $_SESSION["name"]?></a>
    </div>
    <div class="collapse navbar-collapse" id="myNavbar">
      <ul class="nav navbar-nav">
        <li class="active"><a href="index.php">Home</a></li>
			<?php
				if($_SESSION["isAdmin"] == '1'){
			?>
				<li class="dropdown">
				  <a class="dropdown-toggle" data-toggle="dropdown" href="#">User Management<span class="caret"></span></a>
				  <ul class="dropdown-menu">
					<li><a href="user.php"><i class="fa fa-user-plus"></i> New User</a></li>
					<li><a href="passwd.php"><i class="fa fa-users"></i>Change your password</a></li>
				  </ul>
				</li>
		<?php
				}
		?>
        <li class="dropdown">
          <a class="dropdown-toggle" data-toggle="dropdown" href="#"> <i class="fa fa-task"></i> Jobs<span class="caret"></span></a>
          <ul class="dropdown-menu">
            <li><a href="listAllTicket.php?isclose=1"><i class="fa fa-play"></i> In process</a></li>
            <li><a href="listCloseTicket.php?isclose=0"><i class="fa fa-check"></i> Closed</a></li>
          </ul>
        </li>
        <li><a href="listDept.php"><i class="fa fa-building"></i> Department</a></li>
		<li><a href="admin.php"><i class="fa fa-lock"></i> Admin</a></li>
      </ul>
      <ul class="nav navbar-nav navbar-right">
		 
        <li><a href="logout.php"><span class="glyphicon glyphicon-log-in"></span> Logout</a></li>
      </ul>
    </div>
  </div>
</nav>
<?php
	
}
function getFooter(){

	echo 	"	<footer>";
	echo 	"		<div class=\"container\">";
	echo 	"			<div class=\"row\">";

	echo 	"			<div class=\"col-sm-12\">";
	echo	"<p>Version 1.0</p>";
	echo 	"				<p>Copyright  <span class=\"glyphicon glyphicon-copyright-mark\"></span> 2015 Computer and Audiovisual Center <p>";
	echo	"<p>Contact Information :K. Veraphon (ext. 4601)</p>";
	echo 	"				<p>Sirindhorn International Institute of Technology ,Thammasat University</p>";

	echo 	"			</div>";

	echo 	"			</div>";
	echo 	"		</div>";
	echo 	"	</footer>";
	echo 	"</body>";
	echo 	"</html>";

	} //end function getFooter