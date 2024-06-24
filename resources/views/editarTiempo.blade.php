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
        <section class="altaNoticia">
            <form method="POST" action="" id="altaNoticia" enctype="multipart/form-data">
                @csrf
                <div id="login" class="container">
                    <h2 style="color: white; text-align: center;">EDITAR TIEMPO</h2>
                    <div class="form">
                        <div class="item" style="text-align: center;">
                            <label for="nadador">NADADOR</label><br>
                            <select id="idUsuario1" name="idUsuario1" class="form-control">
                                @foreach ($nadadores as $nadador)
                                <option value="{{ $nadador->id }}" {{ (isset($tiempo) && $tiempo->idUsuario1 == $nadador->id) ? 'selected' : '' }}>
                                    {{ $nadador->nombre }} {{ $nadador->primer_apellido }} {{ $nadador->segundo_apellido }}
                                </option>
                                @endforeach
                            </select>
                        </div><br>
                        
                        
                        
                        <div class="item" style="text-align: center;">
                            <label for="piscina">PISCINA</label><br>
                            <select name="piscina" class="form-control">
                                <option value="25" {{ (isset($tiempo) && $tiempo->piscina == '25') ? 'selected' : '' }}>25 metros</option>
                                <option value="50" {{ (isset($tiempo) && $tiempo->piscina == '50') ? 'selected' : '' }}>50 metros</option>
                            </select>
                        </div><br>
                        
                        
                        <div class="item" style="text-align: center;">
                            <label for="crono">CRONÓMETRO</label><br>
                            <select name="crono" class="form-control">
                                <option value="Manual" {{ (isset($tiempo) && $tiempo->crono == 'Manual') ? 'selected' : '' }}>Manual</option>
                                <option value="Electrónico" {{ (isset($tiempo) && $tiempo->crono == 'Electrónico') ? 'selected' : '' }}>Electrónico</option>
                            </select>
                        </div><br>
                        
                        
                        <div class="item" style="text-align: center;">
                            <label for="estilo">Estilo</label><br>
                            <select name="estilo" class="form-control">
                                <option value="Mariposa" {{ (isset($tiempo) && $tiempo->estilo == 'Mariposa') ? 'selected' : '' }}>Mariposa</option>
                                <option value="Espalda" {{ (isset($tiempo) && $tiempo->estilo == 'Espalda') ? 'selected' : '' }}>Espalda</option>
                                <option value="Braza" {{ (isset($tiempo) && $tiempo->estilo == 'Braza') ? 'selected' : '' }}>Braza</option>
                                <option value="Libres" {{ (isset($tiempo) && $tiempo->estilo == 'Libres') ? 'selected' : '' }}>Libres</option>
                                <option value="Estilos" {{ (isset($tiempo) && $tiempo->estilo == 'Estilos') ? 'selected' : '' }}>Estilos</option>
                            </select>
                        </div><br>
                        
                        <div class="item" style="text-align: center;">
                            <label for="distancia">Distancia</label><br>
                            <select name="distancia" class="form-control">
                                <option value="50" {{ (isset($tiempo) && $tiempo->distancia == '50') ? 'selected' : '' }}>50 metros</option>
                                <option value="100" {{ (isset($tiempo) && $tiempo->distancia == '100') ? 'selected' : '' }}>100 metros</option>
                                <option value="200" {{ (isset($tiempo) && $tiempo->distancia == '200') ? 'selected' : '' }}>200 metros</option>
                                <option value="400" {{ (isset($tiempo) && $tiempo->distancia == '400') ? 'selected' : '' }}>400 metros</option>
                                <option value="800" {{ (isset($tiempo) && $tiempo->distancia == '800') ? 'selected' : '' }}>800 metros</option>
                                <option value="1500" {{ (isset($tiempo) && $tiempo->distancia == '1500') ? 'selected' : '' }}>1500 metros</option>
                            </select>
                        </div><br>
                        
                        <div class="item" style="text-align: center;">
                            <input type="text" placeholder="Lugar de la Competición" name="lugar" value="{{ $tiempo->lugar ?? old('lugar') }}"><br>
                            @error('lugar')
                                <span style="color: red;">{{ $message }}</span>
                            @enderror
                        </div>
        
                        <div class="item" style="text-align: center;">
                            <input type="date" id="fecha" name="fecha" value="{{ $tiempo->fecha ?? old('fecha') }}"><br>
                            @error('fecha')
                                <span style="color: red;">{{ $message }}</span>
                            @enderror
                        </div>
        
                        <div class="item" style="text-align: center;">
                            <input type="text" placeholder="Tiempo" name="tiempo" value="{{ $tiempo->tiempo ?? old('tiempo') }}"><br>
                            @error('tiempo')
                                <span style="color: red;">{{ $message }}</span>
                            @enderror
                        </div>
        
                        <input type="hidden" name="tiempo_id" value="{{ $tiempo->id ?? '' }}">
        
                    </div>
                    <div class="container" style="text-align: center;">
                        <button type="submit" class="btn btn-success">Actualizar</button>
                    </div>
                    <div class="container" style="text-align: center;">
                        <button type="reset" class="btn btn-outline-warning">Resetear</button>
                    </div>
                </div>
            </form>
        </section><br>
        
        
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
