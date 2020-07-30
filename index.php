<!-- TODO Application entry point. Login view -->
<?php
session_start();
if(isset($_SESSION['logged'])){
    if((time() - $_SESSION['logTime']) > 600){
    // if((time() - $_SESSION['logTime']) > 30){
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
    <link rel="stylesheet" href="../node_modules/bootstrap/dist/css/bootstrap.css">
    <link rel="stylesheet" href="css/login.css">
    <link rel="shortcut icon" href="../resources/img/logo.png">
    <title>Login</title>
</head>
<body>
    <div class="main__container d-flex align-items-center justify-content-center flex-column">
        <img src="resources/img/logo.png" alt="logo" height='100' class="mb-4">
        <form method='post' action='src/library/loginController.php'>
            <div class="form-group">
                <label for="email">Email</label>
                <input type="text" name="email" id="email" placeholder='insert email' class="form-control">
                <?php if(isset($_SESSION['wrong-email'])) echo '<p class="error">User not found</p>' ?>
            </div>
            <div class="form-group">
                <label for="pwd">Password</label>
                <input type="password" name="pwd" id="pwd" placeholder='insert pwd' class="form-control">
                <?php if(isset($_SESSION['wrong-pwd'])) echo '<p class="error">Wrong password</p>' ?>
            </div>
            <button type='submit' class="btn btn-outline-dark">Submit</button>
        </form>
    </div>
    <script src="../node_modules/jquery/dist/jquery.js"></script>
    <script src="https://kit.fontawesome.com/de217cab6a.js" crossorigin="anonymous"></script>
    <script src="../node_modules/bootstrap/js/dist/index.js" defer></script>
    <script src="https://unpkg.com/axios/dist/axios.min.js"></script>
</body>
</html>