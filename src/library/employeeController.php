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
    }
}

if(isset($_GET['id'])){
    echo getEmployee($_GET['id']);
}
