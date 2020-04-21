<?php
include_once('lib/alert.php');
function is_user_loggedin(){
    if(isset($_SESSION['loggedin']) && !empty($_SESSION['loggedin'])) return true;

    return false;
}

function is_token_set(){
   return is_token_set_in_session() || is_token_set_in_get();
}

function is_token_set_in_session(){
    return isset($_SESSION['token']);
}

function is_token_set_in_get(){
    return isset($_GET['token']);
}

function loggedin(){
    if(is_user_loggedin()){
      $role = $_SESSION['role'];
      if($role== "admin"){
          header("Location: admindashboard.php");
          die();
      }else if($role== "medical_team"){
        header("Location: medicaldashboard.php");
        die();
      }else{
        header("Location:patientdashboard.php");
        die();
      }
    
    }
}

function findUsers($email=""){
    if(!$email){
        setAlert("error","User Email is not set");
        die();
    }
    $allUsers = scandir("db/users");
    $countUsers = count($allUsers);
    for($counter =0; $counter < $countUsers; $counter++){
        if( $allUsers[$counter] == $email .".json"){ 
          
           $file = file_get_contents("db/users/". $email.".json");
           $userObject = json_decode($file);

           return $userObject;
        }
           
    }
    return false;

}

function saveUsers($userObject){
    file_put_contents("db/users/" . $userObject->email . ".json",json_encode($userObject));
}

function redirect($url=""){
    header("Location:".$url);
}

function logout(){
session_unset();
session_destroy();
}


function viewAllUsers(){
    $allUsers = scandir("db/users");
    $countUsers = count($allUsers);
    echo "<table> <thead><tr><th> First Name</th><th>Last Name</th><th>
    Email</th> <th> Gender</th> <th> Designation</th> <th> Department</th>
    </tr></thead><tbody>";
    for($counter =2; $counter < $countUsers; $counter++){
        $file = file_get_contents("db/users/".$allUsers[$counter].".json");
        $userObject = json_decode($file);
        echo "<tr><td>".$$userObject->first_name."</td>
        <td>".$$userObject->last_name."</td><
        td>".$$userObject->email."</td>
        <td>".$$userObject->gender."</td>
        <td>".$$userObject->designation."</td>
        <td>".$$userObject->department."</td></tr>";

    }
    echo "</tbody></table>";
}




?>