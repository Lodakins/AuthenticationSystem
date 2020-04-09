<?php

        function storeUserLog( $email ){
            $allUsers = scandir("db/login");
            $countUsers = count($allUsers);

            
    for($counter =0; $counter < $countUsers; $counter++){
        if( $allUsers[$counter] == $email){
            
            $_SESSION['emailerror'] = 'Users already Exist';
            header("Location:register.php");
            die();
        }
    }


        }




?>