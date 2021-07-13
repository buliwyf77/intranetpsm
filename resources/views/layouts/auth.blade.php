<!DOCTYPE html>

<html lang="es">
    <!-- BEGIN: Head -->
    <head>
        <meta charset="utf-8">
        <link href="{{asset("template/dist/images/logo.png")}}" rel="shortcut icon">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Intranet PSM | @yield('title')</title>
        <!-- BEGIN: CSS Assets-->
        <link rel="stylesheet" href="{{asset('template/dist/css/app.css')}}" />
        <link rel="stylesheet" href="{{asset('template/dist/css/styles.css')}}" />
        <!-- END: CSS Assets-->
    </head>
    <!-- END: Head -->

    <body class="login">
        <div class="container sm:px-10">
            <div class="block xl:grid grid-cols-2 gap-4">
                <div class="hidden xl:flex flex-col min-h-screen">
                    <a href="" class="-intro-x flex items-center pt-5">
                       <!-- <img ali alt="Midone Tailwind HTML Admin Template" class="w-26" src="{{--asset("template/dist/images/logo-psm.png")--}}">    -->
                    </a>
                    <div class="my-auto">
                        <img alt="Midone Tailwind HTML Admin Template" class="-intro-x w-1/2 -mt-16" src="{{asset("template/dist/images/illustration.svg")}}">
                        <div class="-intro-x text-white font-medium text-4xl leading-tight mt-10">
                            
                            <br>
                            Intranet PSM Servicios
                        </div>
                        <div class="-intro-x mt-5 text-lg text-white">Maneja todas tus solicitudes desde un mismo lugar</div>
                    </div>
                </div>
                <div class="h-screen xl:h-auto flex py-5 xl:py-0 my-10 xl:my-0">
                                        
                    <div class="my-auto mx-auto xl:ml-20 bg-white xl:bg-transparent px-5 sm:px-8 py-8 xl:p-0 rounded-md shadow-md xl:shadow-none w-full sm:w-3/4 lg:w-2/4 xl:w-auto">
                        
                            
                        @yield('content')
                         
                        <div class="intro-x mt-10 xl:mt-24 text-gray-700 text-center xl:text-left">
                            <a class="text-theme-1" href="">PSM Servicios Informáticos y Logísticos LTDA</a> 
                       
                    </div>
                </div>
            </div>
        </div>        
    </div> 
        <!-- BEGIN: JS Assets-->
        <script src="{{asset('template/dist/js/app.js')}}"></script>
        <!-- END: JS Assets-->
    </body>
</html>