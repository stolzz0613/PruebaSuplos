<?php
    //Script que permite traer todos los registros que hay en la tabla mis_bienes
    include 'db.php';

    $misBienes=[];
    $buffer = [];
    $query = "SELECT * FROM mis_bienes";

    if(isset($_POST['Get']))
    {
        
        if(mysqli_num_rows($resultado = mysqli_query($conn, $query))) {
            $buffer = [];
            while ($row = mysqli_fetch_row($resultado)) {
                $buffer[] = $row;
            }
            $conn->close();
            if (count($buffer) != 0) {
                foreach ($buffer as $element) {
                    $data[] = [
                        'Id' => $element[0],
                        'Direccion' => $element[2],
                        'Ciudad' => $element[3],
                        'Telefono' => $element[4],
                        'Codigo_Postal' => $element[5],
                        'Tipo' => $element[6],
                        'Precio' => $element[7],
                    ];
                };
                echo $misBienes = json_encode($data);
            }
        } else {
            $misBienes = [];
        }
    };
?>