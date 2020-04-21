<?php
session_start();
require_once("lib/alert.php");
require_once("lib/email.php");
require_once("lib/token.php");
require_once("lib/user.php");

$errorcount=0;
$email=$_POST['email'] != null ? $_POST['email'] : $errorcount++;

if($errorcount > 0){
    setAlert('error',"Email cannot be empty");
    header("Location:forgotpassword.php");
    die();
}else{

        $userObject = findUsers($email);

        if($userObject){    
            $token = generate_token();
            $subject="Password Reset Link";
           $message="Password request reset has been initiated from your account, if you did not initiate this reset please ignore this message, otherwise, visit: localhost/AuthenticationSystem/resetpassword.php?token=" . $token;
            $tokenObject=[
                "token"=>$token
            ];
 
           $try= send_mail($subject,$message,$email);
      
           if($try){
            setAlert("message",'Password Reset has been sent to your email');
            file_put_contents("db/token/" . $email . ".json",json_encode($tokenObject));
            redirect("login.php");
            die();
           }else{
            setAlert("error",'Something went wrong, we could not send email to '. $email);
            redirect("forgotpassword.php");
            die();
           }
       
    }
    setAlert('error','Email not registered with us');
   redirect("login.php");
    die();
}

?>