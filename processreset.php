<?php
session_start();

$errorcount=0;
$token=$_POST['token'] != null ? $_POST['token'] : $errorcount++;
$password=$_POST['password'] != null ? $_POST['password'] : $errorcount++;
$email=$_POST['email'] != null ? $_POST['email'] : $errorcount++;


$_SESSION['token'] = $_POST['token'];
$_SESSION['email'] = $_POST['email'];

if($errorcount > 0){
    $_SESSION['error'] = 'There are '. $errorcount .' empty fields';
    header("Location:resetpassword.php");
}else{
    $allUsersToken = scandir("db/token");
    $countUsersToken = count($allUsers);

    for($counter =0; $counter < $countUsersToken; $counter++){
        if( $allUsersToken[$counter] == $email .".json"){
            $tokenfile = file_get_contents("db/token/". $email.".json");
            $tokenobject = json_decode($tokenfile);
            $tokenfromdb =$tokenobject->token;
            if($tokenfromdb == $token){
                $allUsers = scandir("db/users");
                    $countUsers = count($allUsers);

                    $newUserId = $countUsers++;

                    for($counter =0; $counter < $countUsers; $counter++){
                        if( $allUsers[$counter] == $email .".json"){
                        
                        $file = file_get_contents("db/users/". $email.".json");
                        $userObject = json_decode($file);
                       $userObject->password= password_hash($password, PASSWORD_DEFAULT);
                        unlink("db/users/". $email .".json");
                            file_put_contents("db/users/" . $email . ".json",json_encode($userObject));
                            $_SESSION['message'] = 'Password reset successfull, you can now log in';

                            $subject="Password Reset Suucessfull";
                            $message="Password reset has been initiated from your account, if you did not initiate this reset please  visit: localhost/AuthenticationSystem/forgotpasword.php";
                            $headers="From: no-reply@snh.com" . "\r\n". "CC: somebody@example.com";
                            $try= mail($email,$subject,$message,$headers);
                            header("Location: login.php");
                        }
                     }
            }
        }
    }

    $_SESSION['error'] = 'Password reset failed: Token invalid / expired';
    header("Location:login.php");
}


?>