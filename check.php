<?php
require('dbconnect.php');
$query = mysqli_query($con,"SELECT  `UTime`, `Etime` FROM `upload`"); 
$row = $query->fetch_object();
//$set= $row->UTime + $row->Etime;
$time1=$row->UTime;
$time2=$row->Etime;
function sum_the_time($time1,$time2)
{
      $times = array($time1, $time2);
      $seconds = 0;
      foreach ($times as $time)
      {
        list($hour,$minute,$second) = explode(':', $time);
        $seconds += $hour*3600;
        $seconds += $minute*60;
        $seconds += $second;
      }
      $hours = floor($seconds/3600);
      $seconds -= $hours*3600;
      $minutes  = floor($seconds/60);
      $seconds -= $minutes*60;
      if($seconds < 9)
      {
      $seconds = "0".$seconds;
      }
      if($minutes < 9)
      {
      $minutes = "0".$minutes;
      }
        if($hours < 9)
      {
      $hours = "0".$hours;
      }
      $currenttime="{$hours}:{$minutes}:{$seconds}";
      return $currenttime ;
    }
$time= sum_the_time($time1,$time2);
$t=date("H:i:s");
//echo "$t </br>";
//echo "$time </br>";
//echo $time2;
if(strtotime($time)<=strtotime($t)) 
{
 mysqli_query($con,"DELETE FROM `upload` WHERE UTime='$time1'"); 
} 
else
{
    echo"hello";
}
//echo $time1;


?>