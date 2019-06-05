<?php $uri_parts = $_SERVER['REQUEST_URI'];
require('dbconnect.php');
require('header.php');
// echo $uri_parts[0];

$params1 = explode( "/", $uri_parts );
//echo $params1[3];
$params=$params1[3];


$result = mysqli_query($con,"SELECT * FROM upload WHERE token='".$params."' LIMIT 1");
$row = mysqli_fetch_assoc($result);

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

  <div class="container">
	<div class="row">
		<div class="col-md-4 col-md-offset-4 well">
      <?php if(isset($name)){ ?><div class="alert alert-success" role="alert"> <?php echo $smsg; ?> </div><?php } ?>

File Name :<?php echo $row['name']; ?> </br>

File Size:<?php echo $filesize; ?> </br>

File Token:<?php echo $row['token']; ?> </br>

Uploaded By :<?php echo $row['user']; ?> </br>
<?php $temp= $row['location']; 
?>
</br><a class='btn btn-danger' href="/projectx/<?php echo $row['location']; ?>">
                                        Download File
</a>
       
 </div>
	</div>
	
	</div>
</body>
<?php require('footer.php');?>
</html>


