/*
  Creación de una función personalizada para jQuery que detecta cuando se detiene el scroll en la página
*/
$.fn.scrollEnd = function(callback, timeout) {
  $(this).scroll(function(){
    var $this = $(this);
    if ($this.data('scrollTimeout')) {
      clearTimeout($this.data('scrollTimeout'));
    }
    $this.data('scrollTimeout', setTimeout(callback,timeout));
  });
};

/*
  Función que inicializa el elemento Slider
*/

function inicializarSlider(){
  $("#rangoPrecio").ionRangeSlider({
    type: "double",
    grid: false,
    min: 0,
    max: 100000,
    from: 200,
    to: 80000,
    prefix: "$"
  });
}

  /*
    Función que generar una card para un resultado
  */
function generarCard(resultado, funcion, texto){
  return $(
          '<div class="col s6">' + 
            '<div class="card">' + 
              '<div class="card-image">' +
                '<img src="img/home.jpg">' + 
              '</div>' + 
              '<div class="card-content">' +
                '<p>Dirección: <span>' + resultado.Direccion + '</span> </p>' +
                '<p>Ciudad: <span>'+ resultado.Ciudad +'</span> </p>' +
                '<p>Telefono: <span>'+ resultado.Telefono +'</span> </p>' +
                '<p>Codigo Postal: <span>' + resultado.Codigo_Postal + '</span> </p>' +
                '<p>Tipo: <span>' + resultado.Tipo + '</span> </p>' +
                '<p>Precio: <span>' + resultado.Precio + '</span> </p>' +
                '<div class="center-align">' +
                  '<a onclick="' + funcion + '(' + resultado.Id + ');" type="submit" class="cardGenerated waves-effect waves-light btn" name="Submit">' + texto + '</a>' +
                '</div>' + 
              '</div>' +
            '</div>' + 
          '</div>'
        );
}


/*
  Función que inicializa el ajax para ejecutar la transacción
*/

function agregarMisBienes(id) {
  var resultadosFiltrados = resultadosOriginales.filter(filterFunction);
  if(resultadosFiltrados.length == 0){
    element = resultadosOriginales[id-1]
  } else {
    element = findId(resultadosFiltrados, id)
  }
  $.ajax({
      type: "POST",
      url: "insert.php",
      data: { Submit: true, value: element }
    }).done(function( msg ) {
      alert( msg );
  });
};

/*
  Función que permite obtener un objeto del arreglo por su ID
*/
function findId(data, id) {
  for (var i = 0; i < data.length; i++) {
      if (data[i].Id == id) {
          return(data[i]);
      }
  }
};

/*
  Función que permite Iniciar la transaccion para eliminar un elemento dada su ID
*/
function eliminar(id) {
  $.ajax({
    type: "POST",
    url: "delete.php",
    data: { Delete: true, value: id }
  }).done(function( msg ) {
    alert( msg );
    document.getElementById('ui-id-2').click();
  });
};

