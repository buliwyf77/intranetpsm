
<html lang="es">
    <!-- BEGIN: Head -->
    <head>
        
        <!-- BEGIN: CSS Assets-->
        <link rel="stylesheet" href="{{asset('template/dist/css/app.css')}}" />
        <title>404: Página no encontrada</title>
        <!-- END: CSS Assets-->
    </head>
    <!-- END: Head -->
    <body class="app">
        <div class="container">
            <!-- BEGIN: Error Page -->
            <div class="error-page flex flex-col lg:flex-row items-center justify-center h-screen text-center lg:text-left">
                <div class="-intro-x lg:mr-20">
                    <img alt="Acceso-denegado" class="h-48 lg:h-auto" src="{{asset('images/error-404.jpg')}}">
                </div>
                <div class="text-white mt-10 lg:mt-0">
                    <div class="intro-x text-6xl font-medium"></div>
                    <div class="intro-x text-xl lg:text-3xl font-medium">Error de página.</div>
                    <div class="intro-x text-lg mt-3">Página no encontrada.</div><br><br>
                    <a href="{{route('home')}}" class="intro-x button button--lg border border-white mt-5">Ir al inicio</a>
                </div>
            </div>
            <!-- END: Error Page -->
        </div>
        <!-- BEGIN: JS Assets-->
        
        <!-- END: JS Assets-->
    </body>
</html>
