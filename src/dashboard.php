<!-- TODO Main view or Employees Grid View here is where you get when logged here there's the grid of employees -->
<?php
session_start();

if(isset($_POST['logout'])){
    // unset($_SESSION['logged']);
    // unset($_SESSION['userId']);
    // unset($_SESSION['username']);
    // unset($_SESSION['email']);
    // unset($_SESSION['logTime']);
    session_destroy();

    $url = '../index.php';
    header('Location: ' . $url);
    die();
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
    <?php echo '<p>Welcome '. $_SESSION['username'] . '!</p>'; ?>
    <form action="dashboard.php" method="post">
        <input type="submit" name="logout" value="Logout"/>
    </form>
</body>
</html>