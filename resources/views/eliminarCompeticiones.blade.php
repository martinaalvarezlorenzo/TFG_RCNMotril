<!doctype html>
    <html lang="es">

    <head>
        <title>Real Club Náutico de Motril - Página principal</title>
        <meta charset="UTF-8">
        <link rel="stylesheet" type="text/css" href="{{ asset('css/login.css') }}">
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
                display: inline-block; 
            }
        
            .editar:hover {
                transform: scale(1.12);
            }
        </style>
        
        
        @if(Auth::check())
        @if(Auth::user()->tipo === 'Entrenador')
            <section class="entrenadores">
                <section class="entrenadores_partes">
                    @php
                        $hayCompeticiones = false;
                    @endphp
                    
                    @foreach ($categorias as $categoria)
                        @if ($categoria->entrenador_id === Auth::user()->id)
                            @php
                                $competicionesPorCategoria = [];
                            @endphp
            
                            @foreach ($competiciones as $competicion)
                                @foreach ($competicion_categorias as $competicion_categoria)
                                    @if ($competicion_categoria->categoria_id === $categoria->categoria_id && $competicion_categoria->competicion_id === $competicion->id)
                                        @php
                                            $competicionesPorCategoria[$categoria->nombreCategoria][] = $competicion;
                                            $hayCompeticiones = true;
                                        @endphp
                                    @endif
                                @endforeach
                            @endforeach
                            <section class="entrenadores_solo">
                            @foreach ($competicionesPorCategoria as $nombreCategoria => $competicionesCategoria)
                                @foreach ($misCategorias as $miCategoria)
                                    @if ($miCategoria->id === $categoria->categoria_id)
                                        <h4 style="text-align: center; color: #29733c; margin-bottom: 20px; margin-top:20px;">EDITAR COMPETICIONES {{$miCategoria->nombreCategoria}} </h4>
                                    @endif
                                @endforeach                                    
                                @foreach ($competicionesCategoria as $competicion)
                                    <div class="row justify-content-center">
                                        <div class="entrenador d-flex align-items-center" style="background: #163b3d80; border-radius: 15px; margin: 10px 0; padding: 10px; width: 90%; margin: auto; margin-top:1%;">
                                            <div class="fecha-container" style="text-align: center; width:20%;"> 
                                                @foreach ($misCategorias as $miCategoria)
                                                    @if ($miCategoria->id === $categoria->categoria_id)
                                                        <div class="fecha" style="color:white;"><strong>
                                                            {{ \Carbon\Carbon::parse($competicion->fecha)->format('d/m/Y') }}</strong>
                                                        </div>
                                                    @endif
                                                @endforeach
                                            
                                            </div>
                                            <div class="semana-container" style="text-align: center; width: 70%;">
                                                <div style="display: inline-block;">
                                                    <a href="{{ route('editarCompeticion', ['id'=> $competicion->id]) }}" class="editar ms-3 mb-0" style="color: white; text-decoration: none; font-size: 150%;">
                                                        {{$competicion->titulo}} <span class="material-symbols-outlined">edit</span>
                                                    </a>
                                                </div>
                                            </div>
                                            
                                            
                                            <div style="text-align: center; width:10%;"> 
                                                <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#confirmacionEliminarModal{{ $competicion->id }}">Eliminar</button>
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <!-- Ventana Modal -->
                                    <div class="modal fade" id="confirmacionEliminarModal{{ $competicion->id }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalLabel">Confirmar Eliminación</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    <p>¿Estás seguro de que deseas eliminar esta competición?</p>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                                                    <form action="{{ route('eliminarCompeticion', ['id' => $competicion->id]) }}" method="POST">     
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-danger">Eliminar</button>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            @endforeach
                        </div>
                        @endif
                    @endforeach
                    
                    @if (!$hayCompeticiones)
                        <p style="background: #163b3d80; color:white; padding:1.5%; border-radius: 15px; font-size:120%; text-align:center;">Todavía no hay competiciones disponibles.</p>
                    @endif
                </div>
            </div>
        @endif
    @endif
    
    @if(session('success'))
        <script>
            window.onload = function() {
                alert("{{ session('success') }}");
            }
        </script>
    @endif

    
    
    <br><br>
    <x-footer>

    </x-footer>

    </body>
</html>
