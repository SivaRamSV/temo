<?php
error_reporting(0);
include 'session.php';
require('dbconnect.php');
require('header.php');
$sname = $_POST['Token'];
$result = mysqli_query($con,"SELECT * FROM upload WHERE usertoken='".$sname."' ");
//$username = mysqli_query($con,"SELECT user FROM upload WHERE usertoken='".$sname."' ");
//$hashc = mysqli_query($con,"SELECT hash FROM upload WHERE usertoken= '$sname'" );
$row = mysqli_fetch_assoc($result);
//$data = mysqli_fetch_array($username); 
//$hash = mysqli_fetch_array($hashc); 
//echo $sname."</br>hh";
//$hash=password_hash($sname, PASSWORD_DEFAULT);
echo $row['location'];
if (password_verify($sname,$row['hash'])) 
    {
   // echo 'Password is valid!';
    } 
else 
    {
    echo 'Invalid password.';
echo '<meta http-equiv="refresh" content="1; URL=index.php" />';
exit("Location: index.php");
    
    }
    //echo "$hashc";
function formatSizeUnits($bytes)
    {
        if ($bytes >= 1073741824)
        {
            $bytes = number_format($bytes / 1073741824, 2) . ' GB';
        }
        elseif ($bytes >= 1048576)
        {
            $bytes = number_format($bytes / 1048576, 2) . ' MB';
        }
        elseif ($bytes >= 1024)
        {
            $bytes = number_format($bytes / 1024, 2) . ' KB';
        }
        elseif ($bytes > 1)
        {
            $bytes = $bytes . ' bytes';
        }
        elseif ($bytes == 1)
        {
            $bytes = $bytes . ' byte';
        }
        else
        {
            $bytes = '0 bytes';
        }

        return $bytes;
}
$filesize = formatSizeUnits($row['size']);
?>
<html>
<head>
	<title>Download File</title>
	<meta content="width=device-width, initial-scale=1.0" name="viewport" >
	<link rel="stylesheet" href="/projectx/css/bootstrap.min.css" type="text/css" />
		
</head>
<body>
	<img class="img-responsive center-block" src="welcome.png" max-width: "100%" height: "auto" alt="Chania"> 
<div class="container-fluid">
    <div class="row">
        <div class="col-md-6">
          <div class="well">
			<form role="form" action=generate_token2.php method="post" name="loginform"enctype="multipart/form-data">
				<fieldset>
					<legend>Upload File</legend>
				
					<div class="form-group">
						<label for="name">Name</label>
						<input type="text" name="name" value="<?php echo $row['user']?>" required class="form-control"/>
					</div>
					<div class="form-group">
						<label for="name">User Token</label>
						<input type="text" name="usertoken" value="<?php echo $sname; ?>" required class="form-control"/>
					</div>
                    <div class="form-group">
						<label for="name">File</label>
						<input type="file" name="file" required class="form-control" />
					</div>
					
					<div class="form-group">
						<input type="submit" name="upload" value="Upload new file"  class="btn btn-danger" />
					</div>
					
						</fieldset>
				</form>
				 </div>
                 </div>	
		                <div class="col-md-6">
				        <div class="well">
				          <form>    
			        	<fieldset>
          <?php if(isset($name)){ ?><div class="alert alert-success" role="alert"> <?php echo $smsg; ?> </div>
          <?php } $row = $result->fetch_object();
          
          
                if ($result = mysqli_query($con,"SELECT * FROM upload WHERE usertoken='".$sname."' "))
                   {
                            while($row = $result->fetch_object())
                                   {
                                            echo"</br>File Name : {$row->name}
                                            </br>
                                            File Size: {$filesize}
                                            </br>
                                            File Token: {$row->token} 
                                            </br>
                                            </br>
                                            <a class='btn btn-danger' href=http://sivaramshibu.000webhostapp.com/projectx/uploads/$row->name>
                                         Download</a>
                                        
                                            </br>";
                     // echo" http://sivaramshibu.000webhostapp.com//projectx/$row->location";
                                    }
                                    
                                        
                   } 
mysqli_free_result($result);
         ?>
           </fieldset>
           </form>
    </div>
    </div>
  </div>
</div>
<div class="container">
    
    
        <div class="col-md-12">
          
				<form role="form" action=delete.php>
				
				    <div class="form-group">
						<input type="submit" name="Delete" value="Delete Your Token" class="btn btn-danger btn-lg btn-block" onclick=delete_staff.php>
					</div>
				</form>	
      

   
  </div>
</div>
</body>
<?php require('footer.php');?>
</html>

