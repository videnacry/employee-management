<?php
session_start();
if(isset($_SESSION['logged'])){
    if(((time() - $_SESSION['logTime']) > 600) || isset($_POST['logout'])){
        // unset($_SESSION);
        session_destroy();
        $url = '../index.php';
        header('Location: ' . $url);
        exit();
    }
}else{
    $url = '../index.php';
    header('Location: ' . $url);
    exit();
}
