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
        <style>
            .altaNoticia {
                display: flex;
                justify-content: center;
                align-items: center;
                height: 100vh; 
            }
            
            #login {
                width: 100%;
                max-width: 100%; 
                padding: 20px;
            }
        
            .item {
                margin-bottom: 10px;
            }
        
            .container {
                text-align: center;
            }
        </style>

        <section class="altaNoticia">
            <form method="POST" action="{{ route('editarHorarios', ['id' => $horario->id]) }}" id="altaNoticia" enctype="multipart/form-data">
                @csrf
                <div id="login" style="width: 90%;">
                    <h2 style="color:white;margin-left:10px; margin-right:10px;">EDITAR HORARIO</h2>
                    <div class="form">
                        <div class="item">
                            <label for="categoria">CATEGORIA</label><br><br>
                            <select id="cat" name="categoria">
                                @foreach ($categorias as $categoria)
                                    @foreach ($misCategorias as $miCategoria)
                                        @if ($categoria->entrenador_id === Auth::user()->id && $miCategoria->id === $categoria->categoria_id)
                                            <option value="{{ $miCategoria->id }}" @if ($miCategoria->id == $horario->categoria_id) selected @endif>{{ $miCategoria->nombreCategoria }}</option>
                                        @endif
                                    @endforeach
                                @endforeach
                            </select>
                            
                        </div><br>

                        <div class="item">
                            <input type="text" id="horarioLunes" placeholder="Lunes" name="horarioLunes" value="{{ $horario->horarioLunes }}" ><br>
                            @error('horarioLunes')
                                <span style="color: red;">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="item">
                            <input type="text" id="horarioMartes" placeholder="Martes" name="horarioMartes" value="{{ $horario->horarioMartes }}" > <br>
                            @error('horarioMartes')
                                <span style="color: red;">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="item">
                            <input type="text" id="horarioMiercoles" placeholder="Miércoles" name="horarioMiercoles" value="{{ $horario->horarioMiercoles }}" > <br>
                            @error('horarioMiercoles')
                                <span style="color: red;">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="item">
                            <input type="text" id="horarioJueves" placeholder="Jueves" name="horarioJueves" value="{{ $horario->horarioJueves }}" > <br>
                            @error('horarioJueves')
                                <span style="color: red;">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="item">
                            <input type="text" id="horarioViernes" placeholder="Viernes" name="horarioViernes" value="{{ $horario->horarioViernes }}" > <br>
                            @error('horarioViernes')
                                <span style="color: red;">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="item">
                            <input type="text" id="horarioSabado" placeholder="Sábado" name="horarioSabado" value="{{ $horario->horarioSabado }}" > <br>
                            @error('horarioSabado')
                                <span style="color: red;">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="item">
                            <input type="date" id="semana" name="semana" value="{{ $horario->semana }}" > <br>
                            @error('semana')
                                <span style="color: red;">{{ $message }}</span>
                            @enderror
                        </div>
                        
                    </div>
                    <div class="container">
                        <button type="submit" class="btn btn-success">Actualizar</button>
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
