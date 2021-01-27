/*
  Función que permite filtrar el arreglo de 
  resultados dependiendo de los dos campos seleccionados
*/

function filterFunction(resultado) {
    var ciudad =$( "#selectCiudad" ).val();
    var tipo =$( "#selectTipo" ).val();

    if (ciudad.length == 0 && tipo.length == 0) {
      return resultado != '';
    } else if (ciudad.length == 0 && tipo.length != 0) {
      return resultado.Tipo == tipo;
    } else if (ciudad.length != 0 && tipo.length == 0) {
      return resultado.Ciudad == ciudad;
    } else {
      return (
        resultado.Ciudad == ciudad 
        && resultado.Tipo == tipo
      );
    };
  }

