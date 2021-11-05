@extends('layouts.master')

@section('title')

@endsection

@section('content')

<!-- Perfil -->
<h3 class="text-4xl text-theme-1 font-medium leading-none mt-5"> {{$user->name}}</h3>
<br>

<div align="right">
  <a class="button w-24 mr-1 mb-2 bg-theme-1 text-white" href="{{route('users.edit', $user->slug)}}">  Editar </a>
  <a class="button w-24 mr-1 mb-2 bg-theme-1 text-white" href="{{route('user.crearFirma', $user->slug)}}">  Crear Firma </a>
  <a class="button w-24 mr-1 mb-2 bg-theme-1 text-white" href="{{route('users.pdfCertificadoAntiguedad', $user->id)}}"> Certificado de Antiguedad </a>
 
</div>

<div class="intro-y box px-5 pt-5 mt-5">
  <div class="flex flex-col lg:flex-row border-b border-gray-200 pb-5 -mx-5">
    <div class="flex flex-1 px-5 items-center justify-center lg:justify-start">
        <div class="w-20 h-20 sm:w-24 sm:h-24 flex-none lg:w-32 lg:h-32 image-fit relative">
            <img alt="{{$user->name}}" class="rounded-full" src="{{$user->info->imagen}}">
            <div class="absolute mb-1 mr-1 flex items-center justify-center bottom-0 right-0 bg-theme-1 rounded-full p-2"></div>
        </div>
        <div class="ml-5">
          <div class="truncate sm:whitespace-normal flex items-center mt-3"> <b>Área:&nbsp; </b> {{$user->info->area->nombre}} </div>
          <div class="truncate sm:whitespace-normal flex items-center mt-3"> <b>Email:&nbsp; </b> {{ $user->email}}</div>
          <div class="truncate sm:whitespace-normal flex items-center mt-1"> <b>Firma:&nbsp; </b>
          <img src="{{$user->info->firma}}" alt="" width="180px" height="120px" style="z-index:2;"></div>
        </div>
    </div>
    <div class="flex mt-6 lg:mt-0 items-center lg:items-start flex-1 flex-col justify-center text-gray-600 px-5 border-l border-r border-gray-200 border-t lg:border-t-0 pt-5 lg:pt-0">
        <div class="truncate sm:whitespace-normal flex items-center mt-3"> <b>Documento de Identidad:&nbsp;</b> {{$user->info->doc_identidad}} </div>
        <div class="truncate sm:whitespace-normal flex items-center mt-3"> <b>Número de Documento:&nbsp;</b> {{$user->info->num_doc}} </div>
        <div class="truncate sm:whitespace-normal flex items-center mt-3"> <b>Nacionalidad:&nbsp;</b> {{$user->info->nacionalidad}} </div>
        <div class="truncate sm:whitespace-normal flex items-center mt-3"> <b>Fecha de Nacimiento:&nbsp;</b>
          {{date('d-m-Y', strtotime($user->info->fecha_nacimiento))}}
        </div>
    </div>
    <div class="flex mt-6 lg:mt-0 items-center lg:items-start flex-1 flex-col justify-center text-gray-600 px-5 border-l border-r border-gray-200 border-t lg:border-t-0 pt-5 lg:pt-0">
      <div class="truncate sm:whitespace-normal flex items-center mt-3"> <b>Fecha de Ingreso:&nbsp;</b> {{date('d-m-Y', strtotime($user->info->fecha_ingreso))}} </div>
      <div class="truncate sm:whitespace-normal flex items-center mt-3"> <b>Teléfono:&nbsp; </b>{{$user->info->telefono}} </div>
      <div class="truncate sm:whitespace-normal flex items-center mt-3"> <b>Dirección:&nbsp; </b> </div>
      <div class="truncate sm:whitespace-normal flex items-center mt-1">  {{$user->info->direccion}} </div>                                                                          
      <div class="truncate sm:whitespace-normal flex items-center mt-1"> <b>Contacto de Emergencia:&nbsp; </b> {{$user->info->emergencia_nombre}} </div>                                                                          
      <div class="truncate sm:whitespace-normal flex items-center mt-1"> <b>Teléfono de Emergencia:&nbsp; </b> {{$user->info->emergencia_telefono}} </div>                                                                          
      
    </div>
  </div>
