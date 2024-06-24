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
        
        @if(Auth::check())
        @if(Auth::user()->tipo === 'Entrenador')
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-md-6">
                        @php
                            $hayEntrenamientoHoy = false;
                            $fechaHoy = \Carbon\Carbon::today()->toDateString(); 
                        @endphp
    
                        @foreach ($categorias as $categoria)
                            @if ($categoria->entrenador_id === Auth::user()->id)
                                @php
                                    $entrenamientosCategoria = $entrenamientos->where('categoria_id', $categoria->categoria_id);
                                    $entrenamientoHoy = $entrenamientosCategoria->firstWhere('dia', $fechaHoy);
                                @endphp
    
                                @if ($entrenamientoHoy)
                                    @php
                                        $hayEntrenamientoHoy = true;
                                    @endphp
                                    <div class="table-responsive">
                                        @foreach ($misCategorias as $miCategoria)
                                            @if ($miCategoria->id === $categoria->categoria_id)
                                                <h4 style="text-align: center; color: #29733c; margin-bottom: 20px; margin-top:20px;">
                                                    ENTRENAMIENTO {{$miCategoria->nombreCategoria}}
                                                </h4>
                                            @endif
                                        @endforeach
                                        <table id="tabla" class="text-center" style="color: white; background:#163b3d80; border-radius: 15px; margin-bottom: 20px;">
                                            <thead>
                                                <tr>
                                                    <th style="padding: 10px;">{{ \Carbon\Carbon::now()->format('d/m/Y') }}</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td style="padding: 10px;">{{$entrenamientoHoy->entrenamiento}}</td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                @endif
                            @endif
                        @endforeach
    
                        @if (!$hayEntrenamientoHoy)
                            <p style="background: #163b3d80; color:white; padding:1.5%; border-radius: 15px; font-size:120%; text-align:center;">
                                Todavia no has añadido un entrenamiento.
                            </p>
                        @endif
                    </div>
                </div>
            </div>
            
            @else
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-md-6">
                        @php
                            $entrenamientoDelDia = null;
                            $hayEntrenamientoHoy = false;
                            $fechaHoy = \Carbon\Carbon::today()->toDateString(); 
                        @endphp
        
                        @if(Auth::check() && Auth::user()->tipo === 'Nadador')   
                            @foreach ($misCategorias as $miCategoria)
                                @foreach ($categorias as $categoria)
                                    @if($categoria->entrenador_id === Auth::user()->id && $categoria->categoria_id === $miCategoria->id)
                                        @foreach ($entrenamientos as $entreno)
                                            @if ($entreno->categoria_id === $miCategoria->id && $entreno->dia === $fechaHoy)
                                                @php
                                                    $entrenamientoDelDia = $entreno;
                                                    $hayEntrenamientoHoy = true;
                                                @endphp
                                                @break(3) 
                                            @endif
                                        @endforeach
                                    @endif
                                @endforeach
                            @endforeach
        
                            @if ($hayEntrenamientoHoy && $entrenamientoDelDia)
                                @php
                                    $fechaEntreno = \Carbon\Carbon::createFromFormat('Y-m-d', $entrenamientoDelDia->dia);
                                    setlocale(LC_TIME, 'es_ES'); 
                                    $diaSemana = ucfirst(strftime('%A', $fechaEntreno->timestamp)); 
                                @endphp
        
                                <h4 style="text-align: center; color: #29733c;">ENTRENAMIENTO {{$miCategoria->nombreCategoria}}</h4>
                                <div class="table-responsive" style="align-items: center;">
                                    <table id="tabla" class="text-center" style="color: white; background:#163b3d80; border-radius: 15px;">
                                        <thead>
                                            <tr>
                                                <th style="padding: 10px;">{{ $fechaEntreno->format('d/m/Y') }}</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td style="padding: 10px;">{{$entrenamientoDelDia->entrenamiento}}</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            @else
                                <p style="background: #163b3d80; color:white; padding:1.5%; border-radius: 15px; font-size:120%; text-align:center;">
                                    No hay entrenamiento para hoy en este momento.
                                </p>
                            @endif
                        @endif
                    </div>
                </div>
            </div>
        @endif
        @endif
        
        <br><br>

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
