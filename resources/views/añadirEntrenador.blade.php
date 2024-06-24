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

        <form action="{{route('register_entrenador')}}" method="POST" id="altaUsuario" enctype="multipart/form-data">
            @csrf
            <div id="login">
                <h1>Añadir entrenador</h1>
                <div class="form">
                    <div class="item">
                        <input type="text" placeholder="Nombre" name="nombre" value="{{ old('nombre') }}"><br>
                        @error('nombre')
                            <span style="color: red;">{{ $message }}</span>
                        @enderror
                    </div>
                    <br>
                    <div class="item">
                        <input type="text" placeholder="Primer apellido" name="primer_apellido" value="{{ old('primer_apellido') }}"><br>
                        @error('primer_apellido')
                            <span style="color: red;">{{ $message }}</span>
                        @enderror
                    </div>
                    <br>
                    <div class="item">
                        <input type="text" placeholder="Segundo apellido" name="segundo_apellido" value="{{ old('segundo_apellido') }}"><br>
                        @error('segundo_apellido')
                            <span style="color: red;">{{ $message }}</span>
                        @enderror
                    </div>
                    <br>
                    <div class="item">
                        <input type="email" placeholder="Correo electronico" name="correo_electronico" value="{{ old('correo_electronico') }}"><br>
                        @error('correo_electronico')
                            <span style="color: red;">{{ $message }}</span>
                        @enderror
                    </div>
                    <br>
                    <div class="item">
                        <input type="text" placeholder="Usuario (@)" name="username" value="{{ old('username') }}"><br>
                        @error('username')
                            <span style="color: red;">{{ $message }}</span>
                        @enderror
                    </div>
                    <br>
                    <div class="item">
                        <input type="text" placeholder="DNI" name="dni" value="{{ old('dni') }}"><br>
                        @error('dni')
                            <span style="color: red;">{{ $message }}</span>
                        @enderror
                    </div>
                    <br>
                    <div class="item">
                        <label>Sexo:</label>
                        <div class="sexoOpciones">
                            <input type="radio" id="masculino" name="sexo" value="masculino"  {{ old('sexo') == 'masculino' ? 'checked' : '' }}>
                            <label for="masculino">Masculino</label>
                            <input type="radio" id="femenino" name="sexo" value="femenino"  {{ old('sexo') == 'femenino' ? 'checked' : '' }}>
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
                                   
                    <br>                    
                    <div class="item">
                        <input type="date" placeholder="Fecha de nacimiento" id="fechaNacimiento" name="fecha_nacimiento" value="{{ old('fecha_nacimiento') }}" ><br>
                        @error('fecha_nacimiento')
                            <span style="color: red;">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="item">
                        <input type="tel" placeholder="Teléfono" id="numTelefono" name="telefono" value="{{ old('telefono') }}"><br>
                        @error('telefono')
                            <span style="color: red;">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="item">
                        <input type="password" placeholder="Contraseña cuenta" name="password"><br>
                        @error('password')
                            <span style="color: red;">{{ $message }}</span>
                        @enderror
                    </div>
        
                    <div class="item">
                        <label for="foto">Foto entrenador</label><br><br>
                        <input type="file" id="imagen" name="imagen"><br>
                        @error('imagen')
                            <span style="color: red;">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
                <div class="container">
                    <button type="submit" class="btn btn-success">Guardar</button>
                </div>
                <div class="container">
                    <button type="reset" class="btn btn-outline-warning">Resetear</button>
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
