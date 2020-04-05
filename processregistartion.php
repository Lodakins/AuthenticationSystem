<?php session_start();

$errorcount=0;
$first_name=$_POST['first_name'] != null ? $_POST['first_name'] : $errorcount++;
$last_name=$_POST['last_name'] != null ? $_POST['last_name'] : $errorcount++;
$email=$_POST['email'] != null ? $_POST['email'] : $errorcount++;
$password=$_POST['password'] != null ? $_POST['password'] : $errorcount++;
$gender=$_POST['gender'] != null ? $_POST['gender'] : $errorcount++;
$designation=$_POST['designation'] != null ? $_POST['designation'] : $errorcount++;
$department=$_POST['department'] != null ? $_POST['department'] : $errorcount++;


$_SESSION['first_name'] = $_POST['first_name'];
$_SESSION['last_name'] = $_POST['last_name'];
$_SESSION['email'] = $_POST['email'];
$_SESSION['password'] = $_POST['password'];
$_SESSION['gender'] = $_POST['gender'];
$_SESSION['designation'] = $_POST['designation'];
$_SESSION['department'] = $_POST['department'];

if($errorcount > 0){
    $_SESSION['error'] = 'There are '. $errorcount .' empty fields';
    header("Location:register.php");
}else{

    $userObject =[
        "id"=>1,
        "first_name" =>$first_name,
        "last_name"=>$last_name,
        "email"=>$email,
        "password"=>$password,
        "gender"=>$gender,
        "designation"=>$designation,
        "department"=>$department
    ];
    echo "Registration Successfull";
    file_put_contents("db/users/" . $first_name . $last_name . "json",json_encode($userObject));
    $_SESSION['message']="You can now login, registration successfull";
    //header("Location:login.php");
}

?>