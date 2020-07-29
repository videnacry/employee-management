<?php
require 'employeeManager.php';
if(isset($_POST['query'])){
    switch($_POST['query']){
        case 'getEmployees':
            echo getEmployees();
        break;
        case 'printTable':
            echo printTable();
        break;
        case 'addEmployee':
            unset($_POST['query']);
            echo addEmployee($_POST);
        break;
        case 'addEmployees':
            echo addEmployees($_POST['employees']);
        break;
        case 'deleteEmployee':
            echo deleteEmployee($_POST['id']);
        break;
    }
}

if(isset($_GET['id'])){
    if ($_SERVER['REQUEST_METHOD'] === 'GET') echo getEmployee($_GET['id']);
    if ($_SERVER['REQUEST_METHOD'] === 'POST'){
        $tmp = json_decode(file_get_contents("php://input"), true);
        echo updateEmployee($_GET['id'], $tmp['employee']);
    }
}
