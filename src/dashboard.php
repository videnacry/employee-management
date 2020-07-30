<!-- TODO Main view or Employees Grid View here is where you get when logged here there's the grid of employees -->
<?php include('library/sessionHelper.php'); ?>
<!DOCTYPE html>
<html>

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta charset="utf-8" />
    <title>Dashboard</title>
    <link rel="stylesheet" href="../node_modules/bootstrap/dist/css/bootstrap.css">
    <link rel="stylesheet" href="../css/main.css"/>
</head>

<body>
    <div class="main d-flex flex-column justify-content-between">
        <?php include('../assets/header.html') ?>
        <div class='main__content d-flex justify-content-center align-items-center flex-column'>
            <ul id="contextmenu" class="list-group list-group-flush contextmenu rounded">
                <a id="create-data" href="#" class="list-group-item list-group-item-light list-group-item-action border-bottom-0">
                    <i class="fas fa-user-plus"></i><small>&nbsp;&nbsp;&nbsp;Create employee</small>
                </a>
                <a id="update-data" href="#" class="list-group-item list-group-item-light list-group-item-action border-bottom-0">
                    <i class="fas fa-user-edit"></i><small>&nbsp;&nbsp;&nbsp;Update data</small>
                </a>
                <a href="#" class="list-group-item list-group-item-light list-group-item-action border-bottom-0">
                    <i class="fas fa-user-times"></i><small>&nbsp;&nbsp;&nbsp;Delete employee</small>
                </a>
                <a href="#" class="list-group-item list-group-item-light list-group-item-action">
                    <i class="fas fa-edit"></i><small>&nbsp;&nbsp;&nbsp;Update row</small>
                </a>
                <a href="#" class="list-group-item list-group-item-light list-group-item-action border-bottom-0">
                    <i class="fas fa-redo-alt"></i><small>&nbsp;&nbsp;&nbsp;Reload</small>
                </a>
                <a href="#" class="list-group-item list-group-item-light list-group-item-action border-bottom-0">
                    <i class="fas fa-sign-out-alt"></i><small>&nbsp;&nbsp;&nbsp;Logout</small>
                </a>
            </ul>
            <!-- <form action="dashboard.php" method="post">
                <input type="submit" name="logout" value="Logout" />
            </form> -->
            <div class="container">

                <?php if(isset($_SESSION['username'])){
                    echo '<p>Welcome '. $_SESSION['username'] . '!</p>';
                    $postData = ['query' => 'printTable'];

                    //$curlHandler = curl_init('http://employee-management.localhost/src/library/employeeController.php');
                    $curlHandler = curl_init((isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http").'://'.$_SERVER['HTTP_HOST'].'/employee-management/src/library/employeeController.php');
                    curl_setopt($curlHandler, CURLOPT_POSTFIELDS, $postData);
                    curl_setopt($curlHandler, CURLOPT_RETURNTRANSFER, true);
                    $apiResponse = curl_exec($curlHandler);
                    curl_close($curlHandler);
                    echo $apiResponse;
                    }
                ?>

            </div>
        </div>
        <?php include('../assets/footer.html') ?>
    </div>

    <script src="../node_modules/jquery/dist/jquery.js"></script>
    <script src="https://kit.fontawesome.com/de217cab6a.js" crossorigin="anonymous"></script>
    <script src="../node_modules/bootstrap/js/dist/index.js"></script>
    <script src="../js/dashboard.js"></script>
</body>

</html>