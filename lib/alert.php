<?php
function message(){
    if(isset($_SESSION['message']) && !empty($_SESSION['message'])){
        echo '<span style="color:green">' . $_SESSION['message'] . ' </span>';
       session_destroy();
     }
}

function error1(){
    if(isset($_SESSION['error11']) && !empty($_SESSION['error1'])){
        echo '<span style="color:red">' . $_SESSION['error1'] . ' </span>';
       session_destroy();
     }
}

function error(){
    if(isset($_SESSION['error']) && !empty($_SESSION['error'])){
        echo '<span style="color:red">' . $_SESSION['error'] . ' </span> <br/>';
            session_destroy();
     } 
}

function loggedin(){
    if(isset($_SESSION['loggedin']) && !empty($_SESSION['loggedin'])){
      $role = $_SESSION['role'];
      if($role== "admin"){
          header("Location: admindashboard.php");
          die();
      }else{
        header("Location:dashboard.php");
        die();
      }
    
    }
}




?>