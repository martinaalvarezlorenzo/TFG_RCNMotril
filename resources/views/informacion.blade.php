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
            <section style="margin-bottom: 20px;">
                <h2>Historia de la natación</h2>
                <p class="letra">La natación es una práctica ancestral que se remonta a la prehistoria, cuando los seres humanos comenzaron a nadar por necesidad de supervivencia. A lo largo de los siglos, la natación ha evolucionado desde una habilidad básica de supervivencia hasta convertirse en un deporte competitivo reconocido a nivel mundial. Civilizaciones antiguas como los egipcios y los griegos valoraban la natación tanto por razones recreativas como por su utilidad en la guerra. En la era moderna, la natación se ha consolidado como uno de los deportes más populares y beneficiosos para la salud.</p>
            </section>
    
            <section style="margin-bottom: 20px;">
                <h2>Beneficios de la natación</h2>
                <p class="letra">La práctica regular de la natación ofrece una amplia gama de beneficios para la salud física y mental. Además de mejorar la resistencia cardiovascular y fortalecer los músculos, la natación es una forma de ejercicio de bajo impacto que ayuda a mejorar la flexibilidad y la coordinación. También es una excelente manera de reducir el estrés y mejorar el estado de ánimo, gracias al efecto relajante del agua. Otros beneficios incluyen la mejora de la circulación sanguínea, la quema de calorías y el aumento de la capacidad pulmonar.</p>
            </section>
    
            <section style="margin-bottom: 20px;">
                <h2>Estilos</h2>
                <ul>
                    <p class="letra"><strong>Mariposa, espalda, braza y crol</strong></p>
                </ul>
            </section>
    
            <section>
                <h2>Preguntas frecuentes</h2>
                <details>
                    <summary> <strong>¿Se considera la natación una actividad cardiovascular? </strong></summary>
                    <p class="letra">La natación es considerada una actividad cardiovascular. Es un deporte que mejora la resistencia cardiovascular, el control de la respiración y ofrece un entrenamiento completo para el cuerpo.</p>
                </details><br>
                
                <details>
                    <summary> <strong>¿Es cierto que es peligroso nadar inmediatamente después de comer? </strong></summary>
                    <p class="letra">No necesariamente es peligroso, pero puede causar molestias si se ha ingerido una gran cantidad de alimentos. Lo ideal es esperar un tiempo después de comer para evitar sentirse pesado mientras se nada.</p>
                </details><br>
    
                <details>
                    <summary><strong>¿La natación es útil para el dolor de espalda? </strong></summary>
                    <p class="letra">Sí, la natación puede ser muy útil para el dolor de espalda. La flotación en el agua reduce la presión sobre la columna vertebral y los ejercicios de natación pueden fortalecer los músculos de la espalda, aliviar la tensión y mejorar la flexibilidad.</p>
                </details><br>
    
                <details>
                    <summary><strong>¿Es mejor practicar la natación en piscinas o playas?</strong></summary>
                    <p class="letra">Ambas opciones tienen sus ventajas. Las piscinas ofrecen un entorno controlado y seguro, ideal para entrenamientos estructurados y clases. Las playas proporcionan un entorno natural, con agua salada que puede tener beneficios adicionales para la piel y la salud, pero también pueden presentar desafíos como las corrientes y las olas.</p>
                </details><br>
    
                <details>
                    <summary><strong>¿Cuál es el estilo de la natación más fácil de practicar?</strong></summary>
                    <p class="letra">Para muchas personas, el estilo de crol (también conocido como estilo libre) suele ser el más fácil de aprender y practicar. Es un estilo fluido y natural que se adapta bien a diferentes niveles de habilidad.</p>
                </details><br>
    
                <details>
                    <summary><strong>¿Cuántas kcal se pierden en 1 hora de natación? </strong></summary>
                    <p class="letra">La cantidad de calorías quemadas en 1 hora de natación varía según la intensidad del ejercicio y el peso del nadador. En general, se estima que se pueden quemar alrededor de 400 a 600 calorías por hora nadando a un ritmo moderado.</p>
                </details><br>
    
                <details>
                    <summary><strong>¿Cómo son las clases de natación para adultos?</strong></summary>
                    <p class="letra">Las clases de natación para adultos pueden variar según el nivel de habilidad y los objetivos individuales. Pueden incluir ejercicios de técnica, entrenamiento de resistencia, ejercicios de respiración y estiramientos. Las clases suelen adaptarse para satisfacer las necesidades y capacidades de los participantes adultos.</p>
                </details>
            </section>
        </div>
        <br><br>
        <style>
            .container {
                text-align: center;
                width: 80%;
                margin: 0 auto;
                background: #163b3d80;
                color: white;
                border-radius: 20px;
                padding: 10px;
            }
            h2 {
                margin: 0;
            }
            .letra {
                width: 80%;
                margin: 0 auto;
            }
        </style>
        
          
    <x-footer>

    </x-footer>

    </body>
</html>
