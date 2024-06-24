@if(Auth::check())
    @if(Auth::user()->tipo === 'Admin')
    <ul class="menu">
        <li>
        <a href="{{route('index')}}">Inicio<span class="border border-top"></span>
            <span class="border border-right"></span>
            <span class="border border-bottom"></span>
            <span class="border border-left"></span>
        </a> 
        </li>
        <li>
            <a href="{{route('horarios')}}">Horarios<span class="border border-top"></span>
                <span class="border border-right"></span>
                <span class="border border-bottom"></span>
                <span class="border border-left"></span>
            </a>  
        </li>
        <li>
            <a href="{{route('materiales')}}">Materiales
                <span class="border border-top"></span>
                <span class="border border-right"></span>
                <span class="border border-bottom"></span>
                <span class="border border-left"></span>
            </a> 
        </li>
        <li>
            <a href="{{route('competicionesCualquiera')}}">Calendario de Competición
                <span class="border border-top"></span>
                <span class="border border-right"></span>
                <span class="border border-bottom"></span>
                <span class="border border-left"></span>
            </a>
        </li>
        <li>
            <a href="{{route('informacion')}}">Información
                <span class="border border-top"></span>
                <span class="border border-right"></span>
                <span class="border border-bottom"></span>
                <span class="border border-left"></span>
            </a>
        </li>
        <li>
            <a href="{{route('verEliminarEntrenadores')}}">Ver Entrenadores
                <span class="border border-top"></span>
                <span class="border border-right"></span>
                <span class="border border-bottom"></span>
                <span class="border border-left"></span>
            </a>
        </li>
        <li>
            <a href="{{route('codigosQR')}}">Grupos de WhatsApp
                <span class="border border-top"></span>
                <span class="border border-right"></span>
                <span class="border border-bottom"></span>
                <span class="border border-left"></span>
            </a>
        </li>
    </ul>
    

    @elseif (Auth::user()->tipo === 'Entrenador')
    <ul class="menu">
        <li>
        <a href="{{route('index')}}">Inicio<span class="border border-top"></span>
            <span class="border border-right"></span>
            <span class="border border-bottom"></span>
            <span class="border border-left"></span>
        </a> 
        </li>
        <li>
            <a href="{{route('horarios')}}">Horarios<span class="border border-top"></span>
                <span class="border border-right"></span>
                <span class="border border-bottom"></span>
                <span class="border border-left"></span>
            </a>  
        </li>
        <li>
            <a href="{{route('materiales')}}">Materiales
                <span class="border border-top"></span>
                <span class="border border-right"></span>
                <span class="border border-bottom"></span>
                <span class="border border-left"></span>
            </a> 
        </li>
        <li>
            <a href="{{route('competiciones')}}">Calendario de Competición
                <span class="border border-top"></span>
                <span class="border border-right"></span>
                <span class="border border-bottom"></span>
                <span class="border border-left"></span>
            </a>
        </li>
        <li>
            <a href="{{route('entrenamientos')}}">Entrenamientos
                <span class="border border-top"></span>
                <span class="border border-right"></span>
                <span class="border border-bottom"></span>
                <span class="border border-left"></span>
            </a>
        </li>
        <li>
            <a href="{{route('informacion')}}">Información
                <span class="border border-top"></span>
                <span class="border border-right"></span>
                <span class="border border-bottom"></span>
                <span class="border border-left"></span>
            </a>
        </li>
        <li>
            <a href="{{route('verNadadores')}}">Ver Nadadores
                <span class="border border-top"></span>
                <span class="border border-right"></span>
                <span class="border border-bottom"></span>
                <span class="border border-left"></span>
            </a>
        </li>
        <li>
            <a href="{{route('codigosQR')}}">Grupos de WhatsApp
                <span class="border border-top"></span>
                <span class="border border-right"></span>
                <span class="border border-bottom"></span>
                <span class="border border-left"></span>
            </a>
        </li>
        <li>
            <a href="{{route('tiempos')}}">Ver Tiempos
                <span class="border border-top"></span>
                <span class="border border-right"></span>
                <span class="border border-bottom"></span>
                <span class="border border-left"></span>
            </a>
        </li>
        <li>
            <a href="{{route('minimas')}}">Ver Mínimas
                <span class="border border-top"></span>
                <span class="border border-right"></span>
                <span class="border border-bottom"></span>
                <span class="border border-left"></span>
            </a>
        </li>
    </ul>

    @elseif(Auth::user()->tipo === 'Nadador')
    <ul class="menu">
        <li>
        <a href="{{route('index')}}">Inicio<span class="border border-top"></span>
            <span class="border border-right"></span>
            <span class="border border-bottom"></span>
            <span class="border border-left"></span>
        </a> 
        </li>
        <li>
            <a href="{{route('horarios')}}">Horarios<span class="border border-top"></span>
                <span class="border border-right"></span>
                <span class="border border-bottom"></span>
                <span class="border border-left"></span>
            </a>  
        </li>
        <li>
            <a href="{{route('materiales')}}">Materiales
                <span class="border border-top"></span>
                <span class="border border-right"></span>
                <span class="border border-bottom"></span>
                <span class="border border-left"></span>
            </a> 
        </li>
        <li>
            <a href="{{route('competiciones')}}">Calendario de Competición
                <span class="border border-top"></span>
                <span class="border border-right"></span>
                <span class="border border-bottom"></span>
                <span class="border border-left"></span>
            </a>
        </li>
        <li>
            <a href="{{route('entrenamientos')}}">Entrenamientos
                <span class="border border-top"></span>
                <span class="border border-right"></span>
                <span class="border border-bottom"></span>
                <span class="border border-left"></span>
            </a>
        </li>
        <li>
            <a href="{{route('informacion')}}">Información
                <span class="border border-top"></span>
                <span class="border border-right"></span>
                <span class="border border-bottom"></span>
                <span class="border border-left"></span>
            </a>
        </li>
        <li>
            <a href="{{route('codigosQR')}}">Grupos de WhatsApp
                <span class="border border-top"></span>
                <span class="border border-right"></span>
                <span class="border border-bottom"></span>
                <span class="border border-left"></span>
            </a>
        </li>
        <li>
            <a href="{{route('tiempos')}}">Ver Tiempos
                <span class="border border-top"></span>
                <span class="border border-right"></span>
                <span class="border border-bottom"></span>
                <span class="border border-left"></span>
            </a>
        </li>
        <li>
            <a href="{{route('minimas')}}">Ver Mínimas
                <span class="border border-top"></span>
                <span class="border border-right"></span>
                <span class="border border-bottom"></span>
                <span class="border border-left"></span>
            </a>
        </li>
        <li>
            <a href="{{route('ranking')}}">Ver Ranking
                <span class="border border-top"></span>
                <span class="border border-right"></span>
                <span class="border border-bottom"></span>
                <span class="border border-left"></span>
            </a>
        </li>
    </ul>
  

    @endif
@else
    <ul class="menu">
        <li>
        <a href="{{route('index')}}">Inicio<span class="border border-top"></span>
            <span class="border border-right"></span>
            <span class="border border-bottom"></span>
            <span class="border border-left"></span>
        </a> 
        </li>
        <li>
            <a href="{{route('horarios')}}">Horarios<span class="border border-top"></span>
                <span class="border border-right"></span>
                <span class="border border-bottom"></span>
                <span class="border border-left"></span>
            </a>  
        </li>
        <li>
            <a href="{{route('materiales')}}">Materiales
                <span class="border border-top"></span>
                <span class="border border-right"></span>
                <span class="border border-bottom"></span>
                <span class="border border-left"></span>
            </a> 
        </li>
        <li>
            <a href="{{route('competicionesCualquiera')}}">Calendario de Competición
                <span class="border border-top"></span>
                <span class="border border-right"></span>
                <span class="border border-bottom"></span>
                <span class="border border-left"></span>
            </a>
        </li>
        <li>
            <a href="{{route('informacion')}}">Información
                <span class="border border-top"></span>
                <span class="border border-right"></span>
                <span class="border border-bottom"></span>
                <span class="border border-left"></span>
            </a>
        </li>
    </ul>
@endif