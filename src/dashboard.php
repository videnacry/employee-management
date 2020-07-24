<!-- TODO Main view or Employees Grid View here is where you get when logged here there's the grid of employees -->
<!DOCTYPE html>
<html>
    <head>
        <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
        <meta charset="utf-8"/>
        <title>Dashboard</title>
    </head>
    <body>
        <table>

            <?php 
                session_start();
                $employeesObject = json_decode(file_get_contents('../resources/employees.json'));
                echo '<tr>';
                foreach($employeesObject[0] as $index=>$data){
                    echo '<th>'.$index.'</th>';
                }
                echo '<th><button>+</button></th></tr>';
                for($index = 0; 10>$index; $index++){   
                    echo '<tr>';     
                    foreach($employeesObject[$index] as $data){
                        echo '<td>'.$data.'</td>';
                    }
                    echo '<th><button>-</button></th></tr>';
                }
            ?>
        </table>
    </body>
</html>