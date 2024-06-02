/**
 * when home is ready, we must 
 */
$(document).ready(function($) {
    // Hacer una solicitud GET a la ruta /all de tu servidor Flask cuando la página se cargue
    var id_imdb = $('#id_imdb');
    var datos = {
        'id_imdb' : id_imdb.val()
    }
    $('.container .loading_gif').show();
   
    $.ajax({
        url: 'http://localhost:5000/buscar',
        type: 'POST',
        data: datos,
        success: function(response) {
            
            displayMovieInfo(response,$);
        },
        error: function(xhr, status, error) {
            $('.container .loading_gif').hide();
            console.error('Error al hacer la solicitud:', error);
        }
    });
});

function displayMovieInfo(data,$){
    $('.container .loading_gif').hide();
    console.log(data);
    var movieInfoDiv = $('.container #div_rating_stars');

    var cast = data.cast.map(c => `<li>${c.name}</li>`).join('');
    var genres = data.genres.map(g => g).join('/');
    var producers = data.producers.map(p => p.name).join(',\n');
    var companies = data.companies.map(c => `<li>${c.name}</li>`).join('');
    $('.container #generos').html(genres);
    movieInfoDiv.html(`
        <h3>Rating: ${data.rating ? data.rating.rating : 'N/A'}</h3>
    `);
    var div_producers = $('.container #div_producers');
    div_producers.html(
        `
        <h3>Productores: ${producers}</h3>
        `
    )
}
