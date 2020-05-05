<?php
session_start();
require_once("lib/alert.php");
include_once("lib/user.php");
require_once("lib/appointements.php");
require_once("lib/validate.php");

    $department= $_POST['dept'];
    $email=$_POST['email'];

$count=0;
$paid=0;
  $allAppointment = scandir("db/appointment/".$department);
  $countAppointment = count($allAppointment);
  for($counter=0; $counter < $countAppointment; $counter++){ 
      if($allAppointment[$counter] == $email .".json"){
        $file = file_get_contents("db/appointment/".$department."/". $allAppointment[$counter]);
         $appointmentObject = json_decode($file);
         $paymentFile =$appointmentObject->payment;
            if($paymentFile ==="paid"){
                $paid++;
            }
            $count++;
      }
  }



  if($count==0){
     setAlert("error","You have not made an appointment, make an appointement before paying bill");
     echo "false";
  }
  if($paid>0){
    setAlert("message","You have already paid for this appointment");
    echo "false";
  }
  echo "true";

  
  

  




?>