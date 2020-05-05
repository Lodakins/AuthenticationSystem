<?php
session_start();
require_once("lib/alert.php");
include_once("lib/user.php");
require_once("lib/appointements.php");
require_once("lib/validate.php");
require_once("lib/transactions.php");


$payerName = $_SESSION['fullname'];
$paymentStatus = $_GET['status'];
$paymentType = $_GET['type'];
$paymentDate = $_GET['amount'];
$paymentAmount = $_GET['date'];
$paymentRef=$_GET['txref'];
$department=$_GET['department'];
$email=$_SESSION['email'];


saveTransaction($email,$payerName,$paymentStatus,$paymentType,$paymentDate,$paymentAmount,$paymentRef,$department);
setAlert1("message","Payment for appointment was successfull");
$subject="Payment Successfull With Error";
$message="Your payment was successfull but with error, you can reach out to the account offficer";               
send_mail($subject,$message,$email);
redirect("patientdashboard.php");
die();


?>?