<?php
/**
 * EMPLOYEE FUNCTIONS LIBRARY
 *
 * @author: Jose Manuel Orts
 * @date: 11/06/2020
 */

function addEmployee(array $newEmployee)
{
// TODO implement it
    $employeesObject = json_decode(file_get_contents('../../resources/employees.json'));
    $employeeData = new stdClass();
    $employeeData->id = count($employeesObject) + 1;
    foreach($newEmployee as $index => $value){
        $employeeData -> {$index} = $value;
    }
    array_push($employeesObject,$employeeData);
    $employeesJSON = json_encode($employeesObject);
    file_put_contents('../../resources/employees.json', $employeesJSON);
    return $employeesJSON;
}

function deleteEmployee(string $id)
{
// TODO implement it
}


function updateEmployee($id, $nEmployee){
    // return (json_encode($nEmployee));
    $employees = json_decode(file_get_contents('../../resources/employees.json'));
    foreach ($employees as $key => $employee) {
        if($employee->id == $id){
            $employee->name = $nEmployee['name'];
            $employee->lastName = $nEmployee['surname'];
            $employee->age = $nEmployee['age'];
            $employee->city = $nEmployee['city'];
            $employee->email = $nEmployee['email'];
            $employee->gender = $nEmployee['gender'];
            $employee->phoneNumber = $nEmployee['phone'];
            $employee->postalCode = $nEmployee['po'];
            $employee->state = $nEmployee['state'];
            $employee->streetAddress = $nEmployee['address'];

            $file = '../../resources/employees.json';
            $fp = fopen($file, 'w');
            fwrite($fp, json_encode($employees));
            fclose($fp);

            return json_encode($employee);
        }
    }
}


function getEmployee(string $id){
    $employees = json_decode(file_get_contents('../../resources/employees.json'));
    foreach ($employees as $key => $employee) {
        if($employee->id == $id) return json_encode($employee);
    }
}

function getEmployees(){
    return file_get_contents('../../resources/employees.json');
}

function printTable(){
    echo '<table class="table table-bordered table-dark table-hover table-responsive rounded shadow">';
            $employeesObject = json_decode(file_get_contents('../../resources/employees.json'));
            echo '<thead id="employees-columns"><tr class="thead-light">';
            $i = 0;
            foreach($employeesObject[0] as $index=>$data){
                if($i === 0){
                    $i++;
                    continue;
                }
                echo '<th class="user-select-all" data-column="'.$index.'">'.$index.'</th>';
            }
            echo '<th><button id="add-employee" class="btn btn-block text-success">
                <i class="fas fa-plus h5"></i></button></th></tr></thead>
                <tbody id="employees-rows">';
            define("pages",count($employeesObject));
            if(pages>10){
                printRow($employeesObject, 10);
                printPagination(pages/10);
            }
            else{
                printRow($employeesObject);
            }
            echo '<div class="d-flex justify-content-end"><button id="reload" class="btn btn-outline-warning font-weight-bold shadow px-4 mx-2">reload</button>
                <button id="save" class="btn btn-outline-success font-weight-bold shadow px-4 mx-2">Save</button></div>';

}function printRow($haystack, $count = 0){
    if($count == 0){
        $count = count($haystack);
    }
    for($index = 0; $count>$index; $index++){
        echo '<tr data-id="' . $haystack[$index]->id . '">';
        $i = 0;
        foreach($haystack[$index] as $data){
            if($i === 0){
                $i++;
                continue;
            }
            echo '<td class="user-select-all">'.$data.'</td>';
        }
        echo '<td><button data-id=' . $haystack[$index]->id . ' class="btn-block btn text-danger"><i class="fas fa-trash-alt"></i></button></td></tr>';
    }
    echo '</tbody></table>';
}
function printPagination($quantity){
    $quantity++;
    echo '<nav aria-label="table pages navigation"><ul id="pagination-items" class="pagination shadow"><li class="page-item">
        <a class="page-link bg-light" href="#">Previous</a></li>';
    for($index = 1; $quantity > $index; $index++){
        echo '<li class="page-item"><a class="page-link bg-light" href="#">' . $index . '</a></li>';
    }
    echo '<li class="page-item"><a class="page-link bg-light" href="#">Next</a></li></ul></nav>';
}

function removeAvatar($id)
{
// TODO implement it
}


function getQueryStringParameters(): array
{
// TODO implement it
}

function getNextIdentifier(array $employeesCollection): int
{
// TODO implement it
}
