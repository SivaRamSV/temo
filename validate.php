<!DOCTYPE HTML>
<html>
<body>
<?php 
 include 'session.php';
require('dbconnect.php');
if ($_SERVER['REQUEST_METHOD'] == 'POST') 
{ 
 if (empty($_POST['Token']) ) //Validating inputs using PHP code 
 { 
 echo 
 "Incorrect Token"; //
 header("location: index.php");//You will be sent to Login.php for re-login 
 } 
 
 $inUsername = $_POST["Token"]; // as the method type in the form is "post" we are using $_POST otherwise it would be $_GET[] 
 $stmt= $db->prepare("SELECT usertoken FROM upload WHERE usertoken  = $inUsername"); //Fetching all the records with input credentials
 $stmt->bind_param("s", $inUsername); //bind_param() - Binds variables to a prepared statement as parameters. "s" indicates the type of the parameter.
 $stmt->execute();
 $stmt->bind_result($check); // Binding i.e. mapping database results to new variables
   
 //Compare if the database has username and password entered by the user. Password has to be decrypted while comparing.
 if ($stmt->fetch() && password_verify($Token)) 
 {
 $_SESSION['Token']=$inUsername; //Storing the username value in session variable so that it can be retrieved on other pages
 header("location: getfile2.php"); // user will be taken to profile page
 }
 else
 {
    echo "Incorrect username or password"; 
   ?>
 
   <a href="index.php">Login</a>
       <?php 
 } 
 } 
       ?>
 </body> 
 </html>