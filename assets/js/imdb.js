/**
 * when home is ready, we must 
 */
$(document).ready(function() {
    // Hacer una solicitud GET a la ruta /all de tu servidor Flask cuando la página se cargue
    var id_imdb = $('#id_imdb');
    var datos = {
        'id_imdb' : id_imdb.val()
    }
   

    $.ajax({
        url: 'http://localhost:5000/buscar',
        type: "POST",
        //contentType: 'application/json',
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
