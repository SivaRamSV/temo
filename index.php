<?php
require('dbconnect.php');

session_start();

?>
<!DOCTYPE html>
<html>
<head>
	<title>Upload</title>
	<meta content="width=device-width, initial-scale=1.0" name="viewport" >
	<link rel="stylesheet" href="css/bootstrap.min.css" type="text/css" />
</head>
<body>

<nav class="navbar fixed-top navbar-light bg-light" style="background-color:#ff5c5c" role="navigation">
	<div class="container-fluid">
		<!-- add header -->
		<div class="navbar-header">
			<button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#navbar1">
				<span class="sr-only">Toggle navigation</span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
			</button>
	  	
		
		</div>
		<!-- menu items -->
		
	</div>
</nav>
	<img class="img-responsive center-block" src="tem00.png" max-width: "100%" height: "auto" alt="Chania"> 
	
<div class="container-fluid">
    <div class="row">
        <div class="col-sm-6">
          <div class="well">
			<form role="form" action="/projectx/generate_token.php" method="post" name="loginform"enctype="multipart/form-data">
				<fieldset>
					<legend>Upload File</legend>
				
					<div class="form-group">
						<label for="name">Name</label>
						<input type="text" name="name" placeholder="Your Name" required class="form-control"/>
					</div>
                    <div class="form-group">
						<label for="name">File</label>
						<input type="file" name="file" required class="form-control" />
					</div>
					<div class="form-group">
						<label for="name">Validity</label>
						<input <input type="number" name="utime" min="1" max="3" required class="form-control" />
					</div>
					<div class="form-group">
						<input type="submit" name="login" value="Upload & Generate Token" class="btn btn-danger" />
					</div>
					
				</fieldset>
		    </form>
	     </div>
	    </div>
        <div class="col-sm-6">
          <div class="well">
			<form role="form" action="/projectx/getfile2.php" method="post" name="loginform" enctype="multipart/form-data">
			    <fieldset>
				   <legend>Login</legend>
					
					<div class="form-group">
						<label for="name">Token</label>
						<input type="text" name="Token" placeholder="enter the token" required class="form-control"/>
					</div>	
					<div class="form-group">
						<input type="submit" name="login" value="click to login" class="btn btn-danger" />
					</div>
			    </fieldset>
		
             </form>
			<span class="text-danger"><?php if (isset($errormsg)) { echo $errormsg; } ?></span>
		</div>
    </div>
  </div>
</div>
<script src="js/jquery-1.10.2.js"></script>
<script src="js/bootstrap.min.js"></script>
<nav class="navbar fixed-bottom navbar-light bg-faded"style="background-color: #ff5c5c">
</nav>
</body>
</html>
