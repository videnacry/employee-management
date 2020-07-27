<?php
session_start();
if(isset($_SESSION['logged'])){
    if((time() - $_SESSION['logTime']) > 600000){
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
    <div class="main d-flex flex-column justify-content-between">
        <?php include('../assets/header.html') ?>
        <div class='main__content d-flex justify-content-center align-items-center'>
            <form id="employeeForm" class="my-5">
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="name">Name</label>
                        <input type="text" class="form-control" id="nameInp" name="name" placeholder="Name">
                    </div>
                    <div class="form-group col-md-6">
                        <label for="surname">Last Name</label>
                        <input type="text" class="form-control" id="surnameInp" placeholder="Last name" name="surname">
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="email">Email adress</label>
                        <input type="email" class="form-control" name="email" id="emailInp" placeholder="Email address">
                    </div>
                    <div class="form-group col-md-6">
                        <label for="gender">Gender</label>
                        <select name="gender" id="genderInp" class="form-control">
                            <option value="select" disabled selected>Select</option>
                            <option value="man">Man</option>
                            <option value="woman">Woman</option>
                            <option value="undefined">Undefined</option>
                        </select>
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="city">City</label>
                        <input type="text" name="city" id="cityInp" class="form-control" placeholder="City">
                    </div>
                    <div class="form-group col-md-6">
                        <label for="address">Street Address</label>
                        <input type="text" name="address" id="addressInp" class="form-control" placeholder="Street Adress">
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="state">State</label>
                        <input type="text" name="state" id="stateInp" class="form-control" placeholder="State or Province">
                    </div>
                    <div class="form-group col-md-6">
                        <label for="age">Age</label>
                        <input type="number" name="age" id="ageInp" class="form-control" placeholder="Age">
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="po">Postal Code</label>
                        <input type="text" name="po" id="poInp" class="form-control" placeholder="Postal Code">
                    </div>
                    <div class="form-group col-md-6">
                        <label for="phone">Phone Number</label>
                        <input type="tel" name="phone" id="phoneInp" class="form-control" placeholder="Phone number">
                    </div>
                </div>
                <div class="mt-3 d-flex justify-content-end">
                    <button class="btn btn-outline-dark" id='submitForm'>Submit</button>
                    <button class="btn btn-outline-danger mx-2">Return</button>
                </div>
            </form>
        </div>
        <?php include('../assets/footer.html') ?>
    </div>
    <script src="../node_modules/jquery/dist/jquery.js"></script>
    <script src="https://kit.fontawesome.com/de217cab6a.js" crossorigin="anonymous"></script>
    <script src="../node_modules/bootstrap/js/dist/index.js" defer></script>
    <script src="https://unpkg.com/axios/dist/axios.min.js"></script>
    <script src="../js/employee.js"></script>
</body>
</html>