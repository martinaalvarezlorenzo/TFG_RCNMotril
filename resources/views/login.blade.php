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
                    <section>
                        <form action="" method="GET">
                            <button type="submit" class="btn btn-success">Acceder</button>
                        </form>
                    </section>
            </section>
        
            <x-menu>

            </x-menu>
        </header>

        <form action="{{route('inicia-sesion')}}" method="POST">
            @csrf
            <div id="login">
                <h1>Iniciar Sesión</h1>
                <div class="form">
                    <div class="item">
                        <input type="text" placeholder="Usuario" name="username" value="{{ old('username') }}">
                    </div>
                    <div class="item">
                        <input type="password" placeholder="Contraseña" name="password" value="{{ old('password') }}">
                    </div>
                </div>
                <div class="container">
                    <button type="submit" class="btn btn-success">Acceder</button>
                </div>
                <div class="container">
                    <a href="{{route('solicitud_registro')}}" class="btn btn-light btnSR" >Solicitud de registro</a>
                </div>
                
                <br>
                @if($errors->any())
                <div class="alert alert-danger">
                    @foreach ($errors->all() as $error)
                        {{ $error }}<br>
                    @endforeach
                </div>
            @endif
                
            </div>
        </form>

        <br>
        <br>
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