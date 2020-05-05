<?php
// require_once("lib/alert.php");
// include_once("lib/user.php");
// require_once("lib/appointements.php");
// require_once("lib/validate.php");




function saveTransaction($email,$paymentStatus,$paymentType,$paymentDate,$paymentAmount,$paymentRef,$department){
    $count=1;
    $allTransactions = scandir("db/transaction");
    $countTransactions = count($allTransactions);
    for($counter=0; $counter < $countTransactions; $counter++){ 
      if($allTransactions[$counter] ==$email ."transact". $count .".json"){
        $count++;
      }
  }

  $transaction=[
    'payment_status'=>$paymentStatus,
   'payment_type'=>$paymentType,
   'payment_amount'=>$paymentAmount,
   'payment_date'=>$paymentDate,
   'payment_ref'=>$paymentRef,
   'department'=>$department,
   'email'=>$email
  ];

  file_put_contents("db/transaction/". $email . "transact". $count .".json",json_encode($transaction));

}

function printTransaction(){
     $allTransactions = scandir("db/transaction");
}


?>