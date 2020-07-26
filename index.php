<!-- TODO Application entry point. Login view -->
<?php
session_start();
if(isset($_SESSION['logged'])){
    // if((time() - $_SESSION['logTime']) > 600){
    if((time() - $_SESSION['logTime']) > 30){
        // unset($_SESSION);
        session_destroy();
    }else{
        $url = 'src/dashboard.php';
        header('Location: ' . $url);
        exit();
    }
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/login.css">
    <title>Login</title>
</head>
<body>
    <form method='post' action='src/library/loginController.php'>
        <input type="text" name="email" id="email" placeholder='insert email'>
        <?php if(isset($_SESSION['wrong-email'])) echo '<p class="error">User not found</p>' ?>
        <input type="text" name="pwd" id="pwd" placeholder='insert pwd'>
        <?php if(isset($_SESSION['wrong-pwd'])) echo '<p class="error">Wrong password</p>' ?>
        <button type='submit'></button>
    </form>
</body>
</html>