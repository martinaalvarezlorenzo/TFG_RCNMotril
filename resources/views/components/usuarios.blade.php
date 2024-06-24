@if(Auth::check())
    @php
        $imagen = 'imagenes/';
    @endphp
    @if(Auth::user()->tipo === 'Admin')
    <div class="avatar-info" style="display: flex; flex-direction: column; align-items: center;">
        <div class="btn-success dropstart bg-white" role="button" style="display: flex; flex-direction: column; align-items: center;">
            <button type="button" class="btn btn-success bg-white" data-bs-toggle="dropdown" aria-expanded="false">
                <div class="avatar" style="width: 50px; height: 50px; border-radius: 50%; overflow: hidden;">
                    <img src="{{ asset($imagen . Auth::user()->imagen) }}" alt="Foto de perfil" style="width: 100%; height: 100%; object-fit: cover; border-radius: 50%;">
                </div>
            </button>
            <ul class="dropdown-menu">
                <li><a class="dropdown-item" style="background-color: #1e8a4d; color:white;" href="{{route('administrador')}}">Funciones Administrador</a></li>
                <li><a class="dropdown-item" style="background-color:  #1e8a4d; color:white;" href="{{route('logout')}}">Cerrar Sesión</a></li>
            </ul>
            <p class="prueba" style="color: black;"> {{Auth::user()->username}}</p>

        </div>
    </div>
    @elseif (Auth::user()->tipo === 'Entrenador')
        <div class="avatar-info" style="display: flex; flex-direction: column; align-items: center;">
            <div class="btn-success dropstart bg-white" role="button" style="display: flex; flex-direction: column; align-items: center;">
                <button type="button" class="btn btn-success bg-white" data-bs-toggle="dropdown" aria-expanded="false">
                    <div class="avatar" style="width: 50px; height: 50px; border-radius: 50%; overflow: hidden;">
                        <img src="{{ asset($imagen . Auth::user()->imagen) }}" alt="Foto de perfil" style="width: 100%; height: 100%; object-fit: cover; border-radius: 50%;">
                    </div>
                </button>
                <ul class="dropdown-menu">
                    <li><a class="dropdown-item" style="background-color: #1e8a4d; color:white;" href="{{route('entrenador')}}">Funciones entrenador</a></li>
                    <li><a class="dropdown-item" style="background-color: #1e8a4d; color:white;" href="{{ route('editarPerfil', ['id' => Auth::user()->id]) }}">Editar perfil</a></li>
                    <li><a class="dropdown-item" style="background-color:  #1e8a4d; color:white;" href="{{route('logout')}}">Cerrar Sesión</a></li>
                </ul>

            </div>
            <p class="prueba" style="color: black;"> {{Auth::user()->username}}</p>
        </div>
    @else
    <div class="avatar-info" style="display: flex; flex-direction: column; align-items: center;">
        <div class="btn-success dropstart bg-white" role="button" style="display: flex; flex-direction: column; align-items: center;">
            <button type="button" class="btn btn-success bg-white" data-bs-toggle="dropdown" aria-expanded="false">
                <div class="avatar" style="width: 50px; height: 50px; border-radius: 50%; overflow: hidden;">
                    <img src="{{ asset($imagen . Auth::user()->imagen) }}" alt="Foto de perfil" style="width: 100%; height: 100%; object-fit: cover; border-radius: 50%;">
                </div>
            </button>
            <ul class="dropdown-menu">
                <li><a class="dropdown-item" style="background-color: #1e8a4d; color:white;" href="{{ route('editarPerfil', ['id' => Auth::user()->id]) }}">Editar perfil</a></li>
                <li><a class="dropdown-item" style="background-color: #1e8a4d; color:white;" href="{{route('logout')}}">Cerrar Sesión</a></li>
            </ul>

        </div>
        <p class="prueba" style="color: black;"> {{Auth::user()->username}}</p>
    </div>

    @endif
@else
    <!-- CUANDO NO ESTÁ REGISTRADO -->
    <form action="{{route('login')}}" method="GET">
        <button type="submit" class="btn btn-success">Acceder</button>
    </form>
@endif