</div>
<!-- END: Perfil -->

  <div class="accordion">
      <div class="accordion__pane active border-b border-gray-200 pb-4"> <a href="javascript:;" class="accordion__pane__toggle font-medium block">
      <h3 class="text-4xl text-theme-1 font-medium leading-none mt-5"> 
        <i data-feather="plus-circle" style="display: inline-block"></i> Contratos 
      </h3>
      <div class="accordion__pane__content mt-3 text-gray-700 leading-relaxed">
          @include('users.user-contrato')
       </div>
    </div>
    <div class="accordion__pane active border-b border-gray-200 pb-4"> <a href="javascript:;" class="accordion__pane__toggle font-medium block">
      <h3 class="text-4xl text-theme-1 font-medium leading-none mt-5"> 
        <i data-feather="plus-circle" style="display: inline-block"></i> Experiencia Laboral 
      </h3>
      <div class="accordion__pane__content mt-3 text-gray-700 leading-relaxed">
        @include('users.user-experiencias')
      </div>
    </div>
    <div class="accordion__pane active border-b border-gray-200 pb-4"> <a href="javascript:;" class="accordion__pane__toggle font-medium block">
      <h3 class="text-4xl text-theme-1 font-medium leading-none mt-5"> 
        <i data-feather="plus-circle" style="display: inline-block"></i> Habilidades
      </h3>
      <div class="accordion__pane__content mt-3 text-gray-700 leading-relaxed">
        @include('users.user-habilidades')
      </div>
    </div>
    <div class="accordion__pane active border-b border-gray-200 pb-4"> <a href="javascript:;" class="accordion__pane__toggle font-medium block">
      <h3 class="text-4xl text-theme-1 font-medium leading-none mt-5"> 
        <i data-feather="plus-circle" style="display: inline-block"></i> Títulos de Estudios
      </h3>
      <div class="accordion__pane__content mt-3 text-gray-700 leading-relaxed">
        @include('users.user-titulos')
      </div>
    </div>
    <div class="accordion__pane active border-b border-gray-200 pb-4"> <a href="javascript:;" class="accordion__pane__toggle font-medium block">
      <h3 class="text-4xl text-theme-1 font-medium leading-none mt-5"> 
        <i data-feather="plus-circle" style="display: inline-block"></i> Certificaciones
      </h3>
      <div class="accordion__pane__content mt-3 text-gray-700 leading-relaxed">
        @include('users.user-certificaciones')
      </div>
    </div>
    <div class="accordion__pane active border-b border-gray-200 pb-4"> <a href="javascript:;" class="accordion__pane__toggle font-medium block">
      <h3 class="text-4xl text-theme-1 font-medium leading-none mt-5"> 
        <i data-feather="plus-circle" style="display: inline-block"></i> Participación en Proyectos
      </h3>
      <div class="accordion__pane__content mt-3 text-gray-700 leading-relaxed">
        @include('users.user-participacion-proyectos')
      </div>
    </div>
    <div class="accordion__pane active border-b border-gray-200 pb-4"> <a href="javascript:;" class="accordion__pane__toggle font-medium block">
      <h3 class="text-4xl text-theme-1 font-medium leading-none mt-5"> 
        <i data-feather="plus-circle" style="display: inline-block"></i> Solicitudes Vacaciones
      </h3>
      <div class="accordion__pane__content mt-3 text-gray-700 leading-relaxed">
        @include('users.user-vacaciones')
      </div>
      <div class="accordion__pane active border-b border-gray-200 pb-4"> <a href="javascript:;" class="accordion__pane__toggle font-medium block">
        <h3 class="text-4xl text-theme-1 font-medium leading-none mt-5"> 
          <i data-feather="plus-circle" style="display: inline-block"></i> Solicitudes Aumentos
        </h3>
        <div class="accordion__pane__content mt-3 text-gray-700 leading-relaxed">
          @include('users.user-aumentos')
        </div>
    </div>
  </div>
@endsection