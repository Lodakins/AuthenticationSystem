<?php
session_start();


$errorcount=0;
$email=$_POST['email'] != null ? $_POST['email'] : $errorcount++;
$password=$_POST['password'] != null ? $_POST['password'] : $errorcount++;

$_SESSION['email']= $email;
if($errorcount > 0){

    $session_error= "You have" . $errorcount . " errors";
    if($errorcount > 1) {
        $session_error.="s";
    }
    $_SESSION['error'] = $session_error;
    header("Location:login.php");
}else{
    $allUsers = scandir("db/users");
    $countUsers = count($allUsers);

    $newUserId = $countUsers++;

    for($counter =0; $counter < $countUsers; $counter++){
        if( $allUsers[$counter] == $email .".json"){
          
           $file = file_get_contents("db/users/". $email.".json");
           $userObject = json_decode($file);
           $dbpassword=$userObject->password;
           
           if(password_verify($password,$dbpassword)){
                $_SESSION['loggedin']= $userObject->id;
               header("Location: dashboard.php");
           }
            die();
        }
    }
    $_SESSION['error'] = "Invalid Email / Password";
    header("Location: login.php");
    die();
}



?>