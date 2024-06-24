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
            <section class="cabecera" >
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

        <div class="container">
            <div class="section">
                <div class="image-container" >
                    <img src="{{ asset('imagenes/codigoP.png') }}" alt="Imagen 1" width="200" height="200">
                </div>
                <div class="content">
                    <h2>Prebenjamín</h2>
                    <p>Únete al grupo de WhatsApp de Prebenjamín para mantenerte informado sobre las últimas noticias del equipo.</p>
                    <h5><a href="https://chat.whatsapp.com/KV1TPyFJCqWHPL0ajxnH7D" style="text-decoration: none; color:black;" class="btn btn-light">Únete ahora!</a></h5>
                </div>
            </div>
            <div class="section">
                <div class="image-container">
                    <img src="{{ asset('imagenes/codigoB.png') }}" alt="Imagen 1" width="200" height="200">
                </div>
                <div class="content">
                    <h2>Benjamín</h2>
                    <p>Únete al grupo de WhatsApp de Benjamín para mantenerte informado sobre las últimas noticias del equipo.</p>
                    <h5><a href="https://chat.whatsapp.com/I5ORHZOUI2qIjQyqiLE6D5" style="text-decoration: none; color:black;" class="btn btn-light">Únete ahora!</a></h5>
                </div>
            </div>
        </div>

        <div class="container">
            <div class="section">
                <div class="image-container" >
                    <img src="{{ asset('imagenes/codigoA.png') }}" alt="Imagen 1" width="200" height="200">
                </div>
                <div class="content">
                    <h2>Alevín</h2>
                    <p>Únete al grupo de WhatsApp de Alevín para mantenerte informado sobre las últimas noticias del equipo.</p>
                    <h5><a href="https://chat.whatsapp.com/LnbawN5BzcjLuetLGSOzcQ" style="text-decoration: none; color:black;" class="btn btn-light">Únete ahora!</a></h5>
                </div>
            </div>
            <div class="section">
                <div class="image-container">
                    <img src="{{ asset('imagenes/codigoI.png') }}" alt="Imagen 1" width="200" height="200">
                </div>
                <div class="content">
                    <h2>Infantil</h2>
                    <p>Únete al grupo de WhatsApp de Infantil para mantenerte informado sobre las últimas noticias del equipo.</p>
                    <h5><a href="https://chat.whatsapp.com/II44F3ZI8lSGluUiy9xOpT" style="text-decoration: none; color:black;" class="btn btn-light">Únete ahora!</a></h5>
                </div>
            </div>
        </div>
        <div class="container">
            <div class="section">
                <div class="image-container" >
                    <img src="{{ asset('imagenes/codigoJA.png') }}" alt="Imagen 1" width="200" height="200">
                </div>
                <div class="content" style="vertical-align: middle;">
                    <h2>Juniors-Absolutos</h2>
                    <p>Únete al grupo de WhatsApp de Juniors-Absolutos para mantenerte informado sobre las últimas noticias del equipo.</p>
                    <h5><a href="https://chat.whatsapp.com/KnCFUfAkCSP8b9KhtszF3V" style="text-decoration: none; color:black;" class="btn btn-light">Únete ahora!</a></h5>
                </div>
            </div>
        </div>
        
          <style>
            .container {
                display: flex;
                justify-content: space-between;
                padding: 0 5%;
            }

            .section {
                width: 100%;
                display: flex;
                background: #163b3d80;
                color: white;
                border-radius: 15px;
                padding: 20px;
                margin-left: 2%;
                margin-right: 2%;
                margin-bottom: 2%;
            }

            .image-container,
            .content {
                width: 50%;
                margin-left: 2%;
                margin-right: 2%;
                margin-bottom: 2%;
            }

            .image-container img {
                max-width: 100%;
                height: auto;
                border-radius: 15px;
            }
            .image-container img {
                object-fit: cover; 
            }

            .image-container {
                width: 50%;
                display: flex;
                align-items: center;
                justify-content: center;
            }

            .content {
                width: 50%;
                margin-left: 2%;
                margin-right: 2%;
                margin-bottom: 2%;
                text-align: center; 
            }

            .content {
                width: 50%;
                margin-left: 2%;
                margin-right: 2%;
                margin-bottom: 2%;
                text-align: center; 
                display: flex;
                flex-direction: column;
                justify-content: center;
                height: 100%; 
            }



          </style>
        
          
    <x-footer>

    </x-footer>

    </body>
</html>
