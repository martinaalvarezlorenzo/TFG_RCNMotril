<!doctype html>
    <html lang="es">

    <head>
        <title>Real Club Náutico de Motril - Página principal</title>
        <meta charset="UTF-8">
        <link rel="stylesheet" type="text/css" href="{{ asset('css/index.css') }}">
        <meta name=”viewport” content=”width=device-width, initial-scale=1.0”>
        <link rel="icon" type="image/png" href="{{ asset('imagenes/motril.jpeg') }}">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
        <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,0,0" />

    </head>
        
    <body>
        <header>
            <section class="cabecera" >
                <section class="logo">
                        <img src="{{ asset('imagenes/motril.jpeg') }}" />
                </section>
        
                <section class="nombreClub">
                    <h1> Real Club Náutico de Motril</h1>
                </section>
                <style>
                    body{
                        background-image: url("{{asset('imagenes/piscina.jpg')}}");
                    }
                    </style>
        
                   <x-usuarios>

                   </x-usuarios>
            
            </section>
        
            <x-menu>

            </x-menu>
        </header>
        <div class="imgInstalaciones">
            <div class="juntosInstalaciones">
                <div class="cardI">
                    <div class="image-box">
                        <img src="imagenes/instalacion5.jpeg" width="480" height="480">
                    </div>
                    <div class="content">
                        <h2>PISCINA DESCUBIERTA DE 50 METROS</h2>
                        <p>El Real Club Naútico de Motril cuenta con una piscina municipal descubierta de 50 metros que es utilizada en los meses de verano para preparar los campeonatos</p>
                    </div>
                </div>
                <div class="cardI">
                    <div class="image-box">
                        <img src="imagenes/piscinaM1.jpeg" width="480" height="480">
                    </div>
                    <div class="content">
                        <h2>PISCINA MUNICIPAL</h2>
                        <p>El Real Club Naútico de Motril cuenta con una piscina municipal que se encuentra en el centro de Motril </p>
                    </div>
                </div>
                <div class="cardI">
                    <div class="image-box">
                        <img src="imagenes/puerto.jpg" width="480" height="480">
                    </div>
                    <div class="content">
                        <h2>PISCINA PUERTO DE MOTRIL</h2>
                        <p>El Real Club Naútico de Motril tiene una piscina que se encuentra en las instalaciones del puerto de Motril, es utilizada para entrenamientos y para cursos de natación en verano<p>
                    </div>
                </div>
            </div>
            <div class="juntosInstalaciones">
                <div class="cardI">
                    <div class="image-box">
                        <img src="imagenes/instalacion4.jpg" width="480" height="480">
                    </div>
                    <div class="content">
                        <h2>GIMNASIO DEL CLUB</h2>
                        <p>En el puerto de Motril se dispone de un gimnasio para completar las sesiones de entrenamiento</p>
                    </div>
                </div>
                <div class="cardI">
                    <div class="image-box">
                        <img src="imagenes/instalacion8.jpg" width="480" height="480">
                    </div>
                    <div class="content">
                        <h2>VESTUARIOS</h2>
                        <p>Tanto en la piscina municipal como en el puerto el club dispone de vestuarios</p>
                    </div>
                </div>
                <div class="cardI">
                    <div class="image-box">
                        <img src="imagenes/barPuerto.jpg" width="480" height="480">
                    </div>
                    <div class="content">
                        <h2>CLUB NAÚTICO DE MOTRIL</h2>
                        <p>El Club Naútico cuenta con un bar para los socios en el puerto de motril además de tener un espacio para barcos y velas</p>
                    </div>
                </div>
            </div>
        </div><br>

        <div class="contenedor-centrado">
            @if ($noticias->isEmpty())
                <div class="text-center" style="font-weight: bold; color: white; background:#163b3d80; padding: 2%; border-radius: 15px; width: 50vw; max-width: 400px; margin: 0 auto;"> 
                    No hay noticias disponibles.
                </div>
            @else
                @foreach($noticias as $noticia)
                    <div class="card noticia" style="width: 300px; margin: 0 auto;">
                        <div class="card-img-container" style="height: 200px;"> 
                            <img src="{{ asset('imagenes/' . $noticia->imagen) }}" class="card-img-top" alt="" style="width: 100%; height: 100%; object-fit: cover;">
                        </div>
                        <div class="card-body">
                            <h5 class="card-title">{{ $noticia->titulo }}</h5>
                            <p class="card-text">{{ $noticia->texto }}</p>
                        </div>
                    </div>
                @endforeach
            @endif
        </div><br>
        
        <div class="botones">
            <button type="button" id="ant" class="btn btn-success">Anterior</button>
            <button type="button" id="sig" class="btn btn-success">Siguiente</button>
        </div>
        
        
        <script>
            document.addEventListener("DOMContentLoaded", function() {
                const noticias = document.querySelectorAll('.noticia');
                let indiceActual = 0; 
        
                // Función para mostrar la noticia 
                function mostrarNoticia(indice) {
                    // Ocultar todas las noticias
                    noticias.forEach(noticia => {
                        noticia.style.display = 'none';
                    });
                    noticias[indice].style.display = 'block';
                }
        
                mostrarNoticia(indiceActual);
        
                // Botón siguiente
                document.getElementById('sig').addEventListener('click', function() {
                    indiceActual++; 
                    if (indiceActual >= noticias.length) {
                        indiceActual = 0; 
                    }
                    mostrarNoticia(indiceActual);
                });
        
                // Botón anterior
                document.getElementById('ant').addEventListener('click', function() {
                    indiceActual--;
                    if (indiceActual < 0) {
                        indiceActual = noticias.length - 1; 
                    }
                    mostrarNoticia(indiceActual);
                });
            });
        </script>
        
          
    <x-footer>

    </x-footer>

    @if(session('success'))
        <script>
            window.onload = function() {
                alert("{{ session('success') }}");
            }
        </script>
    @endif

    @if(session('successNoticia'))
        <script>
            window.onload = function() {
                alert("{{ session('successNoticia') }}");
            }
        </script>
    @endif




    </body>
</html>
