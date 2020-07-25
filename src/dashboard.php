<!-- TODO Main view or Employees Grid View here is where you get when logged here there's the grid of employees -->
<!DOCTYPE html>
<html>
    <head>
        <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
        <meta charset="utf-8"/>
        <title>Dashboard</title>
        <script src="../node_modules/jquery/dist/jquery.js"></script>
        <link rel="stylesheet" href="../node_modules/bootstrap/dist/css/bootstrap.css"></link>
        <script src="../node_modules/bootstrap/js/dist/index.js" defer></script>
        <script src="https://kit.fontawesome.com/de217cab6a.js" crossorigin="anonymous"></script>
    </head>
    <body>
        <div class="container">
    
                <?php 
                    echo '<table class="table table-bordered table-dark table-hover table-responsive rounded shadow">';
                    session_start();
                    $employeesObject = json_decode(file_get_contents('../resources/employees.json'));
                    echo '<tr class="thead-light">';
                    foreach($employeesObject[0] as $index=>$data){
                        echo '<th class="user-select-all">'.$index.'</th>';
                    }
                    echo '<th><button class="btn btn-block text-success"><i class="fas fa-plus h5"></i></button></th></tr>';
                    define("pages",count($employeesObject));
                    if(pages>10){
                        printRow($employeesObject, 10);    
                        printPagination(pages/10);                
                    }
                    else{
                        printRow($employeesObject);
                    }
                    function printRow($haystack, $count = 0){
                        if($count == 0){
                            $count = count($haystack);
                        }
                        for($index = 0; $count>$index; $index++){   
                            echo '<tr class="table-sm">';     
                            foreach($haystack[$index] as $data){
                                echo '<td class="user-select-all">'.$data.'</td>';
                            }
                            echo '<td><button class="btn-block btn text-danger"><i class="fas fa-trash-alt"></i></button></td></tr>';
                        }
                        echo '</table>';
                    }
                    function printPagination($quantity){
                        $quantity++;
                        echo '<nav aria-label="table pages navigation"><ul class="pagination shadow"><li class="page-item">
                            <a class="page-link bg-light" href="#">Previous</a></li>';
                        for($index = 1; $quantity > $index; $index++){
                            echo '<li class="page-item"><a class="page-link bg-light" href="#">' . $index . '</a></li>';
                        }
                        echo '<li class="page-item"><a class="page-link bg-light" href="#">Next</a></li></ul></nav>';
                    }
                ?>
        </div>
    </body>
</html>