<?php
error_reporting(0);
include 'session.php';
require('dbconnect_staff.php');
require('header.php');
$sname = $_POST['username'];
$result_user = mysqli_query($con,"SELECT * FROM user");
$row_user = mysqli_fetch_assoc($result_user);
$result = mysqli_query($con,"SELECT * FROM upload");
//$username = mysqli_query($con,"SELECT user FROM upload WHERE usertoken='".$sname."' ");
//$hashc = mysqli_query($con,"SELECT hash FROM upload WHERE usertoken= '$sname'" );
$row = mysqli_fetch_assoc($result);
//$data = mysqli_fetch_array($username); 
//$hash = mysqli_fetch_array($hashc); 
//echo $sname."</br>hh";
//$hash=password_hash($sname, PASSWORD_DEFAULT);
//echo $row['user_id'];
//echo $row['size'];
if (password_verify($sname,$row_user['hash'])) 
    {
   echo 'Password is valid!';
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
	

<script>
    $(document).ready(function(){
    $('input.typeahead').typeahead({
        name: 'typeahead',
        remote:'search.php?key=%QUERY',
        limit : 10
    });
});
    </script>
	
</head>
<body>
	<img class="img-responsive center-block" src="welcome.png" max-width: "100%" height: "auto" alt="Chania"> 
<div class="container-fluid">
    <div class="row">
        <div class="col-sm-6">
          <div class="well">
			<form role="form" action="/projectx/generate_token_staff.php" method="post" name="loginform"enctype="multipart/form-data">
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
		    <label for="name">To</label>		
            <div class="panel panel-default">
           <div class="autocomplete">
                <input id="myInput" type="text" name="username" placeholder="Receiver" required class="form-control">
            </div>
    
     </div>
	</div>
					<div class="form-group">
						<label for="name">Validity</label>
						<input  type="number" name="utime" min="1" max="3" required class="form-control" />
					</div>
					<div class="form-group">
						<input type="submit" name="login" value="Upload & Generate Token" class="btn btn-danger" />
					</div>
					
				</fieldset>
		    </form>
	     </div>
	    </div>
	    
		  <div class="col-md-6">
			<div class="well">
			    <label>Uploaded</label>
				          <form>    
			        	<fieldset>
          <?php if(isset($name)){ ?><div class="alert alert-success" role="alert"> <?php echo $smsg; ?> </div>
          <?php } $row = $result->fetch_object();
          
          
                if ($result = mysqli_query($con,"SELECT * FROM upload WHERE u_user='".$sname."' "))
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
    
           <div class="col-md-6">
			<div class="well">
			    <label>Received</label>
           <form>    
			        	<fieldset>
          <?php if(isset($name)){ ?><div class="alert alert-success" role="alert"> <?php echo $smsg; ?> </div>
          <?php } $row = $result->fetch_object();
          
          
                if ($result = mysqli_query($con,"SELECT * FROM upload WHERE user='".$sname."' "))
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
          
				<form role="form" action=delete_staff.php>
				
				    <div class="form-group">
						<input type="submit" name="Delete" value="Delete Your Token" class="btn btn-danger btn-lg btn-block" onclick=delete_staff.php>
					</div>
				</form>	
      

   
  </div>
</div>
<script>
function autocomplete(inp, arr) {
  /*the autocomplete function takes two arguments,
  the text field element and an array of possible autocompleted values:*/
  var currentFocus;
  /*execute a function when someone writes in the text field:*/
  inp.addEventListener("input", function(e) {
      var a, b, i, val = this.value;
      /*close any already open lists of autocompleted values*/
      closeAllLists();
      if (!val) { return false;}
      currentFocus = -1;
      /*create a DIV element that will contain the items (values):*/
      a = document.createElement("DIV");
      a.setAttribute("id", this.id + "autocomplete-list");
      a.setAttribute("class", "autocomplete-items");
      /*append the DIV element as a child of the autocomplete container:*/
      this.parentNode.appendChild(a);
      /*for each item in the array...*/
      for (i = 0; i < arr.length; i++) {
        /*check if the item starts with the same letters as the text field value:*/
        if (arr[i].substr(0, val.length).toUpperCase() == val.toUpperCase()) {
          /*create a DIV element for each matching element:*/
          b = document.createElement("DIV");
          /*make the matching letters bold:*/
          b.innerHTML = "<strong>" + arr[i].substr(0, val.length) + "</strong>";
          b.innerHTML += arr[i].substr(val.length);
          /*insert a input field that will hold the current array item's value:*/
          b.innerHTML += "<input type='hidden' value='" + arr[i] + "'>";
          /*execute a function when someone clicks on the item value (DIV element):*/
          b.addEventListener("click", function(e) {
              /*insert the value for the autocomplete text field:*/
              inp.value = this.getElementsByTagName("input")[0].value;
              /*close the list of autocompleted values,
              (or any other open lists of autocompleted values:*/
              closeAllLists();
          });
          a.appendChild(b);
        }
      }
  });
  /*execute a function presses a key on the keyboard:*/
  inp.addEventListener("keydown", function(e) {
      var x = document.getElementById(this.id + "autocomplete-list");
      if (x) x = x.getElementsByTagName("div");
      if (e.keyCode == 40) {
        /*If the arrow DOWN key is pressed,
        increase the currentFocus variable:*/
        currentFocus++;
        /*and and make the current item more visible:*/
        addActive(x);
      } else if (e.keyCode == 38) { //up
        /*If the arrow UP key is pressed,
        decrease the currentFocus variable:*/
        currentFocus--;
        /*and and make the current item more visible:*/
        addActive(x);
      } else if (e.keyCode == 13) {
        /*If the ENTER key is pressed, prevent the form from being submitted,*/
        e.preventDefault();
        if (currentFocus > -1) {
          /*and simulate a click on the "active" item:*/
          if (x) x[currentFocus].click();
        }
      }
  });
  function addActive(x) {
    /*a function to classify an item as "active":*/
    if (!x) return false;
    /*start by removing the "active" class on all items:*/
    removeActive(x);
    if (currentFocus >= x.length) currentFocus = 0;
    if (currentFocus < 0) currentFocus = (x.length - 1);
    /*add class "autocomplete-active":*/
    x[currentFocus].classList.add("autocomplete-active");
  }
  function removeActive(x) {
    /*a function to remove the "active" class from all autocomplete items:*/
    for (var i = 0; i < x.length; i++) {
      x[i].classList.remove("autocomplete-active");
    }
  }
  function closeAllLists(elmnt) {
    /*close all autocomplete lists in the document,
    except the one passed as an argument:*/
    var x = document.getElementsByClassName("autocomplete-items");
    for (var i = 0; i < x.length; i++) {
      if (elmnt != x[i] && elmnt != inp) {
        x[i].parentNode.removeChild(x[i]);
      }
    }
  }
  /*execute a function when someone clicks in the document:*/
  document.addEventListener("click", function (e) {
      closeAllLists(e.target);
  });
}

/*An array containing all the country names in the world:*/
var username = ["sivaram","shibu","apsel"];

/*initiate the autocomplete function on the "myInput" element, and pass along the countries array as possible autocomplete values:*/
autocomplete(document.getElementById("myInput"), username);
</script>
</body>
<?php require('footer.php');?>
</html>