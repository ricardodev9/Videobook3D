/**
 * when home is ready, we must 
 */
$(document).ready(function() {
    // Hacer una solicitud GET a la ruta /all de tu servidor Flask cuando la página se cargue
    var box_elementos = $('[id="id_imdb"]');
    var array_ids = Array()
    box_elementos.each(function(){
        var imdb = $(this).val();
        array_ids.push(imdb)
    })

    
    var datos = {
        'ids_imdb' : array_ids
    }
    console.log(datos);
    $.ajax({
        url: 'http://localhost:5000/',
        type: "POST",
        contentType: 'application/json',
        data : datos,
        success: function(response) {
            console.log(response);
            // // Manejar los datos recibidos
            // if (data) {
            //     var movieListDiv = $('#movieList');
            //     $.each(data, function(index, movie) {
            //         var movieInfo = `
            //             <div>
            //                 <p>Título: ${movie.title}</p>
            //                 <p>Año: ${movie.year}</p>
            //                 <p>Tipo: ${movie.kind}</p>
            //             </div>
            //         `;
            //         movieListDiv.append(movieInfo);
            //     });
            // } else {
            //     console.error('Error: No se recibieron datos de las películas.');
            // }
        },
        error: function(xhr, status, error) {
            console.error('Error al hacer la solicitud:', error);
        }
    });
});
