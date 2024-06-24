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
        
    <body class="ventanaModal">
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

        <section class="entrenadores">
            <section class="entrenadores_partes">
                <h2>ENTRENADOR</h2>
                <section class="entrenadores_solo">
                    <div class="row">
                        <div class="container text-center">
                            <img src="{{ asset('imagenes/' . auth()->user()->imagen) }}" width="220/2" height="290/2" title="{{ auth()->user()->nombre }}" style="border-radius: 20px;">
                            <h4 style="color:  #1b623a;">{{ auth()->user()->nombre }} {{ auth()->user()->primer_apellido }}</h4> 
                        </div>
                        
                        <div class="container d-flex justify-content-center">
                            <form action="{{ route('guardar-categoria') }}" method="POST" class="d-flex align-items-center">
                                @csrf
                                <input type="hidden" name="entrenador_id" value="{{ auth()->user()->id }}">
                                <select name="categoria_id" class="form-select" style="background-color: white; color: black; border-radius: 5px; padding: 6px; margin-bottom: 0; width: 180px; height: 35px;">
                                    @foreach ($categorias as $category)
                                        <option value="{{$category->id}}">{{$category->nombreCategoria}}</option>
                                    @endforeach
                                </select>
                                <button type="submit" class="btn" style="background-color: #ffffff; color: black; height: 35px; margin-bottom: 0; margin-left: 10px;">Añadir Categoria</button>
                            </form>
                        </div><br><br>
        
                        <div class="container text-center">
                            <div style="background:#163b3d80; padding: 2%; border-radius: 15px; width: 50vw; max-width: 400px; margin: 0 auto;">
                                @if (auth()->user()->categorias->isEmpty())
                                    <div class="text-center" style="font-weight: bold; color: white;"> 
                                        Este entrenador no tiene ninguna categoría asignada.
                                    </div>
                                @else
                                    @foreach (auth()->user()->categorias as $categoria)
                                        <div class="row py-1" style="display: flex; align-items: center;">
                                            <div class="col-md-8">
                                                <div class="text-center" style="font-weight: bold; color: white;"> 
                                                    {{ $categoria->nombreCategoria }}
                                                </div>
                                            </div>
                                            <div class="col-md-4 text-md-end">
                                                <button class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#confirmacionEliminarModal{{ $categoria->id }}">Eliminar</button>
                                            </div>
                                        </div>
                                    @endforeach
                                @endif
                            </div>
                        </div>
                                                
                    </div>
                </section>
            </section> 
        </section><br><br>
            
            @foreach (auth()->user()->categorias as $categoria)
                <div class="modal fade" id="confirmacionEliminarModal{{ $categoria->id }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Confirmar Eliminación</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <p>¿Estás seguro de que deseas eliminar esta categoría <strong>{{$categoria->nombreCategoria}}</strong>?</p>
                            </div>                            
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                                <form action="{{ route('eliminarRelacion', ['entrenador_id' => auth()->user()->id, 'categoria_id' => $categoria->id]) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger">Eliminar</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
            
            
            
    
        
        @if(session('error'))
            <script>
                window.onload = function() {
                    alert("{{ session('error') }}");
                }
            </script>
        @endif
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
