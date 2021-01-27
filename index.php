<?php
  include "insert.php";
  include "getData.php";
  
  $initialJson = json_decode(file_get_contents("data-1.json"));
  foreach ($initialJson as $element) {
    $ciudades[] = $element->Ciudad;
    $tipos[] = $element->Tipo;
  };
  $ciudades = array_unique($ciudades);
  $tipos = array_unique($tipos);
?>

<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <link href="http://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
  <link type="text/css" rel="stylesheet" href="css/materialize.min.css"  media="screen,projection"/>
  <link type="text/css" rel="stylesheet" href="css/customColors.css"  media="screen,projection"/>
  <link type="text/css" rel="stylesheet" href="css/ion.rangeSlider.css"  media="screen,projection"/>
  <link type="text/css" rel="stylesheet" href="css/ion.rangeSlider.skinFlat.css"  media="screen,projection"/>
  <link type="text/css" rel="stylesheet" href="css/index.css"  media="screen,projection"/>
  <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Formulario</title>
</head>

<body>
  <div class="contenedor">
    <div class="card rowTitulo">
      <h1>Bienes Intelcost</h1>
    </div>
    <div class="colFiltros">
      <form action="#" method="post" id="formulario">
        <div class="filtrosContenido">
          <div class="tituloFiltros">
            <h5>Filtros</h5>
          </div>
          <div class="filtroCiudad input-field">
            <p><label for="selectCiudad">Ciudad:</label><br></p>
            <select name="ciudad" id="selectCiudad">
              <option value="" selected>Elige una ciudad</option>
              <?php
                foreach( $ciudades as $ciudad) 
                echo "<option value=\"$ciudad\">$ciudad</option>";
              ?>
            </select>
          </div>
          <div class="filtroTipo input-field">
            <p><label for="selecTipo">Tipo:</label></p>
            <br>
            <select name="tipo" id="selectTipo">
              <option value="">Elige un tipo</option>
              <?php
                foreach( $tipos as $tipo) 
                echo "<option value=\"$tipo\">$tipo</option>";
              ?>
            </select>
          </div>
          <div class="filtroPrecio">
            <label for="rangoPrecio">Precio:</label>
            <input type="text" id="rangoPrecio" name="precio" value="" />
          </div>
          <div class="botonField">
            <input type="submit" class="btn white" value="Buscar" id="submitButton">
          </div>
        </div>
      </form>
    </div>
    <div id="tabs" style="width: 75%;">
      <ul>
        <li><a href="#tabs-1">Bienes disponibles</a></li>
        <li><a href="#tabs-2">Mis bienes</a></li>
        <li><a href="#tabs-3">Reportes</a></li>
      </ul>
      <div id="tabs-1">
        <div class="colContenido" style="width: 100%" id="divResultadosBusqueda">
          <div class="tituloContenido card" style="justify-content: center;">
            <h5>Resultados de la búsqueda:</h5>
            <div class="divResultados">
                <div class="resultadosBusqueda">
                  <div class="row">
                  <?php foreach($initialJson as $element):?>
                      <div class="col s6">
                        <div class="card">
                          <div class="card-image">
                            <img src="img/home.jpg">
                          </div>
                          <div class="card-content">
                            <p>Dirección: <span><?php echo $element->Direccion ?></span> </p>
                            <p>Ciudad: <span><?php echo $element->Ciudad ?></span> </p>
                            <p>Telefono: <span><?php echo $element->Telefono ?></span> </p>
                            <p>Codigo Postal: <span><?php echo $element->Codigo_Postal ?></span> </p>
                            <p>Tipo: <span><?php echo $element->Tipo ?></span> </p>
                            <p>Precio: <span><?php echo $element->Precio ?></span> </p>
                            <div class="center-align">
                              <a onclick="agregarMisBienes('<?php echo $element->Id ?>')" type="submit" class="agregarMisBienes waves-effect waves-light btn" id='<?php echo $element->Id?>' name="Submit">Guardar</a>
                            </div>
                          </div>
                        </div>
                      </div>
                  <?php endforeach; ?>
                  </div>
                </div>
              </div>
            <div class="divider"></div>
          </div>
        </div>
      </div>
      
      <div id="tabs-2" >
        <div class="colContenido" style="width: 100%" id="divResultadosBusqueda">
          <div class="tituloContenido card" style="justify-content: center;">
            <h5>Bienes guardados:</h5>
              <div class="divBienesGuardados">
                <div class="bienesGuardados">
                  <div class="row">
                  </div>
                </div>
              </div>
            <div class="divider"></div>
          </div>
        </div>
      </div>

      <div id="tabs-3" >
        <div class="colContenido" style="width: 100%" id="divResultadosBusqueda">
          <div class="tituloContenido card" style="justify-content: center;">
            <h5>Exportar Reporte:</h5>
            <h1>Filtros</h1>
              <div class="filtroCiudad input-field">
                <p><label for="selectCiudad">Ciudad:</label><br></p>
                <select name="ciudad" id="select-ciudad-export">
                  <option value="" selected>Elige una ciudad</option>
                  <?php
                    foreach( $ciudades as $ciudad) 
                    echo "<option value=\"$ciudad\">$ciudad</option>";
                  ?>
                </select>
              </div>
              <div class="filtroTipo input-field">
                <p><label for="selecTipo">Tipo:</label></p>
                <br>
                <select name="tipo" id="select-tipo-export">
                  <option value="">Elige un tipo</option>
                  <?php
                    foreach( $tipos as $tipo) 
                    echo "<option value=\"$tipo\">$tipo</option>";
                  ?>
                </select>
              </div>
                <input value="Exportar" type="submit" class="export waves-effect waves-light btn" id='excel' name="Exportar">
            </div>
          </div>
        </div>
      </div>

    <script src="https://code.jquery.com/jquery-1.12.4.js"></script>

    <script type="text/javascript" src="js/ion.rangeSlider.min.js"></script>
    <script type="text/javascript" src="js/materialize.min.js"></script>
    <script type="text/javascript" src="js/index.js"></script>
    <script type="text/javascript" src="js/buscador.js"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
    <script type="text/javascript">
      var resultadosOriginales = <?php echo json_encode($initialJson); ?>;
      $( document ).ready(function() {

          $( "#tabs" ).tabs();

          //Manejo de la accion, buscar
          $( "#submitButton" ).click(function(e) {
            e.preventDefault();
            document.getElementById('ui-id-1').click();
            $('ul.tabs').tabs('select_tab', 'ui-id-1')
            //Se toma el array original y se filtra
            var resultadosFiltrados = resultadosOriginales.filter(filterFunction);
            $( ".resultadosBusqueda" ).remove();

            //Validación de resultados y carga condicional de componentes
            if (resultadosFiltrados.length != 0) {
              var newDiv = $('<div class="resultadosBusqueda"><div class="row newrow"></div></div>');
              $('.divResultados').append(newDiv);

              resultadosFiltrados.forEach(function(resultado) {
                var newDiv = generarCard(resultado, 'agregarMisBienes', 'Guardar');
                $( ".newrow" ).append(newDiv);
              });
            } else {
              var newDiv = $('<div class="resultadosBusqueda"></div>');
              $('.divResultados').append(newDiv);

              var newDiv = $('<p>No se encontraron coincidencias</p>');
              $( ".resultadosBusqueda" ).append(newDiv);
            };
          });

          //Manejo de la accion que permite obtener misBienes 
          $( "#ui-id-2" ).click(function(e) {
            $.ajax({
              type: "POST",
              url: "getData.php",
              data: {Get: true},
              success: function(data) {
                if (data) {
                  $misBienes = JSON.parse(data);
                } else {
                  $misBienes = [];
                }
                
                $( ".bienesGuardados" ).remove();

                if ($misBienes.length !=0) {
                  var newDiv = $('<div class="bienesGuardados"><div class="row newrow"></div></div>');
                  $('.divBienesGuardados').append(newDiv);
                  $misBienes.forEach(function(resultado) {
                    var newDiv = generarCard(resultado, 'eliminar', 'Eliminar');
                    $( ".newrow" ).append(newDiv);
                  });
                } else {
                  var newDiv = $('<div class="bienesGuardados"></div>');
                  $('.divBienesGuardados').append(newDiv);
                  var newDiv = $('<p>Aún no tienes bienes guardados</p>');
                  $( ".bienesGuardados" ).append(newDiv);
                };

              }
            });
          });

          //Manejo de la accion que permite exportar la información en excel
          $('.export').click(function(e) {

            $ciudad_export = $('#select-ciudad-export').val() == '' ? '-' : $('#select-ciudad-export').val();
            $ciudad_export = $ciudad_export.replace(/\s/g, '-');
            $tipo_export = $('#select-tipo-export').val() == '' ? '-' : $('#select-tipo-export').val();
            $tipo_export = $tipo_export.replace(/\s/g, '-');
            $url = 'excel.php' + '?' + $ciudad_export + '?' + $tipo_export;
            window.open($url, '_blank');
          });
      });
    </script>
  </body>
  </html>
