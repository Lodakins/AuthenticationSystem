<?php

    function session_set($type){
        return isset($_SESSION[$type]);
    }

?>