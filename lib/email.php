<?php

function send_mail($subject,$message,$email){
    $headers="From: no-reply@snh.com" . "\r\n". "CC: somebody@example.com";
    $try= mail($email,$subject,$message,$headers);
    if($try) return true;

    return false;
}




?>