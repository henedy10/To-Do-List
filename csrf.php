<?php
function GenerateToken(){
    if(!isset($_SESSION['CSRF_Token'])){
        $_SESSION['CSRF_Token']=bin2hex(random_bytes(32));
    }
    return $_SESSION['CSRF_Token'];
}
?>