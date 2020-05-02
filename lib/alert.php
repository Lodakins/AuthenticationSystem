<?php
function message(){
    if(isset($_SESSION['message']) && !empty($_SESSION['message'])){
        echo '<span style="color:green">' . $_SESSION['message'] . ' </span>';
       session_destroy();
     }
}

function error(){
    if(isset($_SESSION['error']) && !empty($_SESSION['error'])){
        echo '<span style="color:red">' . $_SESSION['error'] . ' </span> <br/>';
            session_destroy();
     } 
}

function setAlert($type="message",$content=""){

  switch($type){
    case "error":
      $_SESSION['error']=$content;
    break;
    case "message":
      $_SESSION['message']=$content;
    break;
    case "info":
      $_SESSION['info']=$content;
    break;
    default:
      $_SESSION['message']=$content;
  break;
  }

}

function setAlert1($type="message",$content=""){

  switch($type){
    case "error":
     setcookie($type,$content,time()+ (86400 * 30));
    break;
    case "message":
      setcookie($type,$content,time()+ (86400 * 30));
    break;
    case "info":
      setcookie($type,$content,time()+ (86400 * 30));
    break;
    default:
    setcookie($type,$content,time()+ (86400 * 30));
  break;
  }

}


function printAlert(){
$types=['error','message','info'];
$colors=['alert-warning',"alert-success","alert-secondary"];

for($i=0 ; $i < count($types) ;$i++){
  if(isset($_SESSION[$types[$i]]) && !empty($_SESSION[$types[$i]])){
   echo '<div class="alert '.$colors[$i] .'" alert-warning alert-dismissible fade show" role="alert">
        '.  $_SESSION[$types[$i]] .'
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
        </div>';
        if(session_id()){
          unset ($_SESSION[$types[$i]]);
          }
  } 
}

}

function printAlert1(){
  $types=['error','message','info'];
  $colors=['alert-warning',"alert-success","alert-secondary"];
  
  for($i=0 ; $i < count($types) ;$i++){
    if(isset($_COOKIE[$types[$i]])){
      echo '<div class="alert '.$colors[$i] .'" alert-warning alert-dismissible fade show" role="alert">
        '.  $_COOKIE[$types[$i]] .'
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
        </div>';
      setcookie($types[$i],"",time()-36000);
    } 
  }
 
  }






?>