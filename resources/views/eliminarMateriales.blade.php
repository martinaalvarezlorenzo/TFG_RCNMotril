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
        <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
    </head>
        
    <body class="ventanaModal">
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
        <style>
            .editar {
                transition: transform 0.5s ease;
            }

            .editar:hover {
                transform: scale(1.12);
            }
            .ventanaModal {
                overflow: hidden;
            }


        </style>

            <section class="entrenadores">
                <section class="entrenadores_partes">
                    <h2>EDITAR MATERIALES</h2>
                    <section class="entrenadores_solo">
                        @foreach($materiales as $material)
                        <div class="row align-items-center" style="width:80%">
                            <div class="col-md-12">
                                <div class="entrenador d-flex align-items-center" style="background: #163b3d80; border-radius: 15px; margin: 10px 0; padding: 10px;">
                                    <div class="image-container" style="max-width: 120px; max-height: 120px; overflow: hidden; border-radius: 20px; margin-left: 40px;">
                                        <img src="{{ asset('imagenes/' . $material->imagen) }}" style="width: 100%; height: 100%; object-fit: cover;" title="{{ $material->nombre }}" alt="{{ $material->nombre }}">
                                    </div>
                                        <a class="editar" href="{{ route('editarMateriales', ['id'=> $material->id]) }}" class="ms-3 mb-0" style="color: white; flex-grow: 1; text-decoration: none; font-size: 2vw; margin-left: 40px; margin-right: 40px;">{{ $material->nombre }} <span class="material-symbols-outlined">
                                            edit
                                            </span></a>
                                    <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#confirmacionEliminarModal{{ $material->id }}" style="margin-right: 40px;">Eliminar</button>
                                </div>
                            </div>
                            
                        </div>
            
                        <!-- Modal -->
                        <div class="modal fade" id="confirmacionEliminarModal{{ $material->id }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">Confirmar Eliminación</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <p>¿Estás seguro de que deseas eliminar este material?</p>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                                        <form action="{{ route('eliminarMaterial', ['id' => $material->id]) }}" method="POST">     
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

    @if(session('successMaterial'))
        <script>
            window.onload = function() {
                alert("{{ session('successMaterial') }}");
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
            
        
          
    <x-footer>

    </x-footer>
    </body>
</html>
