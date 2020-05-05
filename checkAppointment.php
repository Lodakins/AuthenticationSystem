<?php
session_start();
require_once("lib/alert.php");
include_once("lib/user.php");
require_once("lib/appointements.php");
require_once("lib/validate.php");

    $department= $_POST['dept'];
    $email=$_POST['email'];

$count=0;
  $allAppointment = scandir("db/appointment/".$department);
  $countAppointment = count($allAppointment);
  for($counter=0; $counter < $countAppointment; $counter++){ 
      if($allAppointment[$counter] == $email .".json"){
            $count++;
      }
  }


  if($count>0){
      echo "true";
  }else{
    setAlert("error","You have not made an appointment, make an appointement before paying bill");
    echo "false";
  }




?>