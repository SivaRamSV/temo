<?php session_start(); ?> 
<html>
<title>Upload</title>
	<meta content="width=device-width, initial-scale=1.0" name="viewport" >
	<link rel="stylesheet" href="css/bootstrap.min.css" type="text/css" />
	<nav class="navbar fixed-top navbar-light bg-light" style="background-color:#ff5c5c" role="navigation">
	<div class="container-fluid">
	  	 <div class="apselmass">
               <a href="index.php" class="btn btn-dangerx">Home</a>
	     </div>
    </div>
</nav>
</head>
<body>

	<img class="img-responsive center-block" src="thankyou.png" max-width:"100%" height: "auto" alt="Chania"> 
	
<?php
require('dbconnect_staff.php');
//include 'session.php';
//$type=['user'];
$type= $_SESSION['username'];
$query = mysqli_query($con,"DELETE FROM `upload`WHERE u_user='".$type."'"); 
//echo"hi there";
//session_destroy();
?>
<nav class="navbar fixed-bottom navbar-light bg-faded"style="background-color: #ff5c5c">
</nav>
</body>

</html>