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

foreach ($admins->users as $key => $user) {
    if($user->email === $_POST['email'] && password_verify($_POST['pwd'], $user->password)){
        session_start();

        $_SESSION['logged'] = true;
        $_SESSION['userId'] = $user->userId;
        $_SESSION['username'] = $user->name;
        $_SESSION['email'] = $user->email;
        $_SESSION['logTime'] = time();

        if(isset($_SESSION['wrong-email'])) unset($_SESSION['wrong-email']);
        if(isset($_SESSION['wrong-pwd'])) unset($_SESSION['wrong-pwd']);

        $url = '../dashboard.php';
        header('Location: ' . $url);
        die();
    }elseif($user->email === $_POST['email'] && !password_verify($_POST['pwd'], $user->password)){
        session_start();

        $_SESSION['wrong-pwd'] = true;
        if(isset($_SESSION['wrong-email'])) unset($_SESSION['wrong-email']);

        $url = '../../index.php';
        header('Location: ' . $url);
        die();
    }elseif ($user->email !== $_POST['email'] && $key+1 === count($admins->users)) {
        session_start();

        $_SESSION['wrong-email'] = true;
        if(isset($_SESSION['wrong-pwd'])) unset($_SESSION['wrong-pwd']);

        $url = '../../index.php';
        header('Location: ' . $url);
        die();
    }
}
