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
                    </style>
        
                <x-usuarios>

                </x-usuarios>
            
            </section>
        
            <x-menu>

            </x-menu>
        </header>

        <div style="width: 100%;">
            <section class="altaNoticia" style="display: flex; justify-content: center; margin-bottom: 40px;">
                <form method="POST" action="{{route('ranking')}}" id="altaNoticia" enctype="multipart/form-data" style="width: 100%;">
                    @csrf
                    <div id="loginB" class="container">
                        <h2 style="color: white; text-align: center;">RANKING</h2>
                        <div class="form" style="display: flex; justify-content: center;">
                            <div class="item" style="text-align: center; margin-right: 20px;">
                                <label for="piscina">PISCINA</label>
                                <select name="piscina" class="form-control">
                                    <option value="25" {{ old('piscina') == '25' ? 'selected' : '' }}>25 metros</option>
                                    <option value="50" {{ old('piscina') == '50' ? 'selected' : '' }}>50 metros</option>
                                </select>
                            </div>
        
                            <div class="item" style="text-align: center; margin-right: 20px;">
                                <label for="crono">CRONÓMETRO</label>
                                <select name="crono" class="form-control">
                                    <option value="Manual" {{ old('crono') == 'Manual' ? 'selected' : '' }}>Manual</option>
                                    <option value="Electrónico" {{ old('crono') == 'Electrónico' ? 'selected' : '' }}>Electrónico</option>
                                </select>
                            </div>
        
                            <div class="item" style="text-align: center; margin-right: 20px;">
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
        
                            <div class="item" style="text-align: center; margin-right: 20px;">
                                <label for="estilo">Estilo</label>
                                <select name="estilo" class="form-control">
                                    <option value="Mariposa" {{ old('estilo') == 'Mariposa' ? 'selected' : '' }}>Mariposa</option>
                                    <option value="Espalda" {{ old('estilo') == 'Espalda' ? 'selected' : '' }}>Espalda</option>
                                    <option value="Braza" {{ old('estilo') == 'Braza' ? 'selected' : '' }}>Braza</option>
                                    <option value="Libres" {{ old('estilo') == 'Libres' ? 'selected' : '' }}>Libres</option>
                                    <option value="Estilos" {{ old('estilo') == 'Estilos' ? 'selected' : '' }}>Estilos</option>
                                </select>
                            </div>
        
                            <div class="item" style="text-align: center;">
                                <label for="sexo">Género</label>
                                <select name="sexo" class="form-control">
                                    <option value="femenino" {{ old('sexo') == 'femenino' ? 'selected' : '' }}>Femenino</option>
                                    <option value="masculino" {{ old('sexo') == 'masculino' ? 'selected' : '' }}>Masculino</option>
                                </select>
                            </div>

                            <div class="item" style="text-align: center; margin-right: 20px;">
                                <label for="resultados">Resultados a mostrar</label>
                                <input type="number" name="resultados" class="form-control" value="{{ old('resultados', 10) }}" min="1" max="100">
                            </div>
                        </div>
                        <div class="container" style="text-align: center;">
                            <button type="submit" class="btn btn-success">Buscar</button>
                        </div>
                    </div>
                </form>
            </section>
        </div>
        
        <div style="width: 83%; margin: 0 auto;">
            @if(isset($resultadosFinales))
                @if($resultadosFinales->isEmpty())
                    <p style="background: #163b3d80; color:white; padding:1.5%; border-radius: 15px; font-size:120%; text-align:center;">No se encontraron tiempos.</p>
                @else
                    @foreach($resultadosFinales as $tiempo)
                        @php
                            $nadador = \App\Models\User::find($tiempo->idUsuario1);

                        @endphp
                        <table class="table" style="background: #163b3d80; color:white; border-radius: 15px; margin-bottom: 20px;">
                            <tbody>
                                <tr style="border-radius: 15px;">
                                    <td style="background-color: transparent; color: white; border-radius: 15px; border-bottom: none; width: 40%; text-align: center; font-size: 1.2em; ">{{ $nadador->nombre }} {{ $nadador->primer_apellido }} {{ $nadador->segundo_apellido }}</td>
                                    <td style="background-color: transparent; color: white; border-radius: 15px; border-bottom: none; width: 15%; text-align: center; font-size: 1.2em;">{{ $tiempo->tiempo }}</td>
                                    <td style="background-color: transparent; color: white; border-radius: 15px; border-bottom: none; width: 25%; text-align: center; font-size: 1.2em;">{{ $tiempo->lugar }}</td>
                                    <td style="background-color: transparent; color: white; border-radius: 15px; border-bottom: none; width: 20%; text-align: center; font-size: 1.2em;">
                                        {{ \Carbon\Carbon::createFromFormat('Y-m-d', $tiempo->fecha)->format('d/m/Y') }}
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    @endforeach
                @endif
            @endif
        </div>
        
        
        
        </div>
    </div>

            
            
            
    
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