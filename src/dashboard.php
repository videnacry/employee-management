<!-- TODO Main view or Employees Grid View here is where you get when logged here there's the grid of employees -->
<!DOCTYPE html>
<html>

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta charset="utf-8" />
    <title>Dashboard</title>
    <script src="../node_modules/jquery/dist/jquery.js"></script>
    <link rel="stylesheet" href="../node_modules/bootstrap/dist/css/bootstrap.css">
    </link>
    <script src="https://kit.fontawesome.com/de217cab6a.js" crossorigin="anonymous"></script>
    <script src="../node_modules/bootstrap/js/dist/index.js" defer></script>
    <script src="../js/dashboard.js" defer></script>
</head>

<body>

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
    <?php echo '<p>Welcome '. $_SESSION['username'] . '!</p>'; ?>
    <?php if(isset($_SESSION['username'])){
        $postData = ['query' => 'printTable'];  
         
        $curlHandler = curl_init('library\employeeController.php');  
        curl_setopt($curlHandler, CURLOPT_POST, $postData);  
        curl_setopt($curlHandler, CURLOPT_RETURNTRANSFER, true);
        $apiResponse = curl_exec($curlHandler);  
        curl_close($curlHandler); 
        var_dump($apiResponse);
        }
    ?>
    <form action="dashboard.php" method="post">
        <input type="submit" name="logout" value="Logout" />
    </form>
    <div class="container">

    </div>
</body>

</html>