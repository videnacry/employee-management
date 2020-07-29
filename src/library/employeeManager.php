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

function addEmployees(array $newEmployees){
    
    $employeesObject = json_decode(file_get_contents('../../resources/employees.json'));
    $count = count($employeesObject);
    foreach($newEmployees as $newEmployee){
        $employeeData = new stdClass();
        $count++;
        $employeeData->id = $count;
        foreach($newEmployee as $index => $value){
            $employeeData -> {$index} = $value;
        }
        array_push($employeesObject,$employeeData);        
    }
    $employeesJSON = json_encode($employeesObject);
    file_put_contents('../../resources/employees.json', $employeesJSON);
    return $employeesJSON;
}

function deleteEmployee(string $id)
{
// TODO implement it
    $employees = json_decode(file_get_contents('../../resources/employees.json'));
    foreach($employees as $index => $employee){
        if($employee->id == $id){
            unset($employees[$index]);
        break;
        }
    }
    $employeesJSON = json_encode($employees);
    file_put_contents('../../resources/employees.json',$employeesJSON);
    return $employeesJSON;
}


function updateEmployee($id, $nEmployee){
    // return (json_encode($nEmployee));
    //API KEY -> 4B25747F-51664BE8-97A405EA-4437BFA2
    $employees = json_decode(file_get_contents('../../resources/employees.json'));

    $newEmployee = new stdClass();
    $newEmployee->name = $nEmployee['name'];
    $newEmployee->lastName = $nEmployee['lastName'];
    $newEmployee->age = $nEmployee['age'];
    $newEmployee->city = $nEmployee['city'];
    $newEmployee->email = $nEmployee['email'];
    $newEmployee->gender = $nEmployee['gender'];
    $newEmployee->phoneNumber = $nEmployee['phoneNumber'];
    $newEmployee->postalCode = $nEmployee['postalCode'];
    $newEmployee->state = $nEmployee['state'];
    $newEmployee->streetAddress = $nEmployee['streetAddress'];

    foreach ($employees as $key => $employee) {
        if($employee->id == $id){
            $newEmployee->id = $id;
            $employees[$key] = $newEmployee;
        }elseif(($key + 1 === count($employees)) && $id === 'new'){
            $newEmployee->id = intval($employees[$key]->id) + 1;
            array_push($employees, $newEmployee);
        }
    }

    $file = '../../resources/employees.json';
    $fp = fopen($file, 'w');
    fwrite($fp, json_encode($employees));
    fclose($fp);

    if($id === 'new'){
        return $newEmployee->id;
    }else{
        return 'modified';
    };
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
    echo '</tbody></table>
          <script>
                let employeesObject = ' . json_encode($haystack) . '
          </script>';
}
function printPagination($quantity){
    $quantity++;
    echo '<nav aria-label="table pages navigation"><ul id="pagination-items" class="pagination shadow"><li class="page-item">
        <a id="previous" class="page-link bg-light" href="#" >Previous</a></li>';
    for($index = 1; $quantity > $index; $index++){
        echo '<li class="page-item"><a class="page-link bg-light" href="#" data-number="'.$index.'">' . $index . '</a></li>';
    }
    echo '<li id="next" class="page-item"><a class="page-link bg-light" href="#">Next</a></li></ul></nav>';
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
