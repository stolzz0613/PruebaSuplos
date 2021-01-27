<?php
    //Script que permite insertar un nuevo registro en mis_bienes
    include 'db.php';

    if(isset($_POST['Submit']))
    {
        //En caso de que la tabla mis_bienes no esté creada la crearemos
        if(!mysqli_num_rows(mysqli_query($conn,"SHOW TABLES LIKE 'mis_bienes'"))) {
            $createTable_query =
                'CREATE TABLE `Intelcost_bienes`.`mis_bienes`
                (
                    `id` INT NOT NULL AUTO_INCREMENT,
                    PRIMARY KEY (`id`),
                    `id_original` INT(15) NOT NULL,
                    `direccion` VARCHAR(60) NOT NULL,
                    `ciudad` VARCHAR(45) NOT NULL,
                    `telefono` VARCHAR(15) NOT NULL,
                    `codigo_postal` VARCHAR(15) NOT NULL,
                    `tipo` VARCHAR(15) NOT NULL,
                    `precio` VARCHAR(45) NOT NULL
                );';
            mysqli_query($conn, $createTable_query);
        };

        $original_id = $_POST['value']['Id'];
        $direccion = $_POST['value']['Direccion'];
        $ciudad = $_POST['value']['Ciudad'];
        $telefono = $_POST['value']['Telefono'];
        $codigo_postal = $_POST['value']['Codigo_Postal'];
        $tipo = $_POST['value']['Tipo'];
        $precio = $_POST['value']['Precio'];

        //Verificamos que no exista el registro en la tabla
        $query_duplicate = "SELECT * FROM mis_bienes WHERE id_original = $original_id";
        if(mysqli_num_rows(mysqli_query($conn, $query_duplicate))) {
            echo('Esta propiedad ya te pertenece');
            $conn->close();
        } else {
            $query = "INSERT INTO `mis_bienes` (id_original, direccion, ciudad, telefono, codigo_postal, tipo, precio) 
                  VALUES ('$original_id', '$direccion', '$ciudad', '$telefono', '$codigo_postal', '$tipo', '$precio')";

            $insert = mysqli_query($conn, $query);
            $conn->close();
            echo('Añadido a tus bienes');
        }
    }
?>