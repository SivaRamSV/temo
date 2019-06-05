<?php
require('header.php');
require('dbconnect_staff.php');

$name = $_FILES['file']['name'];
$size = $_FILES['file']['size'];
$type = $_FILES['file']['type'];
$user= $_POST['name'];
$userid=$_POST['username'];
$tmp_name = $_FILES['file']['tmp_name'];
$tval = getToken(10);
$tvaluser = getToken(10);
$hash=password_hash($tvaluser, PASSWORD_BCRYPT);
//echo $hash;
$extension = substr($name, strpos($name, '.') + 1);
$max_size = 100000000;
$date = date('Y-m-d H:i:s');
$utemptime=$_POST['utime'];
$temptime=$utemptime*3600;
$time = gmdate('H:i:s',$temptime);

function crypto_rand_secure($min, $max)
{
    $range = $max - $min;
    if ($range < 1) return $min; // not so random...
    $log = ceil(log($range, 2));
    $bytes = (int) ($log / 8) + 1; // length in bytes
    $bits = (int) $log + 1; // length in bits
    $filter = (int) (1 << $bits) - 1; // set all lower bits to 1
    do {
        $rnd = hexdec(bin2hex(openssl_random_pseudo_bytes($bytes)));
        $rnd = $rnd & $filter; // discard irrelevant bits
    } while ($rnd > $range);
    return $min + $rnd;
}

function getToken($length)
{
    $token = "";
    $codeAlphabet = "ABCDEFGHIJKLMNOPQRSTUVWXYZ";
    $codeAlphabet.= "abcdefghijklmnopqrstuvwxyz";
    $codeAlphabet.= "0123456789";
    $max = strlen($codeAlphabet); // edited

    for ($i=0; $i < $length; $i++) {
        $token .= $codeAlphabet[crypto_rand_secure(0, $max-1)];
    }

    return $token;
}

if(isset($name) && !empty($name))
{
	if( $extension == $size<=$max_size)
	{
		$location = "uploads/";
		if(move_uploaded_file($tmp_name, $location.$name))
		{
			$query = "INSERT INTO `upload` (name, size, type, location, user, token,usertoken,UTime,Etime,hash,u_user) VALUES ('$name', '$size', '$type', '$location$name', '$userid', '$tval','$tvaluser','$date','$time','$hash','$user')";
        		$result = mysqli_query($con, $query);
			$smsg = "Uploaded Successfully.";	
		}else{
			$fmsg = "Failed to Upload File";
		}
	}else{
		$fmsg = "File size should be 10000 KiloBytes";
	}
}
else
{
	$fmsg = "Please Select a File";
}


?>
<html>
<head>
	<title>Upload Succesfull</title>
	<meta content="width=device-width, initial-scale=1.0" name="viewport" >
	<link rel="stylesheet" href="css/bootstrap.min.css" type="text/css" />
</head>
<body>

<div class="container">
<?php //echo $name; ?>
<?php //echo $size; ?>
<?php// echo $type; ?>
<?php// echo $tmp_name; ?>
  <div class="container">
    
	<div class="row">
	    	<img class="img-responsive center-block" src="temo.jpg" max-width: "100%" height: "auto" alt="Chania"> 
		<div class="col-md-4 col-md-offset-4 well">
      <?php if(isset($name)){ ?><div class="alert alert-danger" role="alert"> <?php echo $smsg; ?> </div><?php } ?>

File Name :<?php if(isset($smsg)){ ?> <?php echo $name; ?> <?php } ?> </br>


 
<?php 

if(isset($smsg)){
echo "Token :".$tval;

echo "<br> UserToken :".$tvaluser;
} ?> 
</br>
URL : </br><textarea rows="4" cols="30"> <?php if(isset($smsg)){ ?> <?php echo "http://sivaramshibu.000webhostapp.com/projectx/getfile.php/$tval" ; ?> <?php } ?></textarea> </br>

      <?php if(isset($fmsg)){ ?><div class="alert alert-danger" role="alert"> <?php echo $fmsg; ?> </div><?php } ?>      
       
 </div>
	</div>
	
	</div>
</div>
<?php require('footer.php');?>
</body>

</html>