<?php
    //Parametros para la conexion a la base de datos
    $conn = mysqli_connect(
        '127.0.0.1',
        'root',
        'root',
        'Intelcost_bienes'
    );
    
    if(!$conn){
        die('No se pudo conetar: '.mysqli_connect_error());
    };
?>