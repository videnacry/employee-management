<!-- TODO Main view or Employees Grid View here is where you get when logged here there's the grid of employees -->
<!DOCTYPE html>
<html>
    <head>
        <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
        <meta charset="utf-8"/>
        <title>Dashboard</title>
        <script src="../node_modules/jquery/dist/jquery.js"></script>
        <link href="../node_modules/bootstrap/dist/css/bootstrap.css"></link>
        <script src="../node_modules/bootstrap/js/dist/index.js" defer></script>
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
                if(count($employeesObject)>10){
                    printRow($employeesObject, 10);                    
                }
                else{
                    printRow($employeesObject);
                }
                function printRow($haystack, $count = 0){
                    if($count == 0){
                        $count = count($haystack);
                    }
                    for($index = 0; $count>$index; $index++){   
                        echo '<tr>';     
                        foreach($haystack[$index] as $data){
                            echo '<td>'.$data.'</td>';
                        }
                        echo '<th><button>-</button></th></tr>';
                    }
                }
            ?>
        </table>
    </body>
</html>