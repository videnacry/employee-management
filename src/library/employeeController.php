<?php
require 'employeeManager.php';
switch($_POST['query']){
    case 'getEmployees':
        echo getEmployees();
    break;
    case 'printTable':
        echo printTable();
    break;
}
echo 'why?';