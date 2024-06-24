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
        
    <body >
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
                    .entrenadores_solo {
                        overflow-x: hidden; 
                    }
                    </style>
        
                <x-usuarios>

                </x-usuarios>
            
            </section>
        
            <x-menu>

            </x-menu>
        </header>
        <style>
            .editar {
                transition: transform 0.5s ease;
            }

            .editar:hover {
                transform: scale(1.12);
            }

            body {
                overflow-y: scroll !important;
                width: 100% !important;
            }


        </style>  


            <section class="entrenadores">
                <section class="entrenadores_partes">
                    <h2>EDITAR NOTICIAS </h2>
                    <section class="entrenadores_solo">
                        @foreach($noticias as $noticia)
                        <div class="row align-items-center" style="width:80%">
                            <div class="col-md-12">
                                <div class="entrenador d-flex align-items-center" style="background: #163b3d80; border-radius: 15px; margin: 10px 0; padding: 10px;">
                                    <div class="image-container" style="width: 120px; height: 120px; overflow: hidden; border-radius: 20px; margin-left: 40px;">
                                        <img src="{{ asset('imagenes/' . $noticia->imagen) }}" style="width: 100%; height: 100%; object-fit: cover;" title="{{ $noticia->titulo }}" alt="{{ $noticia->titulo }}">
                                    </div>
                                    <a class="editar" href="{{ route('editarNoticias', ['id'=> $noticia->id]) }}" class="ms-3 mb-0" style="color: white; flex-grow: 1; text-decoration: none; font-size: 2vw;">{{ $noticia->titulo }} <span class="material-symbols-outlined">
                                        edit
                                        </span></a>
                                    <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#confirmacionEliminarModal{{ $noticia->id }}" style="margin-right: 40px;">Eliminar</button>
                                </div>
                            </div>
                        </div>
                        
            
                        <!-- Modal -->
                        <div  class="modal fade" id="confirmacionEliminarModal{{ $noticia->id }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">Confirmar Eliminación</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <p>¿Estás seguro de que deseas eliminar esta noticia?</p>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                                        <form action="{{route('eliminarNoticia', $noticia->id)}}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger">Eliminar</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </section>
                </section>
            </section>
            
            
            
            
            
            
    @if(session('exito'))
        <script>
            window.onload = function() {
                alert("{{ session('exito') }}");
            }
        </script>
    @endif

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
            
        
          
    <x-footer>

    </x-footer>
    </body>
</html>
