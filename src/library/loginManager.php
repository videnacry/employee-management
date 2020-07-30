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
function getUsers(){
    return file_get_contents('../../resources/users.json');
}
function addUser($data){
    $users = json_decode(file_get_contents('../../resources/users.json'));
    $newUser = new stdClass();
    $newUser->id = (count($users->users)>0)? end($users->users)->userId+1 : 1;
    $newUser->email = $data['email'];
    $newUser->password = $data['password'];
    $newUser->name = $data['name'];
    array_push($users->users, $newUser);
    if(updateJson('../../resources/users.json', $users)){
        return json_encode($newUser);
    }else{
        return 'Couldn\'t get the database' ;
    }
}
?>