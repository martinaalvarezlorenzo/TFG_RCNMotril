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
                            $hayHorario = false;
                        @endphp
            
                        @foreach ($categorias as $categoria)
                            @php
                                $encontrado = false;
                                $horarioDeLaSemana = null;
                                $fechaEntreno = null; 
                            @endphp
            
                            @foreach ($horarios as $horario)
                                @if ($horario->categoria_id == $categoria->categoria_id && $categoria->entrenador_id == Auth::user()->id)
                                    @php
                                        $fechaEntreno = \Carbon\Carbon::createFromFormat('Y-m-d', $horario->semana);
                                        $fechaSabado = $fechaEntreno->copy()->endOfWeek(); 
            
                                        $hoy = now();
                                        if ($hoy->between($fechaEntreno, $fechaSabado)) {
                                            $horarioDeLaSemana = $horario;
                                            $encontrado = true;
                                            $hayHorario = true;
                                            break; 
                                        }
                                    @endphp
                                @endif
                            @endforeach
            
                            @if ($encontrado && $horarioDeLaSemana)
                                @foreach ($misCategorias as $miCategoria)
                                    @if ($miCategoria->id === $categoria->categoria_id)
                                        <h4 style="text-align: center; align-items:center; color: #29733c; margin-bottom: 20px; margin-top:20px;">HORARIO {{$miCategoria->nombreCategoria}}</h4>
                                    @endif
                                @endforeach
                                <div class="table-responsive">
                                    <table id="tabla" class="text-center" style="color: white; background:#163b3d80; border-radius: 15px; width:90%; padding:2%; text-align:center; align-items:center;">
                                        <thead>
                                            <tr>
                                                <th colspan="2" style="font-size: 20px; padding-bottom: 20px; padding-top: 20px;">Semana: {{$fechaEntreno->format('d/m/Y')}} - {{$fechaSabado->format('d/m/Y')}}</th>
                                            </tr>
                                            <tr>
                                                <th style="font-size: 18px;">Día</th>
                                                <th style="font-size: 18px;">Hora</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr style="border-top: 1px solid white;">
                                                <td style="font-size: 16px; padding: 10px;">Lunes</td>
                                                <td style="font-size: 16px; padding: 10px;">{{$horarioDeLaSemana->horarioLunes}}</td>
                                            </tr>
                                            <tr style="border-top: 1px solid white;">
                                                <td style="font-size: 16px; padding: 10px;">Martes</td>
                                                <td style="font-size: 16px; padding: 10px;">{{$horarioDeLaSemana->horarioMartes}}</td>
                                            </tr>
                                            <tr style="border-top: 1px solid white;">
                                                <td style="font-size: 16px; padding: 10px;">Miércoles</td>
                                                <td style="font-size: 16px; padding: 10px;">{{$horarioDeLaSemana->horarioMiercoles}}</td>
                                            </tr>
                                            <tr style="border-top: 1px solid white;">
                                                <td style="font-size: 16px; padding: 10px;">Jueves</td>
                                                <td style="font-size: 16px; padding: 10px;">{{$horarioDeLaSemana->horarioJueves}}</td>
                                            </tr>
                                            <tr style="border-top: 1px solid white;">
                                                <td style="font-size: 16px; padding: 10px;">Viernes</td>
                                                <td style="font-size: 16px; padding: 10px;">{{$horarioDeLaSemana->horarioViernes}}</td>
                                            </tr>
                                            <tr style="border-top: 1px solid white;">
                                                <td style="font-size: 16px; padding: 10px;">Sabado</td>
                                                <td style="font-size: 16px; padding: 10px;">{{$horarioDeLaSemana->horarioSabado}}</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            @endif
                        @endforeach
            
                        @if (!$hayHorario)
                            <p style="background: #163b3d80; color:white; padding:1.5%; border-radius: 15px; font-size:120%; text-align:center;">No hay horarios para esta semana.</p>
                        @endif
                    </div>
                </div>
            </div>
            
            @elseif (Auth::user()->tipo === 'Nadador')
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-md-6">
                        @php
                            $hayHorario = false;
                        @endphp
            
                        @foreach ($categorias as $categoria)
                            @php
                                $encontrado = false;
                                $horarioDeLaSemana = null;
                                $fechaEntreno = null; 
                            @endphp
            
                            @foreach ($horarios as $horario)
                                @if ($horario->categoria_id == $categoria->categoria_id && $categoria->entrenador_id == Auth::user()->id)
                                    @php
                                        $fechaEntreno = \Carbon\Carbon::createFromFormat('Y-m-d', $horario->semana);
                                        $fechaSabado = $fechaEntreno->copy()->endOfWeek(); 
            
                                        $hoy = now();
                                        if ($hoy->between($fechaEntreno, $fechaSabado)) {
                                            $horarioDeLaSemana = $horario;
                                            $encontrado = true;
                                            $hayHorario = true;
                                            break; 
                                        }
                                    @endphp
                                @endif
                            @endforeach
            
                            @if ($encontrado && $horarioDeLaSemana)
                                @foreach ($misCategorias as $miCategoria)
                                    @if ($miCategoria->id === $categoria->categoria_id)
                                        <h4 style="text-align: center; align-items:center; color: #29733c; margin-bottom: 20px; margin-top:20px;">HORARIO {{$miCategoria->nombreCategoria}}</h4>
                                    @endif
                                @endforeach
                                <div class="table-responsive">
                                    <table id="tabla" class="text-center" style="color: white; background:#163b3d80; border-radius: 15px; width:90%; padding:2%; text-align:center; align-items:center;">
                                        <thead>
                                            <tr>
                                                <th colspan="2" style="font-size: 20px; padding-bottom: 20px; padding-top: 20px;">Semana: {{$fechaEntreno->format('d/m/Y')}} - {{$fechaSabado->format('d/m/Y')}}</th>
                                            </tr>
                                            <tr>
                                                <th style="font-size: 18px;">Día</th>
                                                <th style="font-size: 18px;">Hora</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr style="border-top: 1px solid white;">
                                                <td style="font-size: 16px; padding: 10px;">Lunes</td>
                                                <td style="font-size: 16px; padding: 10px;">{{$horarioDeLaSemana->horarioLunes}}</td>
                                            </tr>
                                            <tr style="border-top: 1px solid white;">
                                                <td style="font-size: 16px; padding: 10px;">Martes</td>
                                                <td style="font-size: 16px; padding: 10px;">{{$horarioDeLaSemana->horarioMartes}}</td>
                                            </tr>
                                            <tr style="border-top: 1px solid white;">
                                                <td style="font-size: 16px; padding: 10px;">Miércoles</td>
                                                <td style="font-size: 16px; padding: 10px;">{{$horarioDeLaSemana->horarioMiercoles}}</td>
                                            </tr>
                                            <tr style="border-top: 1px solid white;">
                                                <td style="font-size: 16px; padding: 10px;">Jueves</td>
                                                <td style="font-size: 16px; padding: 10px;">{{$horarioDeLaSemana->horarioJueves}}</td>
                                            </tr>
                                            <tr style="border-top: 1px solid white;">
                                                <td style="font-size: 16px; padding: 10px;">Viernes</td>
                                                <td style="font-size: 16px; padding: 10px;">{{$horarioDeLaSemana->horarioViernes}}</td>
                                            </tr>
                                            <tr style="border-top: 1px solid white;">
                                                <td style="font-size: 16px; padding: 10px;">Sabado</td>
                                                <td style="font-size: 16px; padding: 10px;">{{$horarioDeLaSemana->horarioSabado}}</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            @endif
                        @endforeach
            
                        @if (!$hayHorario)
                            <p style="background: #163b3d80; color:white; padding:1.5%; border-radius: 15px; font-size:120%; text-align:center;">No hay horarios para esta semana.</p>
                        @endif
                    </div>
                </div>
            </div>

            @else
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-md-6">
                        @php
                            $hayHorario = false;
                            $categoriasConHorario = [];
                        @endphp
            
                        @foreach ($categorias as $categoria)
                            @php
                                if (in_array($categoria->categoria_id, $categoriasConHorario)) {
                                    continue; 
                                }
            
                                $encontrado = false;
                                $horarioDeLaSemana = null;
                                $fechaEntreno = null; 
                            @endphp
            
                            @foreach ($horarios as $horario)
                                @if ($horario->categoria_id == $categoria->categoria_id)
                                    @php
                                        $fechaEntreno = \Carbon\Carbon::createFromFormat('Y-m-d', $horario->semana);
                                        $fechaSabado = $fechaEntreno->copy()->endOfWeek(); 
            
                                        $hoy = now();
                                        if ($hoy->between($fechaEntreno, $fechaSabado)) {
                                            $horarioDeLaSemana = $horario;
                                            $encontrado = true;
                                            $hayHorario = true;
                                            $categoriasConHorario[] = $categoria->categoria_id;
                                            break; 
                                        }
                                    @endphp
                                @endif
                            @endforeach
            
                            @if ($encontrado && $horarioDeLaSemana)
                                @foreach ($misCategorias as $miCategoria)
                                    @if ($miCategoria->id === $categoria->categoria_id)
                                        <h4 style="text-align: center; align-items:center; color: #29733c; margin-bottom: 20px; margin-top:20px;">HORARIO {{$miCategoria->nombreCategoria}}</h4>
                                    @endif    
                                    @endforeach 
                                <div class="table-responsive">
                                    <table id="tabla" class="text-center" style="color: white; background:#163b3d80; border-radius: 15px; width:90%; padding:2%; text-align:center; align-items:center;">
                                        <thead>
                                            <tr>
                                                <th colspan="2" style="font-size: 20px; padding-bottom: 20px; padding-top: 20px;">Semana: {{$fechaEntreno->format('d/m/Y')}} - {{$fechaSabado->format('d/m/Y')}}</th>
                                            </tr>
                                            <tr>
                                                <th style="font-size: 18px;">Día</th>
                                                <th style="font-size: 18px;">Hora</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr style="border-top: 1px solid white;">
                                                <td style="font-size: 16px; padding: 10px;">Lunes</td>
                                                <td style="font-size: 16px; padding: 10px;">{{$horarioDeLaSemana->horarioLunes}}</td>
                                            </tr>
                                            <tr style="border-top: 1px solid white;">
                                                <td style="font-size: 16px; padding: 10px;">Martes</td>
                                                <td style="font-size: 16px; padding: 10px;">{{$horarioDeLaSemana->horarioMartes}}</td>
                                            </tr>
                                            <tr style="border-top: 1px solid white;">
                                                <td style="font-size: 16px; padding: 10px;">Miércoles</td>
                                                <td style="font-size: 16px; padding: 10px;">{{$horarioDeLaSemana->horarioMiercoles}}</td>
                                            </tr>
                                            <tr style="border-top: 1px solid white;">
                                                <td style="font-size: 16px; padding: 10px;">Jueves</td>
                                                <td style="font-size: 16px; padding: 10px;">{{$horarioDeLaSemana->horarioJueves}}</td>
                                            </tr>
                                            <tr style="border-top: 1px solid white;">
                                                <td style="font-size: 16px; padding: 10px;">Viernes</td>
                                                <td style="font-size: 16px; padding: 10px;">{{$horarioDeLaSemana->horarioViernes}}</td>
                                            </tr>
                                            <tr style="border-top: 1px solid white;">
                                                <td style="font-size: 16px; padding: 10px;">Sábado</td>
                                                <td style="font-size: 16px; padding: 10px;">{{$horarioDeLaSemana->horarioSabado}}</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            @endif
                        @endforeach
            
                        @if (!$hayHorario)
                            <p style="background: #163b3d80; color:white; padding:1.5%; border-radius: 15px; font-size:120%; text-align:center;">No hay horarios para esta semana.</p>
                        @endif
                    </div>
                </div>
            </div>
            @endif        
        @else
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-6">
                    @php
                        $hayHorario = false;
                        $categoriasConHorario = [];
                    @endphp
        
                    @foreach ($categorias as $categoria)
                        @php
                            if (in_array($categoria->categoria_id, $categoriasConHorario)) {
                                continue; 
                            }
        
                            $encontrado = false;
                            $horarioDeLaSemana = null;
                            $fechaEntreno = null; 
                        @endphp
        
                        @foreach ($horarios as $horario)
                            @if ($horario->categoria_id == $categoria->categoria_id)
                                @php
                                    $fechaEntreno = \Carbon\Carbon::createFromFormat('Y-m-d', $horario->semana);
                                    $fechaSabado = $fechaEntreno->copy()->endOfWeek(); 
        
                                    $hoy = now();
                                    if ($hoy->between($fechaEntreno, $fechaSabado)) {
                                        $horarioDeLaSemana = $horario;
                                        $encontrado = true;
                                        $hayHorario = true;
                                        $categoriasConHorario[] = $categoria->categoria_id;
                                        break; 
                                    }
                                @endphp
                            @endif
                        @endforeach
        
                        @if ($encontrado && $horarioDeLaSemana)
                            @foreach ($misCategorias as $miCategoria)
                                @if ($miCategoria->id === $categoria->categoria_id)
                                    <h4 style="text-align: center; align-items:center; color: #29733c; margin-bottom: 20px; margin-top:20px;">HORARIO {{$miCategoria->nombreCategoria}}</h4>
                                @endif    
                                @endforeach 
                            <div class="table-responsive">
                                <table id="tabla" class="text-center" style="color: white; background:#163b3d80; border-radius: 15px; width:90%; padding:2%; text-align:center; align-items:center;">
                                    <thead>
                                        <tr>
                                            <th colspan="2" style="font-size: 20px; padding-bottom: 20px; padding-top: 20px;">Semana: {{$fechaEntreno->format('d/m/Y')}} - {{$fechaSabado->format('d/m/Y')}}</th>
                                        </tr>
                                        <tr>
                                            <th style="font-size: 18px;">Día</th>
                                            <th style="font-size: 18px;">Hora</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr style="border-top: 1px solid white;">
                                            <td style="font-size: 16px; padding: 10px;">Lunes</td>
                                            <td style="font-size: 16px; padding: 10px;">{{$horarioDeLaSemana->horarioLunes}}</td>
                                        </tr>
                                        <tr style="border-top: 1px solid white;">
                                            <td style="font-size: 16px; padding: 10px;">Martes</td>
                                            <td style="font-size: 16px; padding: 10px;">{{$horarioDeLaSemana->horarioMartes}}</td>
                                        </tr>
                                        <tr style="border-top: 1px solid white;">
                                            <td style="font-size: 16px; padding: 10px;">Miércoles</td>
                                            <td style="font-size: 16px; padding: 10px;">{{$horarioDeLaSemana->horarioMiercoles}}</td>
                                        </tr>
                                        <tr style="border-top: 1px solid white;">
                                            <td style="font-size: 16px; padding: 10px;">Jueves</td>
                                            <td style="font-size: 16px; padding: 10px;">{{$horarioDeLaSemana->horarioJueves}}</td>
                                        </tr>
                                        <tr style="border-top: 1px solid white;">
                                            <td style="font-size: 16px; padding: 10px;">Viernes</td>
                                            <td style="font-size: 16px; padding: 10px;">{{$horarioDeLaSemana->horarioViernes}}</td>
                                        </tr>
                                        <tr style="border-top: 1px solid white;">
                                            <td style="font-size: 16px; padding: 10px;">Sábado</td>
                                            <td style="font-size: 16px; padding: 10px;">{{$horarioDeLaSemana->horarioSabado}}</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        @endif
                    @endforeach
        
                    @if (!$hayHorario)
                        <p style="background: #163b3d80; color:white; padding:1.5%; border-radius: 15px; font-size:120%; text-align:center;">No hay horarios para esta semana.</p>
                    @endif
                </div>
            </div>
        </div>
        @endif

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
