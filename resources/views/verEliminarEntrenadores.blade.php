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
                    .ventanaModal {
                        overflow: hidden;
                    }

                </style>
        
                <x-usuarios>

                </x-usuarios>
            
            </section>
        
            <x-menu>

            </x-menu>
        </header>

        <section class="entrenadores">
            <section class="entrenadores_partes">
                <h2>ENTRENADORES</h2>
                <section class="entrenadores_solo">
                    @if ($entrenadores->isEmpty())
                        <div class="text-center" style="font-weight: bold; color: white; background:#163b3d80; padding: 2%; border-radius: 15px; width: 50vw; max-width: 400px; margin: 0 auto;"> 
                            No hay ningún entrenador registrado.
                        </div>
                    @else
                        @foreach($entrenadores->chunk(3) as $chunk) 
                            <div class="row">
                                @foreach($chunk as $key => $entrenador)
                                    <section class="entrenador @if ($key == 2) mat-below-left @endif">
                                        <section class="todo">
                                            <img src="{{ asset('imagenes/' . $entrenador->imagen) }}" width="220/2" height="290/2" title="{{ $entrenador->imagen }}"  style="border-radius: 20px;">
                                            <h4>{{ $entrenador->nombre }} {{ $entrenador->primer_apellido }}</h4> 
                                        </section>
                                        <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#confirmacionEliminarModal{{ $entrenador->id }}">Eliminar</button>
        
                                        <!-- modal -->
                                        <div style="overflow: hidden;" class="modal fade" id="confirmacionEliminarModal{{ $entrenador->id }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="exampleModalLabel">Confirmar Eliminación</h5>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <p>¿Estás seguro de que deseas eliminar este entrenador?</p>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                                                        <form action="{{ route('eliminar-entrenador', $entrenador->id) }}" method="POST">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="submit" class="btn btn-danger">Eliminar</button>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>                                    
                                    </section>
                                @endforeach
                            </div>
                        @endforeach
                    @endif
                </section> 
            </section>
        </section>
        

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
