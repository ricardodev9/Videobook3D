/**
 * Método para buscar películas a través de un buscador
 * obtenemos el value del input buscador a través de su id y se lo pasamos a la API
 */

function buscarElementoByNombre(){
    var q = $('#q').val();
    var div_padre = $('#div_padre');
   
    //console.log(q);
    if(q.length > 1){
        div_padre.html("Buscando en filmoteca:  <b>" + q + "</b>");
        var datos = {
            "buscador" : q
        }

        $.ajax({
            url: 'http://localhost:5000/buscar_by_name',
            type: 'POST',
            data: datos,
            success: function(response) {
                div_padre.html("");
                displayElementInfo(response);
                /*
                    <input type="hidden" id="id_imdb" value="<?=$elemento->getId_imdb()?>">
                    <div class="cellphone-container" id="cardbox_<?=$elemento->getId_imdb()?>">
                        <div class="movie-img">
                            <img src="<?=$elemento->getImg_url()?>" class="img_portada" alt="portada elemento" style="border-top-left-radius:5px; border-top-right-radius : 5px">
                        </div>
                        <div class="movie-details">
                            <h2><?=$elemento->getTitulo()?></h2>
                            
                            <p class="desc"><?=$elemento->getDescripcionFormatted($elemento->getDescripcion())?></p><br>
                            <!-- <p class="director" id="director_<?//=$elemento->getId_imdb()?>"></p>
                            <p class="casting" id="casting_<?//=$elemento->getId_imdb()?>"></p> -->
                            <p class="tipo" id="tipo_<?=$elemento->getId_imdb()?>"><i class="fa-solid fa-tag" ></i>&nbsp&nbsp <?=$elemento->getTipo()?></p>
                            <p class="anho" id="anho_<?=$elemento->getId_imdb()?>"><i class="fa-solid fa-calendar-days"></i>&nbsp&nbsp<?=$elemento->getAnho()?></p>
                            <p class="duracion" id="duracion_<?=$elemento->getId_imdb()?>"><i class="fa-solid fa-clock"></i>&nbsp&nbsp<?=$elemento->getDuracion()?></p>
                            <br>
                            <form action="?id_imdb=<?=$elemento->getId_imdb()?>" method = "POST">   
                                <input type="hidden" name="id_imdb" value="<?=$elemento->getId_imdb()?>"/>
                                <input type="hidden" name="imagen" value="<?=$elemento->getImg_url()?>" />
                                <input type="hidden" name="titulo" value="<?=$elemento->getTitulo()?>"/>
                                <input type="hidden" name="desc" value="<?=$elemento->getDescripcion()?>"/>
                                <input type="hidden" name="anho" value="<?=$elemento->getAnho()?>"/>
                                <input type="hidden" name="duracion" value="<?=$elemento->getDuracion()?>"/>
                                <button class="btn_action" id="btn_info" >Ver más</button>
                            </form>
                        </div>
                    <!-- <div class="action-btn">
                            <a href="#" class="watch-btn">Watch Now</a>
                        </div> -->
                </div>
                 */
            },
            error: function(xhr, status, error) {
                console.log('Error al hacer la solicitud:', error);
            }
        });

    }else{
        alert("Introduce más caracteres");
    }
}

function displayElementInfo(data){
    //var cast = data.cast.map(c => c.name);
    var elementos = data.items;
    const div_padre = $('#div_padre');
    
    if(elementos.length > 0){
        div_padre.attr({class:""});
        const list_elem = $('<ul>',{
            id: 'lista_elements',
            class : 'lista_elements'
        });
        elementos.forEach(element => {
            const li_element = $('<li>',{
                text : element.title,
                class : "pb-3 sm:pb-4 li_element"
            })
            //list_elem.append(li_element);
            list_elem.append('<div class="mb-4 space-x-4">\
            <div class="flex items-center space-x-4 rtl:space-x-reverse">\
                <div class="flex-shrink-0">\
                    <img class="w-8 h-8 rounded-full" src="' + element.img + '" alt="Neil image">\
                </div>\
                <div class="flex-1 min-w-0">\
                    <p class="text-sm font-medium text-gray-900 truncate dark:text-white">\
                        Título\
                    </p>\
                    <p class="text-sm text-gray-500 truncate dark:text-gray-400">\
                        ' + element.title + '\
                    </p>\
                </div>\
                <div class="flex-1 min-w-0">\
                    <p class="text-sm font-medium text-gray-900 truncate dark:text-white">\
                        Categoría\
                    </p>\
                    <p class="text-sm text-gray-500 truncate dark:text-gray-400">\
                        ' + element.type + '\
                    </p>\
                </div>\
                <div class="flex-1 min-w-0">\
                    <p class="text-sm font-medium text-gray-900 truncate dark:text-white">\
                        Año\
                    </p>\
                    <p class="text-sm text-gray-500 truncate dark:text-gray-400">\
                          ' + element.year + '\
                    </p>\
                </div>\
            </div>\
         </div>');

            console.log(element.title);

        });
        div_padre.append(list_elem);
    }else{
        div_padre.html("No se han encontrado resultados.");
    }
}