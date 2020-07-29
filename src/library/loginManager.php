<?php
function getUsers(){
    return file_get_contents('../../resources/users.json');
}
?>