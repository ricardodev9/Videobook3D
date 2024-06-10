/**
 * Cuando se carga la página de mostrar la info por id_imdb se hará la llamada a la API
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
/**
 * Métodos para crear elementos 
 *  
 */
function createStarElement(isFilled) {
    const star = document.createElement('span');
    star.classList.add('star');
    star.innerHTML = '&#9733;'; // Star character
    star.style.color = isFilled ? 'gold' : 'gray';
    return star;
}
function createProducerElement(producer){
    const p = document.createElement('p');
    p.classList.add('mb-3', 'text-gray-500', 'dark-text-gray-400');
    p.innerHTML = producer;
    return p;
}

function CreateCompaniesElement(companies){
    const company = document.createElement('ul')
    //<p class="mb-3 text-gray-500 dark:text-gray-40">
    
    //<ul class="flex flex-wrap items-center justify-center text-gray-900 dark:text-white">
    company.classList.add('flex','flex-wrap','items-center','justify-center','text-gray-900','dark:text-white')
    company.id="ul_company";
    // <li>
    //     <a href="#" class="me-4 hover:underline md:me-6 ">About</a>
    // </li>
    companies.forEach((company_name)=>{
        const li = document.createElement('li');
        li.classList.add("me-4","hover:underline","md:me-6");
        li.innerHTML = company_name;
        
        company.appendChild(li);
    });
   
    return company;
}
//max-w-md space-y-1 text-gray-500 list-disc list-inside dark:text-gray-400
function createCastElement(casting){
    const cast = document.createElement('ul')
    //<p class="mb-3 text-gray-500 dark:text-gray-40">
    
    //<ul class="flex flex-wrap items-center justify-center text-gray-900 dark:text-white">
    cast.classList.add('ps-5','mt-2','space-y-1','list-disc','list-inside');
    cast.id="ul_cast";
    // <li>
    //     <a href="#" class="me-4 hover:underline md:me-6 ">About</a>
    // </li>
    casting.forEach((cast_name)=>{
        const li = document.createElement('li');
        li.innerHTML = cast_name;
        
        cast.appendChild(li);
        
    });
    console.log(casting);
    return cast;
}
/**
 * Fin métodos para crear elementos 
 *  
 */
//método para crear el div para lás compaías
function displayMovieInfo(data,$){
    $('.container .loading_gif').hide();
    console.log(data);
    const div_rating = $('.container #div_rating_stars #p_rating');
    const div_producers = $('.container #div_producers #p_producer');
    const div_comany = $('.container .company #div_company ');
    const div_casting = $('.container .casting #div_casting');
    var cast = data.cast.map(c => c.name);
    var genres = data.genres.map(g => g).join('/');
    var producers = data.producers.map(p => p.name).join(',\n');
    var companies = data.companies.map(c => c.name);
    
    $('.container #generos').html(genres);
//    <span class="star">&#9733;</span><span class="star">&#9733;</span><span class="star">&#9733;</span><span class="star">&#9733;</span><span class="star" style="color: gray;">&#9733;</span>
    var rank_int = parseInt(data.rating.rating/2);
    for (let i = 0; i < 5; i++) {
        const isFilled = i < rank_int;
        const star = createStarElement(isFilled);
        div_rating.append( star);
    }

    const producerElement = createProducerElement(producers);
    
    div_producers.append(
        producerElement
    )
    const companyElement = CreateCompaniesElement(companies);
    div_comany.append(
        companyElement
    )
    const castElement = createCastElement(cast);
    div_casting.append(
        castElement
    )
}

