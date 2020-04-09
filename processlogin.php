<?php
session_start();


$errorcount=0;
$email=$_POST['email'] != null ? $_POST['email'] : $errorcount++;
$password=$_POST['password'] != null ? $_POST['password'] : $errorcount++;

$_SESSION['email']= $email;
if($errorcount > 0){

    $session_error= "You have" . $errorcount . " empty field";
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
                $_SESSION['fullname']= $userObject->first_name . " " . $userObject->last_name;
                $_SESSION['role']= $userObject->designation;
                $_SESSION['department']=$userObject->department;
                $_SESSION['dob']=$userObject->dob;

               
                date_default_timezone_set("Africa/Lagos");
                $lastLog = date("Y/m/d:h:i:sa");
                if($userObject->logged == null || $userObject->logged == ""){
                    $_SESSION['lastlogin']= "First Time Logging in, welcome";
                }else{
                    $_SESSION['lastlogin']= $userObject->logged;
                }
                $userObject->logged=$lastLog;
                unlink("db/users/". $email .".json");
               
                file_put_contents("db/users/" . $email . ".json",json_encode($userObject));

                if($userObject->designation == "admin"){
                    header("Location:admindashboard.php");
                    die();
                }else{
                    header("Location:dashboard.php");
                    die();
                }
               
              
           }else{
            $_SESSION['error'] = "Invalid Email / Password";
            header("Location: login.php");
            die();
           }
           
        }
    }
    $_SESSION['error'] = "Invalid Email / Password";
    header("Location: login.php");
    die();
}



?>