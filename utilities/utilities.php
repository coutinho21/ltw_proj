<?php
    function cleanInput($string){
        return htmlentities($string, ENT_QUOTES, 'UTF-8');
    }

    function generateToken(){
        return bin2hex(openssl_random_pseudo_bytes(32));
    }
?>