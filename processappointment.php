<?php
session_start();
require_once("lib/alert.php");
include_once("lib/user.php");
require_once("lib/functions.php");

$errorcount=0;
$date_of_appointment=$_POST['date_of_appointment'] != null ? $_POST['date_of_appointment'] : $errorcount++;
$time_of_appointment=$_POST['time_of_appointment'] != null ? $_POST['time_of_appointment'] : $errorcount++;
$nature_of_appointment=$_POST['nature_of_appointment'] != null ? $_POST['nature_of_appointment'] : $errorcount++;
$initcomplaint=$_POST['initcomplaint'] != null ? $_POST['initcomplaint'] : $errorcount++;
$department=$_POST['depart'] != null ? $_POST['depart'] : $errorcount++;
$email=$_POST['email'] != null ? $_POST['email'] : $errorcount++;
$patient_name=$_POST['name'] != null ? $_POST['name'] : $errorcount++;


$_SESSION['date_of_appointment'] = $_POST['date_of_appointment'];
$_SESSION['time_of_appointment'] = $_POST['time_of_appointment'];
$_SESSION['nature_of_appointment'] = $_POST['nature_of_appointment'];
$_SESSION['initcomplaint'] = $_POST['initcomplaint'];
$_SESSION['depart'] = $_POST['depart'];


if($errorcount > 0 ){
        setAlert1("error","There are " . $errorcount ."empty fields");
        header("Location:patientdashboard.php");
        die();
//     ///^[A-Za-z]+$/
//     if(filter_var($email, FILTER_VALIDATE_EMAIL)) {
//         //Valid email!
//^[a-zA-Z0-9]{2,}$
//    }
//    MAIL_DRIVER=smtp
// MAIL_HOST=smtp.mailtrap.io
// MAIL_PORT=2525
// MAIL_USERNAME=4c1cbf4870de8f
// MAIL_PASSWORD=3e2098840e8eef
// MAIL_FROM_ADDRESS=from@example.com
// MAIL_FROM_NAME=Example
}else{
        $appointment=[
             'patient_name'=>$patient_name,
            'date_of_appointment'=>$date_of_appointment,
            'time_of_appointment'=>$time_of_appointment,
            'nature_of_appointment'=>$nature_of_appointment,
            'initcomplaint'=>$initcomplaint,
            'department'=>$department,
            'email'=>$email
        ];
     saveAppointment($email,$department,$appointment);

}










?>