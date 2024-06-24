
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

        <style>
            .editar-container {
                transition: transform 0.5s ease;
                display: inline-block; 
            }
        
            .editar-container:hover {
                transform: scale(1.12);
            }
        </style>

    <h2 class="titulo" style="text-align:center;">Editar mínima</h2>    

    <div style="display: flex; justify-content: space-between; width: 100%;">

    <div style="width: 50%;">
        <section class="altaNoticia">
            <form method="POST" action="{{route('verEliminarMinimasRelevos')}}" id="altaNoticia" enctype="multipart/form-data">
                @csrf
                <div id="loginB" class="container">
                    <h2 style="color: white; text-align: center;">BUSCAR MINIMAS RELEVOS</h2>
                    <div class="form" style="display: flex; justify-content: space-between;">

                        <div class="item" style="text-align: center; flex: 1;">
                            <label for="piscina">PISCINA</label>
                            <select name="piscina" class="form-control" style="width: 100%;">
                                <option value="25" {{ old('piscina') == '25' ? 'selected' : '' }}>25 metros</option>
                                <option value="50" {{ old('piscina') == '50' ? 'selected' : '' }}>50 metros</option>
                            </select>
                        </div>
                    
                        <div class="item" style="text-align: center; flex: 1;">
                            <label for="crono">CRONÓMETRO</label>
                            <select name="crono" class="form-control" style="width: 100%;">
                                <option value="Manual" {{ old('crono') == 'Manual' ? 'selected' : '' }}>Manual</option>
                                <option value="Electrónico" {{ old('crono') == 'Electrónico' ? 'selected' : '' }}>Electrónico</option>
                            </select>
                        </div>
                    
                        <div class="item" style="text-align: center; flex: 1;">
                            <label for="estilo">Estilo</label>
                            <select name="estilo" class="form-control" style="width: 100%;">
                                <option value="Libres" {{ old('estilo') == 'Libres' ? 'selected' : '' }}>Libres</option>
                                <option value="Estilos" {{ old('estilo') == 'Estilos' ? 'selected' : '' }}>Estilos</option>
                            </select>
                        </div>
                    </div>
                    <div class="form" style="display: flex; justify-content: space-between;">

                        <div class="item" style="text-align: center; flex: 1;">
                            <label for="distancia">Distancia</label>
                            <select name="distancia" class="form-control" style="width: 100%;">
                                <option value="4x50" {{ old('distancia') == '4x50' ? 'selected' : '' }}>4x50m</option>
                                <option value="4x100" {{ old('distancia') == '4x100' ? 'selected' : '' }}>4x100m</option>
                                <option value="4x200" {{ old('distancia') == '4x200' ? 'selected' : '' }}>4x200m</option>
                            </select>
                        </div>
                    
                        <div class="item" style="text-align: center; flex: 1;">
                            <label for="sexo">Sexo</label>
                            <select name="sexo" class="form-control" style="width: 100%;">
                                <option value="Masculino" {{ old('sexo') == 'Masculino' ? 'selected' : '' }}>Masculino</option>
                                <option value="Femenino" {{ old('sexo') == 'Femenino' ? 'selected' : '' }}>Femenino</option>
                                <option value="Mixto" {{ old('sexo') == 'Mixto' ? 'selected' : '' }}>Mixto</option>
                            </select>
                        </div>
                        <div class="item" style="text-align: center; flex: 1;">
                            <label for="tipo">Tipo</label>
                            <select name="tipo" class="form-control" style="width: 100%;">
                                <option value="Andalucia" {{ old('tipo') == 'Andalucia' ? 'selected' : '' }}>Andalucía</option>
                                <option value="Espana" {{ old('tipo') == 'Espana' ? 'selected' : '' }}>España</option>
                            </select>
                        </div>
                    
                    </div>
                    
                    <div class="container" style="text-align: center;">
                        <button type="submit" class="btn btn-success">Buscar</button>
                    </div>
                </div>
            </form>
        </section><br>

        <div style="width: 90%; margin: 0 auto;">
            @if(isset($minimasRelevos))
            @if($minimasRelevos->isEmpty())
                <p style="background: #163b3d80; color:white; padding:1.5%; border-radius: 15px; font-size:120%; text-align:center;">No se encontraron mínimas.</p>
            @else
                @foreach($minimasRelevos as $minima)
                    @php
                       
                        $nadador1 = \App\Models\User::find($minima->idUsuario1);
                        $nadador2 = \App\Models\User::find($minima->idUsuario2);
                        $nadador3 = \App\Models\User::find($minima->idUsuario3);
                        $nadador4 = \App\Models\User::find($minima->idUsuario4);
                    @endphp
                    <table class="table" style="background: #163b3d80; color:white; border-radius: 15px; margin-bottom: 20px;">
                        <tbody>
                            <tr style="border-radius: 15px;">
                                <!-- Datos del nadador 1 -->
                                <td style="background-color: transparent; color: white; border-radius: 15px; border-bottom: none; width: 50%; text-align: center; font-size: 1.2em;">
                                    {{ $nadador1->nombre }} {{ $nadador1->primer_apellido }}<br>
                                    {{ $nadador2->nombre }} {{ $nadador2->primer_apellido }}<br>
                                    {{ $nadador3->nombre }} {{ $nadador3->primer_apellido }}<br>
                                    {{ $nadador4->nombre }} {{ $nadador4->primer_apellido }}
                                </td>
                                <td style="background-color: transparent; border-radius: 15px; border-bottom: none; width: 25%; text-align: center; font-size: 1.2em; vertical-align: middle; " class="align-middle">
                                    <div class="editar-container" style="display: inline-block;">
                                        <a href="{{ route('editarMinimaRelevo', ['id'=> $minima->id]) }}" class="editar" style="color: white; text-decoration: none; font-size: 1.2em;">{{ $minima->tiempo }} <span class="material-symbols-outlined">
                                            edit
                                            </span></a>
                                    </div>
                                </td>
                                <td style="background-color: transparent; border-radius: 15px; border-bottom: none; width: 25%; text-align: center; vertical-align: middle;" class="align-middle">
                                    <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#confirmacionEliminarModal{{ $minima->id }}">Eliminar</button>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                    
                    
                    <!-- Modal -->
                    <div class="modal fade" id="confirmacionEliminarModal{{ $minima->id }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Confirmar Eliminación</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <p>¿Estás seguro de que deseas eliminar esta mínima?</p>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                                    <form action="{{ route('verEliminarMinima', ['id' => $minima->id]) }}" method="POST">     
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger">Eliminar</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            @endif
        @endif
        
        

        </div>
        </div>

        <div style="width: 50%;">
            <section class="altaNoticia">
                <form method="POST" action="{{route('verEliminarMinimasIndividuales')}}" id="altaNoticia" enctype="multipart/form-data">
                    @csrf
                    <div id="loginB" class="container">
                        <h2 style="color: white; text-align: center;">BUSCAR MINIMAS INDIVIDUALES</h2>
                        <div class="form">
                        <div class="form" style="display: flex; justify-content: space-between;">

                            <div class="item" style="text-align: center; flex: 1;">
                                <label for="piscina">PISCINA</label>
                                <select name="piscina" class="form-control">
                                    <option value="25" {{ old('piscina') == '25' ? 'selected' : '' }}>25 metros</option>
                                    <option value="50" {{ old('piscina') == '50' ? 'selected' : '' }}>50 metros</option>
                                </select>
                            </div>
                            
                            <div class="item" style="text-align: center; flex: 1;">
                                <label for="crono">CRONÓMETRO</label>
                                <select name="crono" class="form-control">
                                    <option value="Manual" {{ old('crono') == 'Manual' ? 'selected' : '' }}>Manual</option>
                                    <option value="Electrónico" {{ old('crono') == 'Electrónico' ? 'selected' : '' }}>Electrónico</option>
                                </select>
                            </div>
                            
                            <div class="item" style="text-align: center; flex: 1;">
                                <label for="estilo">Estilo</label>
                                <select name="estilo" class="form-control">
                                    <option value="Mariposa" {{ old('estilo') == 'Mariposa' ? 'selected' : '' }}>Mariposa</option>
                                    <option value="Espalda" {{ old('estilo') == 'Espalda' ? 'selected' : '' }}>Espalda</option>
                                    <option value="Braza" {{ old('estilo') == 'Braza' ? 'selected' : '' }}>Braza</option>
                                    <option value="Libres" {{ old('estilo') == 'Libres' ? 'selected' : '' }}>Libres</option>
                                    <option value="Estilos" {{ old('estilo') == 'Estilos' ? 'selected' : '' }}>Estilos</option>
                                </select>
                            </div>
                        </div>
                        <div class="form" style="display: flex; justify-content: space-between;">
                            <div class="item" style="text-align: center; flex: 1;">
                                <label for="distancia">Distancia</label>
                                <select name="distancia" class="form-control">
                                    <option value="50" {{ old('distancia') == '50' ? 'selected' : '' }}>50 metros</option>
                                    <option value="100" {{ old('distancia') == '100' ? 'selected' : '' }}>100 metros</option>
                                    <option value="200" {{ old('distancia') == '200' ? 'selected' : '' }}>200 metros</option>
                                    <option value="400" {{ old('distancia') == '400' ? 'selected' : '' }}>400 metros</option>
                                    <option value="800" {{ old('distancia') == '800' ? 'selected' : '' }}>800 metros</option>
                                    <option value="1500" {{ old('distancia') == '1500' ? 'selected' : '' }}>1500 metros</option>
                                </select>
                            </div>

                            <div class="item" style="text-align: center; flex: 1;">
                                <label for="tipo">Tipo</label>
                                <select name="tipo" class="form-control" style="width: 100%;">
                                    <option value="Andalucia" {{ old('tipo') == 'Andalucia' ? 'selected' : '' }}>Andalucía</option>
                                    <option value="Espana" {{ old('tipo') == 'Espana' ? 'selected' : '' }}>España</option>
                                </select>
                            </div>

                            <div class="item" style="text-align: center;">
                                <label for="sexo">Género</label>
                                <select name="sexo" class="form-control">
                                    <option value="femenino" {{ old('sexo') == 'femenino' ? 'selected' : '' }}>Femenino</option>
                                    <option value="masculino" {{ old('sexo') == 'masculino' ? 'selected' : '' }}>Masculino</option>
                                </select>
                            </div>
                        </div>
                            
                        </div>
                        <div class="container" style="text-align: center;">
                            <button type="submit" class="btn btn-success">Buscar</button>
                        </div>
                    </div>
                </form>
            </section><br>
    
            <div style="width: 90%; margin: 0 auto;">
                @if(isset($resultadosFinales))
                    @if($resultadosFinales->isEmpty())
                        <p style="background: #163b3d80; color:white; padding:1.5%; border-radius: 15px; font-size:120%; text-align:center;">No se encontraron mínimas.</p>
                    @else
                        @foreach($resultadosFinales as $minima)
                            @php
                                $nadador = collect($nadadores)->firstWhere('id', $minima->idUsuario1);
                            @endphp
                            @if($nadador)
                                <table class="table" style="background: #163b3d80; color:white; border-radius: 15px; margin-bottom: 20px;">
                                    <tbody>
                                        <tr style="border-radius: 15px;">
                                            <td style="background-color: transparent; color: white; border-radius: 15px; border-bottom: none; width: 50%; text-align: center; font-size: 1.4em;">{{ $nadador->nombre }} {{ $nadador->primer_apellido }} {{ $nadador->segundo_apellido }}</td>
                                            <td style="background-color: transparent; border-radius: 15px; border-bottom: none; width: 25%; text-align: center; font-size: 1.2em; vertical-align: middle; " class="align-middle">
                                                <div class="editar-container" style="display: inline-block;">
                                                    <a href="{{ route('editarMinima', ['id'=> $minima->id]) }}" class="editar" style="color: white; text-decoration: none; font-size: 1.2em;">{{ $minima->tiempo }} <span class="material-symbols-outlined">
                                                        edit
                                                        </span></a>
                                                </div>
                                            </td>
                                            
                                            
                                            
                                            
                                            <td style="background-color: transparent; border-radius: 15px; border-bottom: none; width: 25%; text-align: right;">
                                                <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#confirmacionEliminarModal{{ $minima->id }}">Eliminar</button>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                                <!-- Modal -->
                                <div class="modal fade" id="confirmacionEliminarModal{{ $minima->id }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLabel">Confirmar Eliminación</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                <p>¿Estás seguro de que deseas eliminar esta minima?</p>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                                                <form action="{{ route('verEliminarMinima', ['id' => $minima->id]) }}" method="POST">     
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
                    @endif
                @endif
            </div>
            </div>

    </div>
        
  
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
