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
            <div class="container" style="align-items:center;">
                <div class="row justify-content-center">
                    <div class="col-md-8">
                        @php
                            $hayCompeticiones = false;
                        @endphp
            
                        @foreach ($misCategorias as $miCategoria)
                            @php
                                $competicionesPorCategoria = [];
                            @endphp
            
                            @foreach ($categorias as $categoria)
                                @if ($categoria->categoria_id === $miCategoria->id && $categoria->entrenador_id === Auth::user()->id)
                                    @foreach ($competiciones as $competicion)
                                        @foreach ($competicion_categorias as $competicion_categoria)
                                            @if ($competicion_categoria->categoria_id === $categoria->categoria_id && $competicion_categoria->competicion_id === $competicion->id)
                                                @php
                                                    $competicionesPorCategoria[$miCategoria->nombreCategoria][] = $competicion;
                                                    $hayCompeticiones = true;
                                                @endphp
                                            @endif
                                        @endforeach
                                    @endforeach
                                @endif
                            @endforeach
            
                            @if (!empty($competicionesPorCategoria))
                                <h4 style="text-align: center; align-items:center; color: #29733c; margin-bottom: 20px; margin-top:20px;">
                                    COMPETICIONES {{$miCategoria->nombreCategoria}}
                                </h4>
            
                                @foreach ($competicionesPorCategoria[$miCategoria->nombreCategoria] as $competicion)
                                    <div class="table-responsive" style="margin-bottom: 20px;">
                                        <table class="text-center" style="color: white; background:#163b3d80; border-radius: 15px; width: 100%;">
                                            <tbody>
                                                <tr>
                                                    <td style="padding: 10px; font-weight: bold; text-align:center; width:30%;">
                                                        @if ($competicion->fecha)
                                                            {{ \Carbon\Carbon::parse($competicion->fecha)->format('d/m/Y') }}
                                                        @endif
                                                    </td>
                                                    <td style="padding: 10px; text-align:center;width:70%;" 
                                                        onmouseover="showTooltip(event, {{ $competicion->id }})"
                                                        onmouseout="hideTooltip({{ $competicion->id }})">
                                                        {{ $competicion->titulo }}
                                                        <div class="window-notice" id="window-notice-{{ $competicion->id }}" style="display: none; position: absolute; z-index: 1000; background: #ffffff; padding: 10px; border-radius:1 5px; box-shadow: 0 0 10px rgba(0,0,0,0.5);">
                                                            <div class="content">
                                                                <div class="content-text">{{$competicion->descripcion}}</div>
                                                                <div class="content-text"><strong style="font-size: bold;">{{$competicion->localizacion}}</strong></div>
                                                            </div>
                                                        </div>
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                @endforeach
                            @endif
                        @endforeach
            
                        @if (!$hayCompeticiones)
                            <p style="background: #163b3d80; color:white; padding:1.5%; border-radius: 15px; font-size:120%; text-align:center;">
                                Todavia no hay competiciones disponibles.
                            </p>
                        @endif
                    </div>
                </div>
            </div>
            
            <script>
                function showTooltip(event, id) {
                    var tooltip = document.getElementById('window-notice-' + id);
                    tooltip.style.display = 'flex';
                    tooltip.style.left = event.pageX + 'px';
                    tooltip.style.top = (event.pageY + 10) + 'px'; 
                }
            
                function hideTooltip(id) {
                    var tooltip = document.getElementById('window-notice-' + id);
                    tooltip.style.display = 'none';
                }
            </script>
            
            
            
        @elseif (Auth::user()->tipo === 'Nadador')
        <div class="container" style="align-items:center;">
            <div class="row justify-content-center">
                <div class="col-md-8">
                    @php
                        $hayCompeticiones = false;
                    @endphp
                    
                    @foreach ($categorias as $categoria)
                        @if ($categoria->entrenador_id === Auth::user()->id)
                            @php
                                $competicionesPorCategoria = [];
                            @endphp
        
                            @foreach ($competiciones as $competicion)
                                @foreach ($competicion_categorias as $competicion_categoria)
                                    @if ($competicion_categoria->categoria_id === $categoria->categoria_id && $competicion_categoria->competicion_id === $competicion->id)
                                        @php
                                            $competicionesPorCategoria[$categoria->nombreCategoria][] = $competicion;
                                            $hayCompeticiones = true;
                                        @endphp
                                    @endif
                                @endforeach
                            @endforeach
        
                            @foreach ($competicionesPorCategoria as $nombreCategoria => $competicionesCategoria)
                                @foreach ($misCategorias as $miCategoria)
                                    @if ($miCategoria->id === $categoria->categoria_id)
                                        <h4 style="text-align: center; align-items:center; color: #29733c; margin-bottom: 20px; margin-top:20px;">COMPETICIONES {{$miCategoria->nombreCategoria}} </h4>
                                    @endif
                                @endforeach                                
                                @foreach ($competicionesCategoria as $competicion)
                                <div class="table-responsive" style="margin-bottom: 20px;">
                                    <table class="text-center" style="color: white; background:#163b3d80; border-radius: 15px; width: 100%;">
                                        <tbody>
                                            <tr>
                                                <td style="padding: 10px; font-weight: bold; text-align:center; width:30%;">
                                                    @if ($competicion->fecha)
                                                        {{ \Carbon\Carbon::parse($competicion->fecha)->format('d/m/Y') }}
                                                    @endif
                                                </td>
                                                <td style="padding: 10px; text-align:center;width:70%;" 
                                                    onmouseover="showTooltip(event, {{ $competicion->id }})"
                                                    onmouseout="hideTooltip({{ $competicion->id }})">
                                                    {{ $competicion->titulo }}
                                                    <div class="window-notice" id="window-notice-{{ $competicion->id }}" style="display: none; position: absolute; z-index: 1000; background: #ffffff; padding: 10px; border-radius: 15px; box-shadow: 0 0 10px rgba(0,0,0,0.5);">
                                                        <div class="content">
                                                            <div class="content-text">{{$competicion->descripcion}}</div>
                                                            <div class="content-text"><strong style="font-size: bold;">{{$competicion->localizacion}}</strong></div>
                                                        </div>
                                                    </div>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                                @endforeach
                            @endforeach
                        @endif
                    @endforeach
                    
                    @if (!$hayCompeticiones)
                        <p style="background: #163b3d80; color:white; padding:1.5%; border-radius: 15px; font-size:120%; text-align:center;">
                            Todavia no hay competiciones disponibles.
                        </p>
                    @endif
                </div>
            </div>
        </div>
        
        <script>
            function showTooltip(event, id) {
                var tooltip = document.getElementById('window-notice-' + id);
                tooltip.style.display = 'flex';
                tooltip.style.left = event.pageX + 'px';
                tooltip.style.top = (event.pageY + 10) + 'px'; 
            }
        
            function hideTooltip(id) {
                var tooltip = document.getElementById('window-notice-' + id);
                tooltip.style.display = 'none';
            }
        </script>
        
               
        @endif
    @endif
    <br><br>

    <style>
        .window-notice {
            background: #fff;
            border-radius: 15px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            display: none;
            position:fixed;
            z-index: 1000;
            max-width: 400px;
            padding: 20px;
            color: #000;
        }
    
        .window-notice .content-text {
            font-size: 100%;
        }
    
        table.text-center {
            color: black;
        }
    
    </style>

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
