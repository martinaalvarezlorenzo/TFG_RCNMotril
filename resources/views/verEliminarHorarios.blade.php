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

        <style>
            .editar {
                transition: transform 0.5s ease;
            }

            .editar:hover {
                transform: scale(1.12);
            }
        </style>

        <section class="entrenadores">
            <section class="entrenadores_partes">
                <h2 style="text-align: center;">EDITAR HORARIOS</h2>
                <section class="entrenadores_solo">
                    @php
                        // Agrupar horarios por mes
                        $horariosPorMes = [];
                        foreach($horarios as $horario) {
                            $mes = \Carbon\Carbon::parse($horario->semana)->format('Y-m');
                            $horariosPorMes[$mes][] = $horario;
                        }
                        ksort($horariosPorMes);
                    @endphp

                    @foreach($horariosPorMes as $mes => $horariosDelMes)
                        <div style="text-align: center; margin: 20px 0 10px 0; color:#29733c;">
                            <h1>{{ \Carbon\Carbon::parse($mes . '-01')->locale('es')->isoFormat('MMMM YYYY') }}</h1>
                        </div>
                        <div style="display: flex; flex-direction: column; align-items: center; width: 100%;">
                            @foreach($categorias as $categoria)
                                @foreach($horariosDelMes as $horario)
                                    @if ($horario->categoria_id == $categoria->categoria_id && $categoria->entrenador_id == Auth::user()->id)
                                        <div class="row align-items-center" style="width:80%; margin-bottom: 10px;">
                                            <div class="col-md-12">
                                                <div class="entrenador d-flex align-items-center" style="background: #163b3d80; border-radius: 15px; padding: 15px;">
                                                    <div class="fecha-container" style="flex: 1; text-align: center;"> 
                                                        @foreach ($misCategorias as $miCategoria)
                                                            @if ($miCategoria->id === $categoria->categoria_id)
                                                                <div class="fecha" style="color:white;">{{ $miCategoria->nombreCategoria }}</div>
                                                            @endif
                                                        @endforeach
                                                    </div>
                                                    <div class="semana-container" style="flex: 1; text-align: center;"> 
                                                        <div style="display: inline-flex; align-items: center; justify-content: center;">
                                                            <a class="editar" href="{{ route('editarHorarios', ['id'=> $horario->id]) }}" class="ms-3 mb-0" style="color: white; text-decoration: none; font-size: 130%;">{{ \Carbon\Carbon::parse($horario->semana)->format('d/m/Y') }} <span class="material-symbols-outlined">
                                                                edit
                                                                </span></a>
                                                        </div>
                                                    </div>
                                                    <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#confirmacionEliminarModal{{ $horario->id }}">Eliminar</button>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- Modal -->
                                        <div class="modal fade" id="confirmacionEliminarModal{{ $horario->id }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="exampleModalLabel">Confirmar Eliminación</h5>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <p>¿Estás seguro de que deseas eliminar este horario?</p>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                                                        <form action="{{ route('eliminarHorario', ['id' => $horario->id]) }}" method="POST">     
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="submit" class="btn btn-danger">Eliminar</button>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @endif
                                @endforeach
                            @endforeach
                        </div>
                    @endforeach
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
