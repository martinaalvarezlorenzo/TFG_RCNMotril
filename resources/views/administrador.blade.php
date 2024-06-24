<!doctype html>
    <html lang="es">

    <head>
        <title>Real Club Náutico de Motril - Página principal</title>
        <meta charset="UTF-8">
        <link rel="stylesheet" type="text/css" href="{{ asset('css/administradores.css') }}">
        <meta name=”viewport” content=”width=device-width, initial-scale=1.0”>
        <link rel="icon" type="image/png" href="{{ asset('imagenes/motril.jpeg') }}">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
        <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,0,0" />

    </head>
        
    <body>
        <header>
            <section class="cabecera">
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
        <h2>FUNCIONES ADMINISTRADOR</h2>
        <div class="contenedor">
            <div class="section">
                <div class="content">
                    <h3>NOTICIAS</h3>
                    <div class="botonesAdmin">
                        <div class="funcionesAdmin">
                            <a href="{{route('altaNoticia')}}" class="botones btn btn-light">Añadir Noticia</a>
                            <a href="{{route('eliminarNoticias')}}" class="botones btn btn-light">Eliminar/Editar noticia</a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="section">
                <div class="content">
                    <h3>MATERIALES</h3>
                    <div class="botonesAdmin">
                        <div class="funcionesAdmin">
                            <a href="{{route('altaMaterial')}}" class="botones btn btn-light">Añadir material</a>
                            <a href="{{route('verEliminarMateriales')}}" class="botones btn btn-light">Eliminar/Editar material</a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="section">
                <div class="content">
                    <h3>ENTRENADORES</h3>
                    <div class="botonesAdmin">
                        <div class="funcionesAdmin">
                            <a href="{{route('altaEntrenador')}}" class="botones btn btn-light">Añadir Entrenador</a>
                            <a href="{{route('verEliminarEntrenadores')}}" class="botones btn btn-light">Eliminar Entrenador</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <style>
        .botones {
            display: inline-block;
            padding: 10px 20px;
            color: black;
            text-decoration: none;
            border: none;
            border-radius: 15px;
            cursor: pointer;
            font-family: Arial, sans-serif;
            font-size: 16px;
            text-align: center;
            margin: 0 5px;
            margin-top: 10px;
            white-space: nowrap;
            min-width: 150px;
        }

        .botones:hover {
            background-color: #1e8a4d;
            color: white;
        }
        </style>
        
    <x-footer>

    </x-footer>
    @if(session('success'))
        <script>
            window.onload = function() {
                alert("{{ session('success') }}");
            }
        </script>
    @endif


    </body>
</html>
