<?php
session_start();
require_once("lib/alert.php");
require_once("lib/email.php");
require_once("lib/token.php");
require_once("lib/user.php");

$errorcount=0;
 if(!$_SESSION['loggedin']){ 
$token=$_POST['token'] != null ? $_POST['token'] : $errorcount++;
$_SESSION['token'] = $_POST['token'];
 }
$password=$_POST['password'] != null ? $_POST['password'] : $errorcount++;
$email=$_POST['email'] != null ? $_POST['email'] : $errorcount++;


$_SESSION['email'] = $_POST['email'];

if($errorcount > 0){
    setAlert("error", 'There are '. $errorcount .' empty fields');
    redirect("resetpassword.php");
   die();
}else{
    
    

            if($_SESSION['loggedin']){
                $checkToken= true;
                $email=$_SESSION['email'];
            }else{
                $checkToken = check_token($email) == $token;
            }
           
            if($checkToken){            
                        $userObject = findUsers($email);
                        if($userObject){
                             $userObject->password= password_hash($password, PASSWORD_DEFAULT);
                            unlink("db/users/". $email .".json");
                            unlink("db/token/". $email .".json");
                            saveUsers($userObject);
                            setAlert("message",'Password reset successfull');
                            

                            $subject="Password Reset Suucessfull";
                            $message="Password reset was successfull, if you did not initiate this reset please  visit: localhost/AuthenticationSystem/forgotpassword
                            .php";
                            send_mail($subject,$message,$email);
                            redirect("login.php");
                            die();
                        }else{
                            setAlert("error","'Password reset failed: Email invalid'");
                            redirect("login.php");
                            die();
                        }
                     }

    setAlert("error",'Password reset failed: Token invalid / expired');
    redirect("login.php");
    die();
}


?>