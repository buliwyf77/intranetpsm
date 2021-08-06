<!DOCTYPE html>

<html lang="es">
    <!-- BEGIN: Head -->
    <head>
        <meta charset="utf-8">
        <link href="{{asset("images/logo-psm2.jpeg")}}" rel="shortcut icon"> <!-- favicon -->
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Intranet - PSM </title>
        <!-- BEGIN: CSS Assets-->
        <link rel="stylesheet" href="{{asset("template/dist/css/app.css")}}" />
        <!-- Css personalizado-->
        <link rel="stylesheet" href="{{asset("css/styles.css")}}">
        <!-- END: CSS Assets-->
        
        <link href='{{asset('js/fullcalendar/lib/main.css')}}' rel='stylesheet' />
    </head>
    <!-- END: Head -->
    <body class="app">
        <!-- BEGIN: Mobile Menu -->
        <div class="mobile-menu md:hidden">
            <div class="mobile-menu-bar">
                <a href="{{route('home')}}" class="flex mr-auto">
                    <img alt="PSM" class="w-12" src="{{asset("images/logo-psm2.png")}}">
                </a>
                <a href="javascript:;" id="mobile-menu-toggler"> <i data-feather="bar-chart-2" class="w-8 h-8 text-white transform -rotate-90"></i> </a>
            </div>
            <ul class="border-t border-theme-24 py-5 hidden">
                <li>
                    <a href="{{route('home')}}" class="menu">
                        <div class="menu__icon"> <i data-feather="home"></i> </div>
                        <div class="menu__title"> Inicio </div>
                    </a>
                </li>
                <li>
                    <a href="{{route('users.directorio')}}" class="menu">
                        <div class="menu__icon"> <i data-feather="users"></i> </div>
                        <div class="menu__title"> Directorio </div>
                    </a>
                </li>

                @if(Auth::user()->role_id == 1 || (Auth::user()->role_id == 4 ))

                <li>
                    <a href="{{route('noticias.index')}}" class="menu">
                        <div class="menu__icon"> <i data-feather="message-square"></i> </div>
                        <div class="menu__title"> Noticias </div>
                    </a>
                </li>
		
		        <li>
	                <a href="{{route('users.index')}}" class="menu">
	                    <div class="menu__icon"> <i data-feather="users"></i> </div>
	                    <div class="menu__title"> Usuarios </div>
	                </a>
	            </li>
                <li>
	                <a href="{{route('user.jefesAreas')}}" class="menu">
	                    <div class="menu__icon"> <i data-feather="users"></i> </div>
	                    <div class="menu__title"> Jefes Áreas </div>
	                </a>
	            </li>
		        <li>
	                <a href="{{route('contratos.index')}}" class="menu">
	                    <div class="menu__icon"> <i data-feather="file-text"></i> </div>
	                    <div class="menu__title"> Contratos </div>
	                </a>
	            </li>

                <li>
                    <a href="{{route('areas.index')}}" class="menu">
                        <div class="menu__icon"> <i data-feather="layers"></i> </div>
                        <div class="menu__title"> Áreas </div>
                    </a>
                </li>

                <li>
                    <a href="{{route('proyectos.index')}}" class="menu">
                        <div class="menu__icon"> <i data-feather="layers"></i> </div>
                        <div class="menu__title"> Proyectos </div>
                    </a>
                </li>

                <li>
                    <a href="{{route('titulos.index')}}" class="menu">
                        <div class="menu__icon"> <i data-feather="file-text"></i> </div>
                        <div class="menu__title"> Titulos de Estudios </div>
                    </a>
                </li>

                <li>
                    <a href="{{route('certificaciones.index')}}" class="menu">
                        <div class="menu__icon"> <i data-feather="file-text"></i> </div>
                        <div class="menu__title"> Certificaciones </div>
                    </a>
                </li>

                <li>
                    <a href="{{route('habilidades.index')}}" class="menu">
                        <div class="menu__icon"> <i data-feather="file-text"></i> </div>
                        <div class="menu__title"> Habilidades </div>
                    </a>
                </li>

                <li>
                    <a href="{{route('vacaciones.index')}}" class="menu">
                        <div class="menu__icon"> <i data-feather="globe"></i> </div>
                        <div class="menu__title"> Todas las Solicitudes de Vacaciones </div>
                    </a>
                </li>
                <li>
                    <a href="{{route('aumentos.index')}}" class="menu">
                        <div class="menu__icon"> <i data-feather="globe"></i> </div>
                        <div class="menu__title"> Todas las Solicitudes de Aumento </div>
                    </a>
                </li>


                @endif
                
                <li>
                    <a href="{{route('vacaciones.user', Auth::user()->slug)}}" class="menu">
                        <div class="menu__icon"> <i data-feather="folder-plus"></i> </div>
                        <div class="menu__title"> Solicitud de Vacaciones </div>
                    </a>
                </li>
                    <li>
                    <a href="{{route('aumentos.user', Auth::user()->slug)}}" class="menu">
                        <div class="menu__icon"> <i data-feather="folder-plus"></i> </div>
                        <div class="menu__title"> Solicitud de Aumentos </div>
                    </a>
                </li>

                
                 @if(Auth::user()->role_id == 5)
                <li>
                    <a href="{{route('vacaciones.por_aprobar_ja')}}" class="menu">
                        <div class="menu__icon"> <i data-feather="folder-plus"></i> </div>
                        <div class="menu__title"> Solicitud Vacaciones JA </div>
                    </a>
                </li>
                @endif

                </ul>
                </li>
                <li class="menu__devider my-6"></li>
                
               
            </ul>
        </div>
        <!-- END: Mobile Menu -->
        <div class="flex">
            <!-- BEGIN: Side Menu -->
            <nav class="side-nav">
                <a href="{{route('home')}}" class="intro-x flex items-center pl-5 pt-4">
                    <img alt="PSM" class="w-12" src="{{asset("images/logo-psm2.png")}}">
                    <span class="hidden xl:block text-white text-lg ml-3">Intranet </span>
                </a>
                <div class="side-nav__devider my-6"></div>
                <ul>
                    <li>
                        <a href="{{route('home')}}" class="side-menu">
                            <div class="side-menu__icon"> <i data-feather="home"></i> </div>
                            <div class="side-menu__title"> Inicio </div>
                        </a>
                    </li>
                    <li>
                        <a href="{{route('users.show', Auth::user()->slug)}}" class="side-menu">
                            <div class="side-menu__icon"> <i data-feather="user"></i> </div>
                            <div class="side-menu__title"> Mi Perfil </div>
                        </a>
                    </li>
                    <li>
                        <a href="{{route('users.directorio')}}" class="side-menu">
                            <div class="side-menu__icon"> <i data-feather="users"></i> </div>
                            <div class="side-menu__title"> Directorio </div>
                        </a>
                    </li>

                    <li>
                        <a href="{{route('vacaciones.user', Auth::user()->slug)}}" class="side-menu">
                            <div class="side-menu__icon"> <i data-feather="folder-plus"></i> </div>
                            <div class="side-menu__title"> Mis Solicitudes de Vacaciones </div>
                        </a>
                    </li>
                     <li>
                        <a href="{{route('aumentos.user', Auth::user()->slug)}}" class="side-menu">
                            <div class="side-menu__icon"> <i data-feather="folder-plus"></i> </div>
                            <div class="side-menu__title"> Mis Solicitudes de Aumentos </div>
                        </a>
                    </li>

                     @if(Auth::user()->role_id == 1 || (Auth::user()->role_id == 4 ))
                     <li>
                        <a href="{{route('noticias.index')}}" class="side-menu">
                            <div class="side-menu__icon"> <i data-feather="message-square"></i> </div>
                            <div class="side-menu__title"> Noticias </div>
                        </a>
                    </li>
                    <li>
                        <a href="{{route('areas.index')}}" class="side-menu">
                            <div class="side-menu__icon"> <i data-feather="layers"></i> </div>
                            <div class="side-menu__title"> Areas </div>
                        </a>
                    </li>
                    <li>
                        <a href="{{route('proyectos.index')}}" class="side-menu">
                            <div class="side-menu__icon"> <i data-feather="layers"></i> </div>
                            <div class="side-menu__title"> Proyectos </div>
                        </a>
                    </li>
                    <li>
                        <a href="{{route('users.index')}}" class="side-menu">
                            <div class="side-menu__icon"> <i data-feather="users"></i> </div>
                            <div class="side-menu__title"> Usuarios </div>
                        </a>
                    </li>
                    <li>
                        <a href="{{route('user.jefesAreas')}}" class="side-menu">
                            <div class="side-menu__icon"> <i data-feather="users"></i> </div>
                            <div class="side-menu__title"> Jefes Áreas </div>
                        </a>
                    </li>
		            <li>
                        <a href="{{route('contratos.index')}}" class="side-menu">
                            <div class="side-menu__icon"> <i data-feather="file-text"></i> </div>
                            <div class="side-menu__title"> Contratos </div>
                        </a>
                    </li>
                    <li>
                        <a href="{{route('titulos.index')}}" class="side-menu">
                            <div class="side-menu__icon"> <i data-feather="file-text"></i> </div>
                            <div class="side-menu__title"> Titulos de Estudios</div>
                        </a>
                    </li>
                    <li>
                        <a href="{{route('certificaciones.index')}}" class="side-menu">
                            <div class="side-menu__icon"> <i data-feather="file-text"></i> </div>
                            <div class="side-menu__title"> Certificaciones </div>
                        </a>
                    </li>
                    <li>
                        <a href="{{route('habilidades.index')}}" class="side-menu">
                            <div class="side-menu__icon"> <i data-feather="file-text"></i> </div>
                            <div class="side-menu__title"> Habilidades </div>
                        </a>
                    </li>
                   {{--<li>
                        <a href="{{route('directivos.index')}}" class="side-menu">
                            <div class="side-menu__icon"> <i data-feather="users"></i> </div>
                            <div class="side-menu__title"> Directivos </div>
                        </a>
                    </li>--}}
               
                    <li>
                        <a href="{{route('vacaciones.index')}}" class="side-menu">
                            <div class="side-menu__icon"> <i data-feather="globe"></i> </div>
                            <div class="side-menu__title"> Todas las Solicitudes de Vacaciones </div>
                        </a>
                    </li>
                    <li>
                        <a href="{{route('aumentos.index')}}" class="side-menu">
                            <div class="side-menu__icon"> <i data-feather="globe"></i> </div>
                            <div class="side-menu__title"> Todas las Solicitudes de Aumento </div>
                        </a>
                    </li>
                    @endif
                    @if(Auth::user()->role_id == 5)
                    <li>
                        <a href="{{route('vacaciones.por_aprobar_ja')}}" class="side-menu">
                            <div class="side-menu__icon"> <i data-feather="folder-plus"></i> </div>
                            <div class="side-menu__title"> Solicitud Vacaciones JA </div>
                        </a>
                    </li>
                    @endif
                    {{--<li>
                        <a href="{{route('solicitudes.index')}}" class="side-menu">
                            <div class="side-side-menu__icon"> <i data-feather="message-square"></i> </div>
                            <div class="side-menu__title"> Estados de Solicitudes </div>
                        </a>
                    </li>--}}

                 </ul>
            </nav>
            <!-- END: Side Menu -->
            <!-- BEGIN: Content -->
            <div class="content">
                <!-- BEGIN: Top Bar -->
                <div class="top-bar">
                    <!-- BEGIN: Breadcrumb -->
                    <div class="-intro-x breadcrumb mr-auto hidden sm:flex"> <a href="{{route('home')}}" class="">Intranet</a> <i data-feather="chevron-right" class="breadcrumb__icon"></i> <a href="{{route('home')}}" class="breadcrumb--active">Inicio</a> </div>
                    <!-- END: Breadcrumb -->
                    
                    <!-- BEGIN: Notifications -->
                    {{--<div class="intro-x dropdown relative mr-auto sm:mr-6">
                        <div class="dropdown-toggle notification notification--bullet cursor-pointer"> <i data-feather="bell" class="notification__icon"></i> </div>
                        <div class="notification-content dropdown-box mt-8 absolute top-0 left-0 sm:left-auto sm:right-0 z-20 -ml-10 sm:ml-0">
                            <div class="notification-content__box dropdown-box__content box">
                                <div class="notification-content__title">Notifications</div>
                                <div class="cursor-pointer relative flex items-center ">
                                    <div class="w-12 h-12 flex-none image-fit mr-1">
                                        <img alt="Midone Tailwind HTML Admin Template" class="rounded-full" src="{{asset("template/dist/images/profile-12.jpg")}}">
                                        <div class="w-3 h-3 bg-theme-9 absolute right-0 bottom-0 rounded-full border-2 border-white"></div>
                                    </div>
                                    <div class="ml-2 overflow-hidden">
                                        <div class="flex items-center">
                                            <a href="javascript:;" class="font-medium truncate mr-5">@auth  {{Auth::user()->name}} @endauth</a> 
                                            <div class="text-xs text-gray-500 ml-auto whitespace-no-wrap">01:10 PM</div>
                                        </div>
                                        <div class="w-full truncate text-gray-600">Contrary to popular belief, Lorem Ipsum is not simply random text. It has roots in a piece of classical Latin literature from 45 BC, making it over 20</div>
                                    </div>
                                </div>
                                <div class="cursor-pointer relative flex items-center mt-5">
                                    <div class="w-12 h-12 flex-none image-fit mr-1">
                                        <img alt="Midone Tailwind HTML Admin Template" class="rounded-full" src="{{asset("template/dist/images/profile-14.jpg")}}">
                                        <div class="w-3 h-3 bg-theme-9 absolute right-0 bottom-0 rounded-full border-2 border-white"></div>
                                    </div>
                                    <div class="ml-2 overflow-hidden">
                                        <div class="flex items-center">
                                            <a href="javascript:;" class="font-medium truncate mr-5">Tom Cruise</a> 
                                            <div class="text-xs text-gray-500 ml-auto whitespace-no-wrap">01:10 PM</div>
                                        </div>
                                        <div class="w-full truncate text-gray-600">It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem </div>
                                    </div>
                                </div>
                                <div class="cursor-pointer relative flex items-center mt-5">
                                    <div class="w-12 h-12 flex-none image-fit mr-1">
                                        <img alt="Midone Tailwind HTML Admin Template" class="rounded-full" src="{{asset("template/dist/images/profile-15.jpg")}}">
                                        <div class="w-3 h-3 bg-theme-9 absolute right-0 bottom-0 rounded-full border-2 border-white"></div>
                                    </div>
                                    <div class="ml-2 overflow-hidden">
                                        <div class="flex items-center">
                                            <a href="javascript:;" class="font-medium truncate mr-5">Hugh Jackman</a> 
                                            <div class="text-xs text-gray-500 ml-auto whitespace-no-wrap">01:10 PM</div>
                                        </div>
                                        <div class="w-full truncate text-gray-600">Contrary to popular belief, Lorem Ipsum is not simply random text. It has roots in a piece of classical Latin literature from 45 BC, making it over 20</div>
                                    </div>
                                </div>
                                <div class="cursor-pointer relative flex items-center mt-5">
                                    <div class="w-12 h-12 flex-none image-fit mr-1">
                                        <img alt="Midone Tailwind HTML Admin Template" class="rounded-full" src="{{asset("template/dist/images/profile-10.jpg")}}">
                                        <div class="w-3 h-3 bg-theme-9 absolute right-0 bottom-0 rounded-full border-2 border-white"></div>
                                    </div>
                                    <div class="ml-2 overflow-hidden">
                                        <div class="flex items-center">
                                            <a href="javascript:;" class="font-medium truncate mr-5">Russell Crowe</a> 
                                            <div class="text-xs text-gray-500 ml-auto whitespace-no-wrap">01:10 PM</div>
                                        </div>
                                        <div class="w-full truncate text-gray-600">Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry&#039;s standard dummy text ever since the 1500</div>
                                    </div>
                                </div>
                                <div class="cursor-pointer relative flex items-center mt-5">
                                    <div class="w-12 h-12 flex-none image-fit mr-1">
                                        <img alt="Midone Tailwind HTML Admin Template" class="rounded-full" src="{{asset("template/dist/images/profile-8.jpg")}}">
                                        <div class="w-3 h-3 bg-theme-9 absolute right-0 bottom-0 rounded-full border-2 border-white"></div>
                                    </div>
                                    <div class="ml-2 overflow-hidden">
                                        <div class="flex items-center">
                                            <a href="javascript:;" class="font-medium truncate mr-5">John Travolta</a> 
                                            <div class="text-xs text-gray-500 ml-auto whitespace-no-wrap">05:09 AM</div>
                                        </div>
                                        <div class="w-full truncate text-gray-600">It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>--}}
                    <!-- END: Notifications -->
                    <!-- BEGIN: Account Menu -->
                    <div class="intro-x dropdown w-8 h-8 relative ml-auto">
                        <div class="dropdown-toggle w-8 h-8 rounded-full overflow-hidden shadow-lg image-fit zoom-in">
                            <img alt="{{Auth::user()->name}}" src="{{Auth::user()->info->imagen}}">
                        </div>
                        <div class="dropdown-box mt-10  absolute w-56 top-0 right-0 z-20">
                            <div class="dropdown-box__content box bg-theme-38 text-white">
                                <div class="p-4 border-b border-theme-40">
                                    <div class="font-medium">@auth  {{Auth::user()->name}} @endauth</div>
                                    <div class="text-xs text-theme-41">Bienvenido (a)</div>
                                </div>
                                <div class="p-2">
                                    <a href="{{route('users.show', Auth::user()->slug)}}" class="flex items-center block p-2 transition duration-300 ease-in-out hover:bg-theme-1 rounded-md"> <i data-feather="user" class="w-4 h-4 mr-2"></i> Perfil </a>
                                    <a href="javascript:;" data-toggle="modal" data-target="#modal-soporte" class="flex items-center block p-2 transition duration-300 ease-in-out hover:bg-theme-1 rounded-md"> <i data-feather="help-circle" class="w-4 h-4 mr-2"></i> Soporte </a>
                                    <!--<div class="text-center"> <a href="javascript:;" data-toggle="modal" data-target="#modal-soporte" class="button inline-block bg-theme-1 text-white">Show Modal</a> </div>-->
                                </div>
                                <div class="p-2 border-t border-theme-40">
                                    <a href="{{ route('logout') }}"
                                    onclick="event.preventDefault();
                                                  document.getElementById('logout-form').submit();" class="flex items-center block p-2 transition duration-300 ease-in-out hover:bg-theme-1 rounded-md"> <i data-feather="toggle-right" class="w-4 h-4 mr-2"></i> Salir </a>
                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                        @csrf
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- END: Account Menu -->
                </div>
                <!-- END: Top Bar -->
                <div class="intro-y flex items-center mt-">
                    <h2 class="text-lg font-medium mr-auto">
                        @yield('title') <!-- titulo de la vista q se llama -->
                    </h2>
                </div>
                <div class="grid grid-cols-12 gap-6 mt-">
                    <div class="intro-y col-span-12 lg:col-span-12">
                        <!-- BEGIN: Form Layout -->
                        @yield('content') <!-- contenido de la vista que se llama -->
                        <!-- END: Form Layout -->
                    </div>
                </div>
            </div>
            <!-- END: Content -->
        </div>

        <!-- Modal de Soporte -->
        <div class="modal" id="modal-soporte">
            <div class="modal__content relative"> <a data-dismiss="modal" href="javascript:;" class="absolute right-0 top-0 mt-3 mr-3"> <i data-feather="x" class="w-8 h-8 text-gray-500"></i> </a>
                <div class="p-5 text-center"> <i data-feather="check-circle" class="w-16 h-16 text-theme-9 mx-auto mt-3"></i>
                    <div class="text-3xl mt-5">Soporte Intranet</div>
                    <div class="text-gray-600 mt-2">En caso de inconvenientes con el sistema comunicarse al correo: 
                        fherrerac@psmservicios.cl
                    </div>
                </div>
                <div class="px-5 pb-8 text-center"> <button type="button" data-dismiss="modal" class="button w-24 bg-theme-1 text-white">Ok</button> </div>
            </div>
        </div>

        <!-- BEGIN: JS Assets-->
        <!--<script src="https://developers.google.com/maps/documentation/javascript/examples/markerclusterer/markerclusterer.js"></script>-->
        <!--<script src="https://maps.googleapis.com/maps/api/js?key=["your-google-map-api"]&libraries=places"></script>-->
        <script src="{{asset('template/dist/js/app.js')}}"></script>
        <script src="{{asset('js/fullcalendar/lib/main.js')}}"></script>
        <script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
        <script src="{{asset('js/fullcalendar/lib/locales/es.js')}}"></script>
        <script src="{{asset('js/ckeditor/ckeditor.js')}}"></script>
        <script src="{{asset('marquee-js/dist/js/jquery.marquee.js')}}"></script>
        <script src="https://cdn.jsdelivr.net/npm/vue@2/dist/vue.js"></script>
        <script src="https://unpkg.com/axios/dist/axios.min.js"></script>

        <script>
            $('#demo').marquee({

            // enable the plugin
            enable : true,  //plug-in is enabled

            // scroll direction
            // 'vertical' or 'horizontal'
            direction: 'horizontal',

            // children items
            itemSelecter : 'li', 

            // animation delay
            delay: 3000,

            // animation speed
            speed: 1,

            // animation timing
            timing: 1,

            // mouse hover to stop the scroller
            mouse: true

            });  

        </script>
        
        <!-- END: JS Assets-->

        @include('sweetalert::alert')

        @stack('scripts-js')
    </body>
</html>