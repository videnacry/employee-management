<?php
session_start();
if(isset($_SESSION['logged'])){
    if((time() - $_SESSION['logTime']) > 600){
    // if((time() - $_SESSION['logTime']) > 30){
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

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    
</body>
</html>