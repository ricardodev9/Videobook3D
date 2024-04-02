<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>VideoBook3D</title>
    <link rel="stylesheet" href="assets/css/styles.css">
        <!-- tailwind -->
    <script src="https://cdn.tailwindcss.com"></script>

    <!-- jquery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <!-- js del home -->
    <script src="assets/js/home.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
</head>
<body>
    
    <div id="homeContent">
   
	<header class="headerContent">
		<nav class="navContent">
			<ul class="flex items-center">
				<li>
                <!-- BUSCADOR -->                    

                    <div class="flex items-center">
                        <input type="text" id="voice-search" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 ps-7 p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Película,serie o libro" />
                        <button type="submit" class="inline-flex items-center py-1.5 px-2 ms-2 text-sm font-medium text-white bg-blue-700 rounded-lg border border-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                            <svg class="w-4 h-4 me-2" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z" />
                            </svg>Buscar
                        </button>
                    </div>



                </li>
                <li>


                <div class="select_nav" >
                <label for="select_elemento">Categoría</label>&nbsp;&nbsp;
                    <select id="select_elemento" class="btn btn-secondary dropdown-toggle">
                       
                        <option value="" selected>Ninguno</option>
                        <option value="pelicula">Película</option>
                        <option value="serie">Serie</option>
                        <option value="libro">Libro</option>
                    </select>
                </div>



                </li>


                <li>
                <div class="select_nav">
                <label for="select_orden">Ordenar</label>&nbsp;&nbsp;
                    <select id="select_orden" class="btn btn-secondary dropdown-toggle">       
                        <option value="" selected>Ninguno</option>
                        <option value="rating">Rating</option>
                        <option value="duracion">Duración</option>
                            
                        </select>
                    </div>
                </li>

                <!-- I am going to create a new dropdown with genres info -->
                <li>
                <div class="select_nav">

                <label for="select_genero">Género</label>&nbsp;&nbsp;
                    <select id="select_orden" class="btn btn-secondary dropdown-toggle">       
                        <option value="" selected>Ninguno</option>

                    </select>
                </div>

                </li>

                <li>
                <div class="select_nav">
                    <span id="eliminar_filtro"> X </span>
                </div>
                </li>
                <li>
                    <img src="assets/img/perfil2.png" alt="perfil">
                </li>
                
			</ul>
		</nav>
	</header>

	<section>
        
		<article>
			<header>
				<h2>Article title</h2>
				<p>Posted on <time datetime="2009-09-04T16:31:24+02:00">September 4th 2009</time> by <a href="#">Writer</a> - <a href="#comments">6 comments</a></p>
			</header>
			<p>Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas.</p>
		</article>
		
		<article>
			<header>
				<h2>Article title</h2>
				<p>Posted on <time datetime="2009-09-04T16:31:24+02:00">September 4th 2009</time> by <a href="#">Writer</a> - <a href="#comments">6 comments</a></p>
			</header>
			<p>Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas.</p>
		</article>
		
	</section>

    
    <aside>
		<h2>About section</h2>
		<p>Donec eu libero sit amet quam egestas semper. Aenean ultricies mi vitae est. Mauris placerat eleifend leo.</p>
	</aside>

	<footer>
		<p>Copyright 2009 Your name</p>
	</footer>

    </div>
</body>
</html>