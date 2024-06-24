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

        <form action="{{route('altaMaterial')}}" method="POST" id="altaUsuario" enctype="multipart/form-data">
            @csrf
            <div id="login">
                <h1 style="font-size: 2.5vw">Añadir material</h1>
                <div class="form">
                    <div class="item">
                        <input type="text" placeholder="Nombre" name="nombre" value="{{ old('nombre') }}"><br>
                        @error('nombre')
                            <span style="color: red;">{{ $message }}</span>
                        @enderror
                    </div>
                    <br>
                    <div class="item">
                        <input type="text" placeholder="Marca" name="marca" value="{{ old('marca') }}"><br>
                        @error('marca')
                            <span style="color: red;">{{ $message }}</span>
                        @enderror
                    </div>
                    <br>
                    <div class="item">
                        <input type="text" placeholder="Enlace página oficial" name="enlace" value="{{ old('enlace') }}"><br>
                        @error('enlace')
                            <span style="color: red;">{{ $message }}</span>
                        @enderror
                    </div>
                    <br>
                    <div class="item">
                        <input type="text" placeholder="Precio (€)" name="precio" value="{{ old('precio') }}"><br>
                        @error('precio')
                            <span style="color: red;">{{ $message }}</span>
                        @enderror
                    </div><br>
                    <div class="item">
                        <label for="categoria">TIPO MATERIAL</label>
                        <select name="tipo" style="max-width: 100%; max-height: 150px; overflow-y: auto; border-radius: 5px; padding: 8px; background-color: #f8f9fa; border: 1px solid #ced4da; color: #495057; font-size: 16px;">
                            <option value="1">GORROS Y GAFAS</option>
                            <option value="2">BAÑADORES Y FASTKIN</option>
                            <option value="3">MATERIALES AUXILIARES</option>
                        </select>
                    </div><br>
                    <div class="item">
                        <label for="foto">Imagen material </label>
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
