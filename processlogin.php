<?php
session_start();
require_once("lib/alert.php");
require_once("lib/user.php");


$errorcount=0;
$email=$_POST['email'] != null ? $_POST['email'] : $errorcount++;
$password=$_POST['password'] != null ? $_POST['password'] : $errorcount++;

$_SESSION['email']= $email;
if($errorcount > 0){

    $session_error= "You have" . $errorcount . " empty field";
    if($errorcount > 1) {
        $session_error.="s";
    }
    setAlert("error",$session_error);
   redirect("login.php");
    die();
}else{
    $userObject = findUsers($email);
        if($userObject){
           $dbpassword=$userObject->password;
           
           if(password_verify($password,$dbpassword)){
                $_SESSION['loggedin']= $userObject->id;
                $_SESSION['fullname']= $userObject->first_name . " " . $userObject->last_name;
                $_SESSION['role']= $userObject->designation;
                $_SESSION['department']=$userObject->department;
                $_SESSION['dob']=$userObject->dob;
                $_SESSION['email']=$userObject->email;

               
                date_default_timezone_set("Africa/Lagos");
                $lastLog = date("Y/m/d:h:i:sa");
                if($userObject->logged == null || $userObject->logged == ""){
                    $_SESSION['lastlogin']= "First Time Logging in, welcome";
                }else{
                    $_SESSION['lastlogin']= $userObject->logged;
                }
                $userObject->logged=$lastLog;
                unlink("db/users/". $email .".json");
                
                saveUsers($userObject);

                if($userObject->designation =="admin"){
                    redirect("admindashboard.php");
                    die();
                }else if($userObject->designation=="medical_team"){
                    redirect("medicaldashboard.php");
                    die();
                }else{
                    redirect("patientdashboard.php");
                    die();
                }
               
              
           }else{
           setAlert("error", "Invalid Email / Password");
           redirect("login.php");
            die();
           }
           
        }
    setAlert("error", "Invalid Email / Password");
    redirect("login.php");
    die();
}



?>