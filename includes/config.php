<?php
  ob_start();
  $timezone = date_default_timezone_set("Asia/Calcutta");

  $con = mysqli_connect("localhost", "root", "", "better-spotify");

  if(mysqli_connect_errno()){
      echo "Failed to Connect" . mysqli_connect_errno();
  }

?>