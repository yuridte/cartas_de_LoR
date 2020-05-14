<?php
if($_COOKIE['login'] != "true"){
    $return_path = 'http://' . $_SERVER['SERVER_NAME'] . $_SERVER["REQUEST_URI"];
    header('Location: entrar.php?return_path=' . $return_path); 
}