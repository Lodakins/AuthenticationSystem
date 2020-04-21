<?php

function generate_token(){
    $token="";
            $alphabets=['a','b','c','d','e','f','g','h','i','j','k','l','m','n','o','p','q','r','s','t','u','w','x','y','z'];

             for( $i=0; $i < 26; $i++ ){
                $index= mt_rand(0,count($alphabets) - 1);
                $token.=$alphabets[$index];  
            }
        return $token;

}

function check_token($email){
    $allUsersToken = scandir("db/token");
    $countUsersToken = count($allUsersToken);

    for($counter =0; $counter < $countUsersToken; $counter++){
        if( $allUsersToken[$counter] == $email .".json"){
            $tokenfile = file_get_contents("db/token/". $email.".json");
            $tokenobject = json_decode($tokenfile);
            $tokenfromdb =$tokenobject->token;

        return $tokenfromdb;
        }
    }
    return false;
}




?>