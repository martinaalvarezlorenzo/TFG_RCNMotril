<!doctype html>
    <html lang="es">

    <head>
        <title>Real Club Náutico de Motril - Página principal</title>
        <meta charset="UTF-8">
        <link rel="stylesheet" type="text/css" href="{{ asset('css/index.css') }}">
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
                  body {
                        background-image: url("{{asset('imagenes/piscina.jpg')}}");
                    }


                </style>
        
                    <x-usuarios>

                    </x-usuarios>
            
            </section>
        
            <x-menu>

            </x-menu>
        </header>
        <div class="imgInstalaciones">
            <div class="juntosInstalaciones">
                <div class="cardI" onclick="window.location.href='#GORROGAFA'">
                    <a href="#GORROGAFA">
                        <div class="image-box">
                            <img src="imagenes/gorrosygafas.jpeg" width="480" height="480">
                        </div>
                        <div class="content">
                            <h2>GORROS Y GAFAS</h2>
                        </div>
                    </a>
                </div>
                <div class="cardI" onclick="window.location.href='#BAÑADORESFASTKIN'">
                    <a href="#BAÑADORESFASTKIN"> 
                        <div class="image-box">
                            <img src="imagenes/bañadores.png" width="480" height="480">
                        </div>
                        <div class="content">
                            <h2>BAÑADORES Y FASTIN</h2>
                        </div>
                    </a>
                </div>
                <div class="cardI" onclick="window.location.href='#MATERIALESAUXILIARES'">
                    <a href="#MATERIALESAUXILIARES"> 
                        <div class="image-box">
                            <img src="imagenes/materiales auxiliares.jpg" width="480" height="480">
                        </div>
                        <div class="content">
                            <h2>MATERIALES AUXILIARES</h2>
                        </div>
                    </a>
                </div>
            </div>
        </div>

        <style>
            .material {
                height: 600px; 
                overflow: hidden; 
            }
        </style>
        

         <section id="GORROGAFA" class="materiales_partes">
            <h2>GORROS Y GAFAS</h2>    
            @if($materiales->where('tipo', 1)->isEmpty())
                <div>
                    <p style="background: #163b3d80; color:white; padding:1.5%; border-radius: 15px; font-size:120%; text-align:center;">No hay materiales disponibles en este momento.</p>
                </div>
            @else   
                @foreach($materiales->where('tipo', 1)->chunk(3) as $chunk) 
                <div class="d-flex justify-content-center" style="max-width: 100%; max-heigth:100%;">
                    <div class="row">
                        @foreach($chunk as $key => $material)
                            <div class="col-md-4 mb-4 @if ($key == 2) mat-below-left @endif">
                                <div class="material-wrapper d-flex justify-content-center align-items-center">
                                    <div class="material" style="width: 60%;overflow: hidden; text-align:center;" >
                                        <img src="{{ asset('imagenes/' . $material->imagen) }}" alt="{{ $material->nombre }}" class="img-fluid rounded" width="300" height="300">
                                        <div style="background: #163b3d80; padding: 10px;">
                                            <h5 style="color: white;">{{ $material->nombre }}</h5>
                                            <div class="d-flex justify-content-center align-items-center" style="text-align:center; color:white;">
                                                <p class="precio" style="margin-right: 10px;">{{ $material->precio }} €</p>
                                                <p class="marca">{{ $material->marca }}</p>
                                            </div>
                                            <h5><a href="{{ $material->enlace }}" style="text-decoration: none; color:black;" class="btn btn-light">Enlace página oficial</a></h5>
                                        </div>
                                    </div>
                                    
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
                @endforeach
            @endif
        </section>
        <section id="BAÑADORESFASTKIN" class="materiales_partes">
            <h2>BAÑADORES Y FASTKIN</h2>     
            @if($materiales->where('tipo', 2)->isEmpty())
                <div>
                    <p style="background: #163b3d80; color:white; padding:1.5%; border-radius: 15px; font-size:120%; text-align:center;">No hay materiales disponibles en este momento.</p>
                </div>
            @else  
                @foreach($materiales->where('tipo', 2)->chunk(3) as $chunk) 
                <div class="d-flex justify-content-center" style="width: 100%; heigth:100%;">
                    <div class="row">
                        @foreach($chunk as $key => $material)
                            <div class="col-md-4 mb-4 @if ($key == 2) mat-below-left @endif">
                                <div class="material-wrapper d-flex justify-content-center align-items-center">
                                    <div class="material" style="width: 60%;overflow: hidden; text-align:center;" >
                                        <img src="{{ asset('imagenes/' . $material->imagen) }}" alt="{{ $material->nombre }}" class="img-fluid rounded" width="300" height="300">
                                        <div style="background: #163b3d80; padding: 10px;">
                                            <h6 style="color: white;">{{ $material->nombre }}</h6>
                                            <div class="d-flex justify-content-center align-items-center" style="text-align:center; color:white;">
                                                <p class="precio" style="margin-right: 10px;">{{ $material->precio }} €</p>
                                                <p class="marca">{{ $material->marca }}</p>
                                            </div>
                                            <h5><a href="{{ $material->enlace }}" style="text-decoration: none; color:black;" class="btn btn-light">Enlace página oficial</a></h5>
                                        </div>
                                    </div>
                                    
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
                @endforeach
            @endif
        </section>
        <section id="MATERIALESAUXILIARES" class="materiales_partes">
            <h2>MATERIALES AUXILIARES</h2>
            
            @if($materiales->where('tipo', 3)->isEmpty())
                <div>
                    <p style="background: #163b3d80; color:white; padding:1.5%; border-radius: 15px; font-size:120%; text-align:center;">No hay materiales disponibles en este momento.</p>
                </div>
            @else
                @foreach($materiales->where('tipo', 3)->chunk(3) as $chunk) 
                    <div class="d-flex justify-content-center" style="width: 100%; heigth:100%;">
                        <div class="row">
                            @foreach($chunk as $key => $material)
                                <div class="col-md-4 mb-4 @if ($key == 2) mat-below-left @endif">
                                    <div class="material-wrapper d-flex justify-content-center align-items-center">
                                        <div class="material" style="width: 60%;overflow: hidden; text-align:center;" >
                                            <img src="{{ asset('imagenes/' . $material->imagen) }}" alt="{{ $material->nombre }}" class="img-fluid rounded" width="300" height="300">
                                            <div style="background: #163b3d80; padding: 15px;">
                                                <h5 style="color: white;">{{ $material->nombre }}</h5>
                                                <div class="d-flex justify-content-center align-items-center" style="text-align:center; color:white;">
                                                    <p class="precio" style="margin-right: 10px;">{{ $material->precio }} €</p>
                                                    <p class="marca">{{ $material->marca }}</p>
                                                </div>
                                                <h5><a href="{{ $material->enlace }}" style="text-decoration: none; color:black;" class="btn btn-light">Enlace página oficial</a></h5>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                @endforeach
            @endif
        </section>
        
    
    <style>
        .material img {
            width: 350px; 
            height: 350px; 
        }

        .material-wrapper {
            width: 100%;
            display: flex; 
            flex-direction: column; 
            align-items: center;
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