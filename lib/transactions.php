<?php
// require_once("lib/alert.php");
// include_once("lib/user.php");
// require_once("lib/appointements.php");
// require_once("lib/validate.php");




function saveTransaction($email,$payerName,$paymentStatus,$paymentType,$paymentDate,$paymentAmount,$paymentRef,$department){
    $count=1;
    $allTransactions = scandir("db/transaction");
    $countTransactions = count($allTransactions);
    for($counter=0; $counter < $countTransactions; $counter++){ 
      if($allTransactions[$counter] ==$email ."transact". $count .".json"){
        $count++;
      }
  }

  $transaction=[
    'payer_name'=>$payerName,
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

function printTransaction($email){
     
    try{
      $allTransactions = scandir("db/transaction");
      $countTransactions = count($allTransactions);
      if($allTransactions > 2){
          echo '<table class="table table-striped"> <thead class="thead-dark"><tr><th> Full Name</th><th> Payment Status</th><th> Payment Type</th><th>
          Payment Amount</th> <th> Payment Date</th> <th> Payment Ref</th><th>Department</th><th>Email</th>
          </tr></thead><tbody>';
         for($counter=2; $counter <$countTransactions; $counter++){
                if(strpos($allTransactions[$counter], $email) !== false){
                $file = file_get_contents("db/transaction/".$allTransactions[$counter]);
                $transactionObject = json_decode($file);
                echo "<tr><td>".$transactionObject->payer_name."</td>
                <td>".$transactionObject->payment_status."</td>
                <td>".$transactionObject->payment_type."</td>
                <td>".$transactionObject->payment_amount."</td>
                <td>".$transactionObject->payment_date."</td>
                <td>".$transactionObject->payment_ref."</td>
                <td>".$transactionObject->department."</td>
                <td>".$transactionObject->email."</td></tr>";
            }
         }
         echo "</tbody></table>";
      }else{
          echo '<p style="background-color:green;color:white; padding: 20px;"> You have no Transaction.. </p>';
      }
     
  }catch( Exception $e){
      setAlert1("error","something went wrong");
      redirect("medicaldashboard.php");
      die();
  }

}


function printAllTransaction(){
  try{
    $allTransactions = scandir("db/transaction");
    $countTransactions = count($allTransactions);
    if($allTransactions > 2){
        echo '<table class="table table-striped"> <thead class="thead-dark"><tr><th> Payment Status</th><th> Payment Type</th><th>
        Payment Amount</th> <th> Payment Date</th> <th> Payment Ref</th><th>Department</th><th>Email</th>
        </tr></thead><tbody>';
       for($counter=2; $counter <$countTransactions; $counter++){
              $file = file_get_contents("db/transaction/".$allTransactions[$counter]);
              $transactionObject = json_decode($file);
              echo "<tr><td>".$transactionObject->payer_name."</td>
              <td>".$transactionObject->payment_status."</td>
              <td>".$transactionObject->payment_type."</td>
              <td>".$transactionObject->payment_amount."</td>
              <td>".$transactionObject->payment_date."</td>
              <td>".$transactionObject->payment_ref."</td>
              <td>".$transactionObject->department."</td>
              <td>".$transactionObject->email."</td></tr>";
       }
       echo "</tbody></table>";
    }else{
        echo '<p style="background-color:green;color:white; padding: 20px;"> You have no Transaction.. </p>';
    }
   
     }catch( Exception $e){
    setAlert1("error","something went wrong");
    redirect("medicaldashboard.php");
    die();
    }
}


?>