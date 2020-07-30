<?php

include('loginManager.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST'){
    userLogin($_POST['email'], $_POST['pwd']);
}
