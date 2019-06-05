<?php
require('dbconnect.php');
require('dbconnect_staff.php');
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
		
	</div>
</nav>
	<img class="img-responsive center-block" src="tem00.png" max-width: "100%" height: "auto" alt="Chania"> 
<div class="container">
    
          <div class="well">
			<form role="form" action="/projectx/s_getfile.php" method="post" name="loginform" enctype="multipart/form-data">
			    <fieldset>
			        <div class="form-group input-group">
                   
				   <legend>Login</legend>
					<div style="margin-left:auto;margin-right:auto;"></div>
					<div class="form-group">
						<label for="name">Enter your UserId</label>
						<input type="text" name="username" placeholder="Userid" required class="form-control"/>
					</div>	
					<div class="form-group">
						<input type="submit" name="login" value="click to login" class="btn btn-danger" />
					</div>
					</div>

			    </fieldset>
		
             </form>
			<span class="text-danger"><?php if (isset($errormsg)) { echo $errormsg; } ?></span>
		</div>
    
    </div>

</body>
<?php require('footer.php');?>
</html>