<?php
    session_start();
	$_SESSION['user']=$_POST['Token'];
	$_SESSION['username']= $_POST['username'];
	if(isset($_SESSION['user']))
	{
	
		
	}
	else
	{
		//header("Location:index.php");
}
    
    ?>