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
        <form method="POST" action="{{ route('editarEntrenamiento', ['id' => $entrenamiento->id]) }}" id="altaNoticia" enctype="multipart/form-data">
            @csrf
            <div id="login" style="width: 80%;">
                <h2 style="color: white;">AÑADIR ENTRENAMIENTO</h2>
                <div class="form"> 
                    <div class="item">
                        <label for="categoria">CATEGORIA</label><br><br>
                        <select id="cat" name="categoria">
                            @foreach ($categorias as $categoria)
                                @foreach ($misCategorias as $miCategoria)
                                    @if ($categoria->entrenador_id === Auth::user()->id && $miCategoria->id === $categoria->categoria_id)
                                        <option value="{{ $miCategoria->id }}" @if ($miCategoria->id == $entrenamiento->categoria_id) selected @endif>{{ $miCategoria->nombreCategoria }}</option>
                                    @endif
                                @endforeach
                            @endforeach
                        </select>
                        
                    </div><br>

                    <div class="item">
                        <label for="text"> ENTRENAMIENTO</label><br><br>
                        <textarea placeholder="Escribe el entrenamiento" name="entrenamiento" id="textoentreno" rows="10" cols="25" class="comentario-textarea">{{ $entrenamiento->entrenamiento }}</textarea><br>
                        @error('entrenamiento')
                            <span style="color: red;">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="item">
                        <input type="date" id="dia" name="dia" value="{{ $entrenamiento->dia}}" > <br>
                        @error('dia')
                            <span style="color: red;">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
                <div class="container">
                    <button type="submit" class="btn btn-success">Actualizar</button>
                </div>
                <div class="container">
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
