<?php

if(isset($_POST['query'])){
    session_start();
    if(isset($_SESSION['logged'])&&$_SESSION['logged']){
        require 'loginManager.php';
        switch($_POST['query']){
            case 'getUsers':
                echo getUsers();
            break;
            case 'updateUser':
                echo updateUser($_POST);
            break;
            case 'deleteUser':
                echo deleteUser($_POST['id']);
            break;
            case 'addUser':
                echo addUser($_POST);
            break;
        }
    }
    die();
}

$admins = json_decode(file_get_contents('../../resources/users.json'));
include('loginManager.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST'){
    userLogin($_POST['email'], $_POST['pwd']);
}
