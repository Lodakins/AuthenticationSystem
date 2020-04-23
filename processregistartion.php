<?php session_start();
require_once("lib/alert.php");
require_once("lib/email.php");
require_once("lib/token.php");
require_once("lib/user.php");
require_once("lib/validate.php");


$errorcount=0;
$validate=0;
$first_name=$_POST['first_name'] != null ? $_POST['first_name'] : $errorcount++;
$last_name=$_POST['last_name'] != null ? $_POST['last_name'] : $errorcount++;
$email=$_POST['email'] != null ? $_POST['email'] : $errorcount++;
$password=$_POST['password'] != null ? $_POST['password'] : $errorcount++;
$gender=$_POST['gender'] != null ? $_POST['gender'] : $errorcount++;
$designation=$_POST['designation'] != null ? $_POST['designation'] : $errorcount++;
$department=$_POST['department'] != null ? $_POST['department'] : $errorcount++;

// superadmin paas: admin@#$%1;
// superadmin email: superadmin@tech.com;

$_SESSION['first_name'] = $_POST['first_name'];
$_SESSION['last_name'] = $_POST['last_name'];
$_SESSION['email'] = $_POST['email'];
$_SESSION['password'] = $_POST['password'];
$_SESSION['gender'] = $_POST['gender'];
$_SESSION['designation'] = $_POST['designation'];
$_SESSION['department'] = $_POST['department'];


if(!validate("email",$email))  $validate++; 

if(!validate("name",$first_name))  $validate++; 

if(!validate("name",$last_name))  $validate++; 






if($errorcount > 0 ){
    setAlert("error","There are " . $errorcount ."empty fields");
        redirect("register.php");
        die();
//     ///^[A-Za-z]+$/
//     if(filter_var($email, FILTER_VALIDATE_EMAIL)) {
//         //Valid email!
//^[a-zA-Z0-9]{2,}$
//    }
//    MAIL_DRIVER=smtp
// MAIL_HOST=smtp.mailtrap.io
// MAIL_PORT=2525
// MAIL_USERNAME=4c1cbf4870de8f
// MAIL_PASSWORD=3e2098840e8eef
// MAIL_FROM_ADDRESS=from@example.com
// MAIL_FROM_NAME=Example
}else{

    $allUsers = scandir("db/users");
    $countUsers = count($allUsers);

    if ($validate > 0){
        redirect("register.php");
        die();
    }

    $newUserId = $countUsers++;

    for($counter =0; $counter < $countUsers; $counter++){
        if( $allUsers[$counter] == $email .".json"){
            $_SESSION['emailerror'] = 'Users already Exist';
            redirect("register.php");
            die();
        }
    }


    $userObject =[
        "id"=>$newUserId,
        "first_name" =>$first_name,
        "last_name"=>$last_name,
        "email"=>$email,
        "password"=>password_hash( $password,PASSWORD_DEFAULT),
        "gender"=>$gender,
        "designation"=>$designation,
        "department"=>$department,
        "dob"=>date("Y/m/d")
    ];
  
    file_put_contents("db/users/" . $email . ".json",json_encode($userObject));
    setAlert("message","You can now login, registration successfull");
    redirect("login.php");
    die();
}

?>