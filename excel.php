<?php include 'db.php';
    //Script para generar archivo de excel según los parametros del usuario

    if(isset($_GET))
    {
        //Obtenemos la url y la formateamos para poder hacer uso de los parametros
        $url = explode("?", key($_GET));
        $ciudad = str_replace('-', ' ', $url[0]);
        $tipo = str_replace('-', ' ', $url[1]);

        $buffer = [];
        $mis_bienes_export= [];
        $queryString = '';
        
        //Según las condiciones se selecciona el query, si alguno o ninguno de los parametros no fué seleccionado
        // se traen todos los registros que cumplan con la condicion restante o en su defecto todos los registros
        if ($ciudad != ' ' && $tipo != ' '){
            $queryString = 'WHERE ciudad ="'. $ciudad . '"AND tipo ="' . $tipo .'"';
        } elseif ($ciudad != ' ') {
            $queryString = 'WHERE ciudad ="' . $ciudad .'"';
        } elseif ($tipo != ' ') {
            $queryString = 'WHERE tipo="' . $tipo. '"';
        };

        //Se concatena el quey y se traen los registros
        $export_query = "SELECT * FROM mis_bienes " . $queryString;
        $resultado = mysqli_query($conn, $export_query);

        //Si hay registros se crea una tabla en HTLM que posteriormente se exporta en un archivo excel
        //En caso contrario cerramos la pestaña
        //El archivo excel se genera gracias al header application/xls
        if(mysqli_num_rows($resultado) > 0)
        {
         $output .= '
          <table class="table" bordered="1">  
            <tr>  
                <th>Direccion</th>  
                <th>Ciudad</th>  
                <th>Telefono</th>  
                <th>Codigo Postal</th>
                <th>Tipo</th>
                <th>Precio</th>
            </tr>
         ';
         while($row = mysqli_fetch_array($resultado))
         {
          $output .= '
            <tr>  
                <td>'.$row["direccion"].'</td>  
                <td>'.$row["ciudad"].'</td>  
                <td>'.$row["telefono"].'</td>  
                <td>'.$row["codigo_postal"].'</td>  
                <td>'.$row["tipo"].'</td>
                <td>'.$row["precio"].'</td>
            </tr>
          ';
         }
         $output .= '</table>';
         header('Content-Type: application/xls');
         header('Content-Disposition: attachment; filename=download.xls');
         echo $output;
        } else {
            echo "<script>window.close();</script>";
        };
    };
?>
