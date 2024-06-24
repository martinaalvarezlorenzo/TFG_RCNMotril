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


        @if($usuario->tipo === "Entrenador")
            <form action="{{route('editarPerfilE', ['id' => $usuario->id])}}" method="POST" id="altaUsuario" enctype="multipart/form-data">
        @elseif ($usuario->tipo === "Nadador")
            <form action="{{route('editarPerfilN', ['id' => $usuario->id])}}" method="POST" id="altaUsuario" enctype="multipart/form-data">
        @endif
            @csrf
            <div id="login">
                <h1>Editar Perfil</h1>
                <div class="form">
                    <div class="item">
                        <input type="text" placeholder="Nombre" name="nombre" value="{{ $usuario->nombre}}">
                        @error('nombre')
                            <span style="color: red;">{{ $message }}</span>
                        @enderror
                    </div>
                    <br>
                    <div class="item">
                        <input type="text" placeholder="Primer apellido" name="primer_apellido" value="{{ $usuario->primer_apellido}}">
                        @error('primer_apellido')
                            <span style="color: red;">{{ $message }}</span>
                        @enderror
                    </div>
                    <br>
                    <div class="item">
                        <input type="text" placeholder="Segundo apellido" name="segundo_apellido" value="{{ $usuario->segundo_apellido}}">
                        @error('segundo_apellido')
                            <span style="color: red;">{{ $message }}</span>
                        @enderror
                    </div>
                    <br>
                    <div class="item">
                        <input type="email" placeholder="Correo electronico" name="correo_electronico" value="{{ $usuario->correo_electronico}}">
                        @error('correo_electronico')
                            <span style="color: red;">{{ $message }}</span>
                        @enderror
                    </div>
                    <br>
                    <div class="item">
                        <input type="text" placeholder="Usuario (@)" name="username" value="{{ $usuario->username}}">
                        @error('username')
                            <span style="color: red;">{{ $message }}</span>
                        @enderror
                    </div>
                    <br>
                    <div class="item">
                        <input type="text" placeholder="DNI" name="dni" value="{{ $usuario->dni}}">
                        @error('dni')
                            <span style="color: red;">{{ $message }}</span>
                        @enderror
                    </div>
                    <br>
                    <div class="item">
                        <label>Sexo:</label>
                        <div class="sexoOpciones">
                            <input type="radio" id="masculino" name="sexo" value="masculino"  {{ $usuario->sexo == 'masculino' ? 'checked' : '' }}>
                            <label for="masculino">Masculino</label>
                            <input type="radio" id="femenino" name="sexo" value="femenino"  {{ $usuario->sexo == 'femenino' ? 'checked' : '' }}>
                            <label for="femenino">Femenino</label>
                        </div>
                        @error('sexo')
                            <span style="color: red;">{{ $message }}</span>
                        @enderror
                    </div>
                    
                    <br>
                    <style>
                        .checkbox-container {
                            display: inline-block; 
                            margin-right: 20px; 
                        }
                    </style>

                    @if($usuario->tipo === "Nadador")
                    <div class="item">
                        <label for="categoria">CATEGORIA</label><br><br>
                        <select id="cat" name="categoria">
                            <option value="1" {{ $categoria->categoria_id == 1 ? 'selected' : '' }}>Prebenjamin</option>
                            <option value="2" {{ $categoria->categoria_id == 2 ? 'selected' : '' }}>Benjamin</option>
                            <option value="3" {{ $categoria->categoria_id == 3 ? 'selected' : '' }}>Alevin</option>
                            <option value="4" {{ $categoria->categoria_id == 4 ? 'selected' : '' }}>Infantil</option>
                            <option value="5" {{ $categoria->categoria_id == 5 ? 'selected' : '' }}>Juniors-Absolutos</option>
                        </select>
                    </div><br>
                    @endif

                                   
                    <br>                    
                    <div class="item">
                        <input type="date" placeholder="Fecha de nacimiento" id="fechaNacimiento" name="fecha_nacimiento" value="{{ $usuario->fecha_nacimiento}}" >
                        @error('fecha_nacimiento')
                            <span style="color: red;">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="item">
                        <input type="tel" placeholder="Teléfono" id="numTelefono" name="telefono" value="{{ $usuario->telefono}}">
                        @error('telefono')
                            <span style="color: red;">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="item">
                        <input type="password" placeholder="Contraseña cuenta" name="password">
                        @error('password')
                            <span style="color: red;">{{ $message }}</span>
                        @enderror
                    </div>
        
                    <div class="item">
                        <label for="foto">Foto perfil</label><br><br>
                        <input type="file" id="imagen" name="imagen"><br>
                        @error('imagen')
                            <span style="color: red;">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
                <div class="container">
                    <button type="submit" class="btn btn-success">Actualizar</button>
                </div>
            </div>
        </form><br>

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
