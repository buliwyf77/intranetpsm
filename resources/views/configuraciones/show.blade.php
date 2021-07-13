@extends('layouts.master')

@section('title')
  <!-- Boton Index -->
@endsection

@section('content')
<h1 class="text-4xl text-theme-1 font-medium leading-none"> Configuración de Sistema</h1>
  <!-- BEGIN: Profile Info -->
                <div align="right">
                  <a class="button w-24 mr-1 mb-2 bg-theme-1 text-white" href="{{route('configuraciones.edit', $configuracione->id)}}"> Editar </a>
                </div>
                <div class="intro-y box px-5 pt-5 mt-5">
                    <div class="flex flex-col lg:flex-row border-b border-gray-200 pb-5 -mx-5">
                        <div class="flex flex-1 px-5 items-center justify-center lg:justify-start">
                            <div class="w-20 h-20 sm:w-24 sm:h-24 flex-none lg:w-32 lg:h-32 image-fit relative">
                                <img alt="{{$configuracione->nombre_empresa}}" class="rounded-full" src="{{$configuracione->logo}}">
                                <div class="absolute mb-1 mr-1 flex items-center justify-center bottom-0 right-0 bg-theme-1 rounded-full p-2"></div>
                            </div>
                            <div class="ml-5">
                                <div class="text-gray-600">Nombre de la Empresa: {{ $configuracione->nombre_empresa}}</div>
                                <div class="text-gray-600">RUT: {{ $configuracione->rut}}</div>
                            </div>
                        </div>
                        <div class="flex mt-6 lg:mt-0 items-center lg:items-start flex-1 flex-col justify-center text-gray-600 px-5 border-l border-r border-gray-200 border-t lg:border-t-0 pt-5 lg:pt-0">
                            <div class="truncate sm:whitespace-normal flex items-center"> <i data-feather="map" class="w-4 h-4 mr-2"></i> <b>Ciudad:&nbsp;</b> {{$configuracione->ciudad}} </div>
                            <div class="truncate sm:whitespace-normal flex items-center mt-3"> <i data-feather="map-pin" class="w-4 h-4 mr-2"></i> <b>Dirección:&nbsp; </b> {{$configuracione->direccion}} </div>
                            <div class="truncate sm:whitespace-normal flex items-center mt-3"> <i data-feather="smartphone" class="w-4 h-4 mr-2"></i> <b>Teléfono:&nbsp; </b>{{$configuracione->telefono}} </div>
                        </div>
                        <div class="flex mt-6 lg:mt-0 items-center lg:items-start flex-1 flex-col justify-center text-gray-600 px-5 border-l border-r border-gray-200 border-t lg:border-t-0 pt-5 lg:pt-0">
                          <div class="truncate sm:whitespace-normal flex items-center"> <i data-feather="mail" class="w-4 h-4 mr-2"></i> <b>Email:&nbsp; </b> {{$configuracione->email}} </div>
                          <div class="truncate sm:whitespace-normal flex items-center mt-3"> <i data-feather="link" class="w-4 h-4 mr-2"></i> <b>Web:&nbsp; </b> <a href="{{$configuracione->pagina_web}}" target="_blank"> {{$configuracione->pagina_web}}</a>  </div>
                          
                        </div>
                    </div>
                  </div>
                <!-- END: Profile Info -->
      
@endsection

