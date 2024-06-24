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



        <div class="imgInstalaciones" style="margin-left: 2%; margin-right:2%;">
            <div class="juntosInstalaciones">
                <div class="cardI" onclick="window.location.href='#PREBENJAMIN'">
                    <a href="#PREBENJAMIN">
                        <div class="image-box">
                            <img src="{{ asset('imagenes/marti.JPG') }}" width="480" height="480">
                        </div>
                        <div class="content">
                            <h2>PREBENJAMÍN</h2>
                        </div>
                    </a>
                </div>
                <div class="cardI" onclick="window.location.href='#BENJAMIN'">
                    <a href="#BENJAMIN"> 
                        <div class="image-box">
                            <img src="{{ asset('imagenes/marti2.JPG') }}" width="480" height="480">
                        </div>
                        <div class="content">
                            <h2>BENJAMIN</h2>
                        </div>
                    </a>
                </div>
                <div class="cardI" onclick="window.location.href='#ALEVIN'">
                    <a href="#ALEVIN"> 
                        <div class="image-box">
                            <img src="{{ asset('imagenes/marti3.JPG') }}" width="480" height="480">
                        </div>
                        <div class="content">
                            <h2>ALEVIN</h2>
                        </div>
                    </a>
                </div>
                <div class="cardI" onclick="window.location.href='#INFANTIL'">
                    <a href="#INFANTIL"> 
                        <div class="image-box">
                            <img src="{{ asset('imagenes/marti4.JPG') }}" width="480" height="480">
                        </div>
                        <div class="content">
                            <h2>INFANTIL</h2>
                        </div>
                    </a>
                </div>
                <div class="cardI" onclick="window.location.href='#JUNABS'">
                    <a href="#JUNABS"> 
                        <div class="image-box">
                            <img src="{{ asset('imagenes/marti5.JPG') }}" width="480" height="480">
                        </div>
                        <div class="content">
                            <h2>JUNIORS-ABSOLUTOS</h2>
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
                .editar-container {
                    transition: transform 0.5s ease;
                    display: inline-block; 
                }
            
                .editar-container:hover {
                    transform: scale(1.12);
                }
            </style>
            
    
            <section id="PREBENJAMIN" class="materiales_partes">
                <h2>PREBENJAMÍN</h2>       
                <div class="d-flex justify-content-center" style="max-width: 100%; max-height:100%;">
                    <div class="row">
                        @php
                            $nadadoresEncontrados = false;
                        @endphp
                        
                        @foreach($categorias->where('categoria_id', 1)->chunk(3) as $chunk) 
                            @foreach($chunk as $categoria)
                                @foreach($nadadores as $nadador)
                                    @if($nadador->id === $categoria->entrenador_id)
                                        @php
                                            $nadadoresEncontrados = true;
                                        @endphp
                                        
                                        <div class="col-md-4 mb-4"  style="min-height: 20%; max-height:25%;">
                                            <div class="material-wrapper d-flex justify-content-center align-items-center">
                                                <div class="material" style="width: 60%;overflow: hidden; text-align:center;" >
                                                    <img src="{{ asset('imagenes/' . $nadador->imagen) }}" alt="{{ $nadador->nombre }}" class="img-fluid rounded" width="300" height="350" style="max-height: 350px; min-height:300px;">
                                                    <div style="background: #163b3d80; padding: 10px; height:20%;">
                                                        <a href="{{ route('editarPerfil', ['id'=> $nadador->id]) }}" class="ms-3 mb-0 editar-container" 
                                                            style="color: white; flex-grow: 1; text-decoration: none; font-size: 110%; display: inline-block;"> {{ $nadador->nombre }} {{ $nadador->primer_apellido }} {{ $nadador->segundo_apellido }} </a><br>
                                                        <button style="vertical-align: center; margin-top:3%; margin-buttom:5%;" type="button" class="btn btn-danger"
                                                         data-bs-toggle="modal" data-bs-target="#confirmacionEliminarModal{{ $nadador->id }}">Eliminar</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                        
                                        <!-- Modal -->
                                        <div class="modal fade" id="confirmacionEliminarModal{{ $nadador->id }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="exampleModalLabel">Confirmar Eliminación</h5>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <p>¿Estás seguro de que deseas eliminar a <span style="font-weight: bold;">{{ $nadador->nombre }} {{ $nadador->primer_apellido }}</span>?</p>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                                                        <form action="{{ route('eliminar_nadadores', $nadador->id) }}" method="POST">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="submit" class="btn btn-danger">Eliminar</button>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @endif
                                @endforeach
                            @endforeach
                        @endforeach
            
                        @if(!$nadadoresEncontrados)
                            <div class="col-md-12">
                                <p style="background: #163b3d80; color:white; padding:1.5%; border-radius: 15px; font-size:120%; text-align:center;">No hay nadadores en esta categoría.</p>
                            </div>
                        @endif
                    </div>
                </div>
            </section>
            

            <section id="BENJAMIN" class="materiales_partes">
                <h2>BENJAMÍN</h2>       
                <div class="d-flex justify-content-center" style="max-width: 100%; max-height:100%;">
                    <div class="row">
                        @php
                            $nadadoresEncontrados = false;
                        @endphp
                        
                        @foreach($categorias->where('categoria_id', 2)->chunk(3) as $chunk) 
                            @foreach($chunk as $categoria)
                                @foreach($nadadores as $nadador)
                                    @if($nadador->id === $categoria->entrenador_id)
                                        @php
                                            $nadadoresEncontrados = true;
                                        @endphp
                                        
                                        <div class="col-md-4 mb-4"  style="min-height: 20%; max-height:25%;">
                                            <div class="material-wrapper d-flex justify-content-center align-items-center">
                                                <div class="material" style="width: 60%;overflow: hidden; text-align:center;" >
                                                    <img src="{{ asset('imagenes/' . $nadador->imagen) }}" alt="{{ $nadador->nombre }}" class="img-fluid rounded" width="300" height="350" style="max-height: 350px; min-height:300px;">
                                                    <div style="background: #163b3d80; padding: 10px; height:20%;">
                                                        <a href="{{ route('editarPerfil', ['id'=> $nadador->id]) }}" class="ms-3 mb-0 editar-container" style="color: white; flex-grow: 1; text-decoration: none; font-size: 110%; display: inline-block;"> {{ $nadador->nombre }} {{ $nadador->primer_apellido }} {{ $nadador->segundo_apellido }} </a><br>
                                                        <button style="vertical-align: center; margin-top:3%; margin-buttom:5%;" type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#confirmacionEliminarModal{{ $nadador->id }}">Eliminar</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                        
                                        <!-- Modal -->
                                        <div class="modal fade" id="confirmacionEliminarModal{{ $nadador->id }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="exampleModalLabel">Confirmar Eliminación</h5>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <p>¿Estás seguro de que deseas eliminar a <span style="font-weight: bold;">{{ $nadador->nombre }} {{ $nadador->primer_apellido }}</span>?</p>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                                                        <form action="{{ route('eliminar_nadadores', $nadador->id) }}" method="POST">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="submit" class="btn btn-danger">Eliminar</button>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @endif
                                @endforeach
                            @endforeach
                        @endforeach
            
                        @if(!$nadadoresEncontrados)
                            <div class="col-md-12">
                                <p style="background: #163b3d80; color:white; padding:1.5%; border-radius: 15px; font-size:120%; text-align:center;">No hay nadadores en esta categoría.</p>
                            </div>
                        @endif
                    </div>
                </div>
            </section>

            <section id="ALEVIN" class="materiales_partes">
                <h2>ALEVÍN</h2>       
                <div class="d-flex justify-content-center" style="max-width: 100%; max-height:100%;">
                    <div class="row">
                        @php
                            $nadadoresEncontrados = false;
                        @endphp
                        
                        @foreach($categorias->where('categoria_id', 3)->chunk(3) as $chunk) 
                            @foreach($chunk as $categoria)
                                @foreach($nadadores as $nadador)
                                    @if($nadador->id === $categoria->entrenador_id)
                                        @php
                                            $nadadoresEncontrados = true;
                                        @endphp
                                        
                                        <div class="col-md-4 mb-4"  style="min-height: 20%; max-height:25%;">
                                            <div class="material-wrapper d-flex justify-content-center align-items-center">
                                                <div class="material" style="width: 60%;overflow: hidden; text-align:center;" >
                                                    <img src="{{ asset('imagenes/' . $nadador->imagen) }}" alt="{{ $nadador->nombre }}" class="img-fluid rounded" width="300" height="350" style="max-height: 350px; min-height:300px;">
                                                    <div style="background: #163b3d80; padding: 10px; height:20%;">
                                                        <a href="{{ route('editarPerfil', ['id'=> $nadador->id]) }}" class="ms-3 mb-0 editar-container" style="color: white; flex-grow: 1; text-decoration: none; font-size: 110%; display: inline-block;"> {{ $nadador->nombre }} {{ $nadador->primer_apellido }} {{ $nadador->segundo_apellido }} </a><br>
                                                        <button style="vertical-align: center; margin-top:3%; margin-buttom:5%;" type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#confirmacionEliminarModal{{ $nadador->id }}">Eliminar</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                        
                                        <!-- Modal -->
                                        <div class="modal fade" id="confirmacionEliminarModal{{ $nadador->id }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="exampleModalLabel">Confirmar Eliminación</h5>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <p>¿Estás seguro de que deseas eliminar a <span style="font-weight: bold;">{{ $nadador->nombre }} {{ $nadador->primer_apellido }}</span>?</p>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                                                        <form action="{{ route('eliminar_nadadores', $nadador->id) }}" method="POST">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="submit" class="btn btn-danger">Eliminar</button>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @endif
                                @endforeach
                            @endforeach
                        @endforeach
            
                        @if(!$nadadoresEncontrados)
                            <div class="col-md-12">
                                <p style="background: #163b3d80; color:white; padding:1.5%; border-radius: 15px; font-size:120%; text-align:center;">No hay nadadores en esta categoría.</p>
                            </div>
                        @endif
                    </div>
                </div>
            </section>

            <section id="INFANTIL" class="materiales_partes">
                <h2>INFANTIL</h2>       
                <div class="d-flex justify-content-center" style="max-width: 100%; max-height:100%;">
                    <div class="row">
                        @php
                            $nadadoresEncontrados = false;
                        @endphp
                        
                        @foreach($categorias->where('categoria_id', 4)->chunk(3) as $chunk) 
                            @foreach($chunk as $categoria)
                                @foreach($nadadores as $nadador)
                                    @if($nadador->id === $categoria->entrenador_id)
                                        @php
                                            $nadadoresEncontrados = true;
                                        @endphp
                                        
                                        <div class="col-md-4 mb-4"  style="min-height: 20%; max-height:25%;">
                                            <div class="material-wrapper d-flex justify-content-center align-items-center">
                                                <div class="material" style="width: 60%;overflow: hidden; text-align:center;" >
                                                    <img src="{{ asset('imagenes/' . $nadador->imagen) }}" alt="{{ $nadador->nombre }}" class="img-fluid rounded" width="300" height="350" style="max-height: 350px; min-height:300px;">
                                                    <div style="background: #163b3d80; padding: 10px; height:20%;">
                                                        <a href="{{ route('editarPerfil', ['id'=> $nadador->id]) }}" class="ms-3 mb-0 editar-container" style="color: white; flex-grow: 1; text-decoration: none; font-size: 110%; display: inline-block;"> {{ $nadador->nombre }} {{ $nadador->primer_apellido }} {{ $nadador->segundo_apellido }} </a><br>
                                                        <button style="vertical-align: center; margin-top:3%; margin-buttom:5%;" type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#confirmacionEliminarModal{{ $nadador->id }}">Eliminar</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                        
                                        <!-- Modal -->
                                        <div class="modal fade" id="confirmacionEliminarModal{{ $nadador->id }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="exampleModalLabel">Confirmar Eliminación</h5>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <p>¿Estás seguro de que deseas eliminar a <span style="font-weight: bold;">{{ $nadador->nombre }} {{ $nadador->primer_apellido }}</span>?</p>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                                                        <form action="{{ route('eliminar_nadadores', $nadador->id) }}" method="POST">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="submit" class="btn btn-danger">Eliminar</button>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @endif
                                @endforeach
                            @endforeach
                        @endforeach
            
                        @if(!$nadadoresEncontrados)
                            <div class="col-md-12">
                                <p style="background: #163b3d80; color:white; padding:1.5%; border-radius: 15px; font-size:120%; text-align:center;">No hay nadadores en esta categoría.</p>
                            </div>
                        @endif
                    </div>
                </div>
            </section>
            <section id="JUNABS" class="materiales_partes">
                <h2>JUNIORS-ABSOLUTOS</h2>       
                <div class="d-flex justify-content-center" style="max-width: 100%; max-height:100%;">
                    <div class="row">
                        @php
                            $nadadoresEncontrados = false;
                        @endphp
                        
                        @foreach($categorias->where('categoria_id', 5)->chunk(3) as $chunk) 
                            @foreach($chunk as $categoria)
                                @foreach($nadadores as $nadador)
                                    @if($nadador->id === $categoria->entrenador_id && $nadador->estado ===1)
                                        @php
                                            $nadadoresEncontrados = true;
                                        @endphp
                                        
                                        <div class="col-md-4 mb-4"  style="min-height: 20%; max-height:25%;">
                                            <div class="material-wrapper d-flex justify-content-center align-items-center">
                                                <div class="material" style="width: 60%;overflow: hidden; text-align:center;" >
                                                    <img src="{{ asset('imagenes/' . $nadador->imagen) }}" alt="{{ $nadador->nombre }}" class="img-fluid rounded" width="300" height="350" style="max-height: 350px; min-height:300px;">
                                                    <div style="background: #163b3d80; padding: 10px; height:20%;">
                                                        <a href="{{ route('editarPerfil', ['id'=> $nadador->id]) }}" class="ms-3 mb-0 editar-container" style="color: white; flex-grow: 1; text-decoration: none; font-size: 110%; display: inline-block;"> {{ $nadador->nombre }} {{ $nadador->primer_apellido }} {{ $nadador->segundo_apellido }} </a><br>
                                                        <button style="vertical-align: center; margin-top:5%; margin-buttom:5%;" type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#confirmacionEliminarModal{{ $nadador->id }}">Eliminar</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                        
                                        <!-- Modal -->
                                        <div class="modal fade" id="confirmacionEliminarModal{{ $nadador->id }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="exampleModalLabel">Confirmar Eliminación</h5>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <p>¿Estás seguro de que deseas eliminar a <span style="font-weight: bold;">{{ $nadador->nombre }} {{ $nadador->primer_apellido }}</span>?</p>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                                                        <form action="{{ route('eliminar_nadadores', $nadador->id) }}" method="POST">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="submit" class="btn btn-danger">Eliminar</button>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @endif
                                @endforeach
                            @endforeach
                        @endforeach
            
                        @if(!$nadadoresEncontrados)
                            <div class="col-md-12">
                                <p style="background: #163b3d80; color:white; padding:1.5%; border-radius: 15px; font-size:120%; text-align:center;">No hay nadadores en esta categoría.</p>
                            </div>
                        @endif
                    </div>
                </div>
            </section>
            
            
            
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
