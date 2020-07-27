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
    <link rel="stylesheet" href="../node_modules/bootstrap/dist/css/bootstrap.css">
    <link rel="stylesheet" href="../css/main.css">
    <title>Document</title>
</head>
<body>
    <?php include('../assets/header.html') ?>
    <script src="../node_modules/jquery/dist/jquery.js"></script>
    <script src="https://kit.fontawesome.com/de217cab6a.js" crossorigin="anonymous"></script>
    <script src="../node_modules/bootstrap/js/dist/index.js" defer></script>
    <script src="../js/employee.js"></script>
</body>
</html>