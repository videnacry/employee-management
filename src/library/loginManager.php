<?php
/**
 * Update JSON file
 * @param {String} $filePath -> path of json file
 * @param {Array} $data -> json file content
 */
function updateJson(string $filePath, object $data){
    $fileTempPath = str_replace(".json", "-temp.json", $filePath);
    $file = $fileTempPath;
    fopen($file, "w");
    file_put_contents($file, json_encode($data));
    if (!unlink($filePath)) {
       return false;
    } else {
       rename($file, $filePath);
       return true;
    }
}
/**
 * Create user object
 * @param {array} $data -> object whose contains user data as properties 
 */
function createUser(array $data):object{
    $newUser = new stdClass();
    $newUser->userId =$data['userId'];
    $newUser->name = $data['name'];
    $newUser->email = $data['email'];
    $newUser->password = $data['password'];
    return $newUser;
}
function getUsers(){
    return file_get_contents('../../resources/users.json');
}
function addUser($data){
    $users = json_decode(file_get_contents('../../resources/users.json'));
    $data['userId'] = (count($users->users)>0)? end($users->users)->userId+1 : 1;
    $newUser = createUser($data);
    array_push($users->users, $newUser);
    if(updateJson('../../resources/users.json', $users)){
        return json_encode($newUser);
    }else{
        return 'Couldn\'t get the database' ;
    }
}
function deleteUser($id){
    $users = json_decode(file_get_contents('../../resources/users.json'));
    foreach($users->users as $index => $user){
        if($user->userId == $id){
            array_splice($users->users,$index,1);
        }
    }
    if(updateJson('../../resources/users.json', $users)){
        return json_encode($users);
    }else{
        return 'Couldn\'t get the database' ;
    }
}
function updateUser($data){
    $users = json_decode(file_get_contents('../../resources/users.json'));
    $newData = createUser($data);
    foreach($users->users as $index => $user){
        if($user->userId == $newData->userId){
            $users->users[$index] = $newData;
        }
    }
    if(updateJson('../../resources/users.json', $users)){
        return json_encode($newData);
    }else{
        return 'Couldn\'t get the database' ;
    }
}

function userLogin($email, $pwd){
    $admins = json_decode(file_get_contents('../../resources/users.json'));
    
    foreach ($admins->users as $key => $user) {
        if($user->email === $email && password_verify($pwd, $user->password)){
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
        }elseif($user->email === $email && !password_verify($pwd, $user->password)){
            session_start();
    
            $_SESSION['wrong-pwd'] = true;
            if(isset($_SESSION['wrong-email'])) unset($_SESSION['wrong-email']);
    
            $url = '../../index.php';
            header('Location: ' . $url);
            die();
        }elseif ($user->email !== $email && $key+1 === count($admins->users)) {
            session_start();
    
            $_SESSION['wrong-email'] = true;
            if(isset($_SESSION['wrong-pwd'])) unset($_SESSION['wrong-pwd']);
    
            $url = '../../index.php';
            header('Location: ' . $url);
            die();
        }
    }
}
