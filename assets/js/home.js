// $(document).ready(function() {
//     // Hacer una solicitud GET a la ruta /all de tu servidor Flask cuando la página se cargue
    
//     $.ajax({
//         url: 'http://localhost:5000/',
//         method: 'GET',
//         dataType: 'json',
//         success: function(data) {
//             // Manejar los datos recibidos
//             if (data) {
//                 var movieListDiv = $('#movieList');
//                 $.each(data, function(index, movie) {
//                     var movieInfo = `
//                         <div>
//                             <p>Título: ${movie.title}</p>
//                             <p>Año: ${movie.year}</p>
//                             <p>Tipo: ${movie.kind}</p>
//                         </div>
//                     `;
//                     movieListDiv.append(movieInfo);
//                 });
//             } else {
//                 console.error('Error: No se recibieron datos de las películas.');
//             }
//         },
//         error: function(xhr, status, error) {
//             console.error('Error al hacer la solicitud:', error);
//         }
//     });
// });
