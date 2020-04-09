<?php session_start();

$errorcount=0;
$validate=0;
$first_name=$_POST['first_name'] != null ? $_POST['first_name'] : $errorcount++;
$last_name=$_POST['last_name'] != null ? $_POST['last_name'] : $errorcount++;
$email=$_POST['email'] != null ? $_POST['email'] : $errorcount++;
$password=$_POST['password'] != null ? $_POST['password'] : $errorcount++;
$gender=$_POST['gender'] != null ? $_POST['gender'] : $errorcount++;
$designation=$_POST['designation'] != null ? $_POST['designation'] : $errorcount++;
$department=$_POST['department'] != null ? $_POST['department'] : $errorcount++;



if(filter_var($email, FILTER_VALIDATE_EMAIL)) {
    $_SESSION['emailerror']= "Enter a vaild email";
}

// superadmin paas: admin@#$%1;
// superadmin email: superadmin@tech.com;

$_SESSION['first_name'] = $_POST['first_name'];
$_SESSION['last_name'] = $_POST['last_name'];
$_SESSION['email'] = $_POST['email'];
$_SESSION['password'] = $_POST['password'];
$_SESSION['gender'] = $_POST['gender'];
$_SESSION['designation'] = $_POST['designation'];
$_SESSION['department'] = $_POST['department'];


if(!(preg_match("/^[a-zA-Z0-9._-]+@[a-zA-Z0-9-]+\.[a-zA-Z.]{2,5}$/", $email))) {
    $_SESSION['emailerror']= "Enter a vaild email";
    $validate++;
}
if (!preg_match("/^[A-Za-z]{2,}$/", $first_name)){
    $_SESSION['nameerror']= " Name cannot contain number and not less than 2 characters";
    $validate++;
}
if (!(preg_match("/^[A-Za-z]{2,}$/", $last_name))){ 
    $_SESSION['nameerror']= " Name cannot contain number and not less than 2 characters";
    $validate++;
}




if($errorcount > 0 ){
    $_SESSION['error']="Ther are " . $errorcount ."empty fields";
        header("Location:register.php");
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
        header("Location:register.php");
    }

    $newUserId = $countUsers++;

    for($counter =0; $counter < $countUsers; $counter++){
        if( $allUsers[$counter] == $email .".json"){
            $_SESSION['emailerror'] = 'Users already Exist';
            header("Location:register.php");
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
    echo "Registration Successfull";
    file_put_contents("db/users/" . $email . ".json",json_encode($userObject));
    $_SESSION['message']="You can now login, registration successfull";
    header("Location: login.php");
}

?>