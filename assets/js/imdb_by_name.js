/**
 * Método para buscar películas a través de un buscador
 * obtenemos el value del input buscador a través de su id y se lo pasamos a la API
 */
$(document).ready(function ($) {
    var buscador = $('#q').val();
    if(buscador.length < 1){
        
        var datos = {
            "buscador" : buscador
        }
        $.ajax({
            url: 'http://localhost:5000/buscar_by_name',
            type: 'POST',
            data: datos,
            success: function(response) {
                console.log(response);
            },
            error: function(xhr, status, error) {
                
                console.log('Error al hacer la solicitud:', error);
            }
        });
    }else{
        alert("Introduce más caracteres");
    }
})