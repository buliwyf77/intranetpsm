@extends('layouts.master')

@section('title')
  <!-- Boton Index -->
@endsection

@section('content')
<h1 class="text-4xl text-theme-1 font-medium leading-none"> Directivo Registrado</h1>
  <!-- BEGIN: Profile Info -->
                <div align="right">
                  <a class="button w-24 mr-1 mb-2 bg-theme-1 text-white" href="{{route('directivos.edit', $directivo->id)}}"> Editar </a>
                </div>
                       <div class="ml-5">
                        <div class="flex mt-6 lg:mt-0 items-center lg:items-start flex-1 flex-col justify-center text-gray-600 px-5 border-l border-r border-gray-200 border-t lg:border-t-0 pt-5 lg:pt-0">
                          <div class="truncate sm:whitespace-normal flex items-center mt-3"> <i data-feather="copy" class="w-4 h-4 mr-2"></i> <b>Nombre Completo:&nbsp; </b> {{$directivo->nombre_completo}} </div>
                          <div class="truncate sm:whitespace-normal flex items-center mt-3"> <i data-feather="copy" class="w-4 h-4 mr-2"></i> <b>Rut:&nbsp; </b> {{$directivo->rut}} </div>
                          <div class="truncate sm:whitespace-normal flex items-center mt-3"> <i data-feather="folder" class="w-4 h-4 mr-2"></i> <b>Cargo:&nbsp; </b> {{$directivo->cargo}} </div>
                          <div class="truncate sm:whitespace-normal flex items-center"> <i data-feather="mail" class="w-4 h-4 mr-2"></i> <b>Email:&nbsp;</b> {{$directivo->email}} </div>
                        </div>
                    </div>
                  </div>
                <!-- END: Profile Info -->
      
@endsection