<?php
    //Script para el borrado de un registro dado su ID
    include 'db.php';
    include 'getData.php';

    if(isset($_POST['Delete']))
    {
        $id = $_POST['value'];

        $delete_query = "DELETE FROM mis_bienes WHERE id = $id";
        $resultado = mysqli_query($conn, $delete_query);
        if ($resultado) {
            echo ('Registro eliminado exitosamente');
        }
        $conn->close();
    };

?>