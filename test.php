<?php require('dbconnect_staff.php'); ?>
<html>
<!-- google API reference -->
<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
<!-- my own script for search function -->

<center>
<form method="POST">
    <input type="text" name="search" style="width:400px " placeholder="Search box" onkeyup="searchq();">
    <input type="submit" value=">>">
    <div id="output">
    </div>
</form>
</center>   

  <!-- instant search function -->
 <script type="text/javascript">
function searchq(){
    // get the value
    var searchTxt = $("input[name='search']").val();
    // post the value
    if(searchTxt != "")
    {
        $.post("search.php",{searchVal: searchTxt},function(output){
            $("#output").html(output);
        });
    }
    else
    {
        $("#output").html("");
    }
}
</script>
</html>