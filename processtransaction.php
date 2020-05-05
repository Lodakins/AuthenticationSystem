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

if($paymentStatus ==="successful"){
    saveTransaction($email,$payerName,$paymentStatus,$paymentType,$paymentDate.substr(0,12),$paymentAmount,$paymentRef,$department);
    updateAppointment($email,$department);
    setAlert1("message","Payment for appointment was successfull");
    $subject="Payment Successfull";
    $message="Your payment was successfull, you can now visit the department at your appointment time";               
    send_mail($subject,$message,$email);
    redirect("patientdashboard.php");
    die();
}else{
    saveTransaction($email,$payerName,$paymentStatus,$paymentType,$paymentDate.substr(0,12),$paymentAmount,$paymentRef,$department);
    $subject="Payment Not Successfull";
    $message="Your payment was not successfull, you cannot visit the department at your appointment time";               
    send_mail($subject,$message,$email);
    setAlert1("error","Payment for appointment was not successfull");
    redirect("patientdashboard.php");
    die();
}













// $curl = curl_init();

// $customer_email = "user@example.com";
// $amount = 3000;  
// $currency = "NGN";
// $txref = "rave-29933838"; // ensure you generate unique references per transaction.
// $PBFPubKey = "<YOUR PUBLIC KEY>"; // get your public key from the dashboard.
// $redirect_url = "https://your-website.com/urltoredirectto";
// $payment_plan = "pass the plan id"; // this is only required for recurring payments.


// curl_setopt_array($curl, array(
//   CURLOPT_URL => "https://api.ravepay.co/flwv3-pug/getpaidx/api/v2/hosted/pay",
//   CURLOPT_RETURNTRANSFER => true,
//   CURLOPT_CUSTOMREQUEST => "POST",
//   CURLOPT_POSTFIELDS => json_encode([
//     'amount'=>$amount,
//     'customer_email'=>$customer_email,
//     'currency'=>$currency,
//     'txref'=>$txref,
//     'PBFPubKey'=>$PBFPubKey,
//     'redirect_url'=>$redirect_url,
//     'payment_plan'=>$payment_plan
//   ]),
//   CURLOPT_HTTPHEADER => [
//     "content-type: application/json",
//     "cache-control: no-cache"
//   ],
// ));

// $response = curl_exec($curl);
// $err = curl_error($curl);

// if($err){
//   // there was an error contacting the rave API
//   die('Curl returned error: ' . $err);
// }

// $transaction = json_decode($response);

// if(!$transaction->data && !$transaction->data->link){
//   // there was an error from the API
//   print_r('API returned error: ' . $transaction->message);
// }

// // uncomment out this line if you want to redirect the user to the payment page
// //print_r($transaction->data->message);


// // redirect to page so User can pay
// // uncomment this line to allow the user redirect to the payment page
// header('Location: ' . $transaction->data->link);























?>