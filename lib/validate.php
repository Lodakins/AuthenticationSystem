<?php

   function validate($type,$content){
       switch($type){
           case "email":
            if(!(preg_match("/^[a-zA-Z0-9._-]+@[a-zA-Z0-9-]+\.[a-zA-Z.]{2,5}$/", $content))) {
                $_SESSION['emailerror']= "Enter a vaild email";
                return false;
            }else{
                return true;
            }
           break;
           case "name":
           if(!preg_match("/^[A-Za-z]{2,}$/", $content)){
                $_SESSION['nameerror']= " Name cannot contain number and not less than 2 characters";
                return false;
            }else{
                return true;
            }
            break;
            case "date":
                if(!preg_match("/^\d{4}\-\d{1,2}\-\d{1,2}$/", $content)){
                    $_SESSION['dateerror']= " Date must be in this format YYYY-MM-DD";
                    return false;
                }else{
                    return true;
                }
            break;
        
    }
};




  function printValidationStatus(){
    $types=['dateerror','nameerror','emailerror'];
    for($i=0 ; $i < count($types) ;$i++){
        if(isset($_SESSION[$types[$i]]) && !empty($_SESSION[$types[$i]])){
         echo '<div class="alert alert-warning alert-dismissible fade show" role="alert">
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


  function generateRandomText(){
    $txref = "txref_";
    for ($i = 0; $i < 7; $i++) {
        $txref .= mt_rand(0, 6);
    }
    return $txref;
  }

?>