<?php
session_start();


$errorcount=0;
$email=$_POST['email'] != null ? $_POST['email'] : $errorcount++;

if($errorcount > 0){
    $_SESSION['error'] = 'Email cannot be empty';
    header("Location:forgotpassword.php");
}else{

    $allUsers = scandir("db/users");
    $countUsers = count($allUsers);

    for($counter =0; $counter < $countUsers; $counter++){
        if( $allUsers[$counter] == $email .".json"){
           echo "You can now proceed to reset email";

           
           /**
            *  TOKEN GENERATION
            */
            $token="";

            $alphabets=['a','b','c','d','e','f','g','h','i','j','k','l','m','n','o','p','q','r','s','t','u','w','x','y','z'];

             for( $i=0; $i < 26; $i++ ){
                $index= mt_rand(0,count($alphabets) - 1);
                $token.=$alphabets[$index];  
            }

            $subject="Password Reset Link";
           $message="Password request reset has been initiated from your account, if you did not initiate this reset please ignore this message
           , otherwise, visit: localhost/AuthenticationSystem/reset.php?token=" . $token;
           $headers="From: no-reply@snh.com" . "\r\n". "CC: somebody@example.com";



            file_put_contents("db/token/" . $email . ".json",json_encode(['token'=>$token]));
            /**
             * 
             * END OF TOKEN GENERATION
             */
 
           $try= mail($email,$subject,$message,$headers);
           
           if($try){
            $_SESSION['message'] = 'Password Reset has been sent to your email';
            file_put_contents("db/token/" . $email . ".json",json_encode(['token'->$token]));
            header("Location:resetpassword.php");
            die();
           }else{
            $_SESSION['error'] = 'Something went wrong, we could not send email to '. $email;
            header("Location:forgotpassword.php");
            die();
           }

        }
       
    }

    $_SESSION['error'] = 'Email not registered with us';
    header("Location:login.php");
   
}

?>