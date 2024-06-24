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

        <section class="entrenadores">
            <section class="entrenadores_partes">
                <h2>SOLICITUDES</h2>
                <section class="entrenadores_solo">
                    @if ($solicitudes->isEmpty())
                        <p style="background: #163b3d80; color:white; padding:1.5%; border-radius: 15px; font-size:120%;">No hay solicitudes pendientes.</p>
                    @else
                        @foreach($solicitudes->chunk(3) as $chunk) 
                            <div class="row">
                                @foreach($chunk as $key => $solicitud)
                                    <section class="entrenador @if ($key == 2) mat-below-left @endif">
                                        <section class="todo">
                                            <img src="{{ asset('imagenes/' . $solicitud->imagen) }}" width="220/2" height="290/2" title="{{ $solicitud->imagen }}"  style="border-radius: 20px;">
                                            <h4>{{ $solicitud->nombre }} {{ $solicitud->primer_apellido }}</h4> 
                                        </section>
                                        <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#confirmacionAceptarModal{{ $solicitud->id }}">Aceptar</button>
                                        <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#confirmacionEliminarModal{{ $solicitud->id }}">Eliminar</button>
        
                                        <div class="modal fade" id="confirmacionEliminarModal{{ $solicitud->id }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="exampleModalLabel">Confirmar Eliminación</h5>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <p>¿Estás seguro de que deseas eliminar esta solicitud?</p>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                                                        <form action="{{ route('eliminar_solicitud', $solicitud->id) }}" method="POST">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="submit" class="btn btn-danger">Eliminar</button>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>  
        
                                        <div class="modal fade" id="confirmacionAceptarModal{{ $solicitud->id }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="exampleModalLabel">Confirmar Aceptación</h5>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <p>¿Estás seguro de que deseas aceptar la solicitud de <span style="font-weight: bold;">{{ $solicitud->nombre }} {{ $solicitud->primer_apellido }}</span>?</p>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                                                        <form action="{{ route('aceptar_solicitud', $solicitud->id) }}" method="POST">
                                                            @csrf
                                                            <button type="submit" class="btn btn-success">Aceptar</button>
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
