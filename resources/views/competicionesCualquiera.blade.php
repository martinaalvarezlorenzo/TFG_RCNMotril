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
        
        <div class="container" style="align-items:center;">
            <div class="row justify-content-center">
                <div class="col-md-8">
                    @php
                        $hayCompeticiones = false;
                        $competenciasMostradas = []; 
                    @endphp
    
                    @foreach ($categorias as $categoria)
                        @php
                            $competicionesPorCategoria = [];
                        @endphp
    
                        @foreach ($competicion_categorias as $competicion_categoria)
                            @if ($competicion_categoria->categoria_id === $categoria->categoria_id)
                                @foreach ($competiciones as $competicion)
                                    @if ($competicion_categoria->competicion_id === $competicion->id)
                                        @php
                                            if (!in_array($competicion->id, $competenciasMostradas)) {
                                                $competicionesPorCategoria[$categoria->nombreCategoria][] = $competicion;
                                                $competenciasMostradas[] = $competicion->id; 
                                                $hayCompeticiones = true;
                                            }
                                        @endphp
                                    @endif
                                @endforeach
                            @endif
                        @endforeach
    
                        @if (count($competicionesPorCategoria) > 0)
                            @foreach ($misCategorias as $miCategoria)
                                @if ($miCategoria->id === $categoria->categoria_id)
                                    <h4 style="text-align: center; align-items:center; color: #29733c; margin-bottom: 20px; margin-top:20px;">COMPETICIONES {{$miCategoria->nombreCategoria}} </h4>
                                @endif
                            @endforeach 
                            @foreach ($competicionesPorCategoria[$categoria->nombreCategoria] as $competicion)
                                <div class="table-responsive" style="margin-bottom: 20px;">
                                    <table class="text-center" style="color: white; background:#163b3d80; border-radius: 15px; width: 100%;">
                                        <tbody>
                                            <tr>
                                                <td style="padding: 10px; font-weight: bold; text-align:center; width:30%;">
                                                    @if ($competicion->fecha)
                                                        {{ \Carbon\Carbon::parse($competicion->fecha)->format('d/m/Y') }}
                                                    @endif
                                                </td>
                                                <td style="padding: 10px; text-align:center;width:70%">{{ $competicion->titulo }}</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            @endforeach
                        @endif
                    @endforeach
    
                    @if (!$hayCompeticiones)
                        <p style="background: #163b3d80; color:white; padding:1.5%; border-radius: 15px; font-size:120%; text-align:center;">Todavia no hay competiciones disponibles.</p>
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


    <br><br>
    <x-footer>

    </x-footer>

    </body>
</html>
