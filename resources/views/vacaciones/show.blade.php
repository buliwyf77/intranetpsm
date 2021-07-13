@extends('layouts.master')

@section('title')
  <!-- Boton Index -->
@endsection

@section('content')

<style>
  .error {
    color: red;
    font-style: italic;
 }
</style>

<h1 class="text-4xl text-theme-1 font-medium leading-none"> Registro de Solicitud de Vacaciones</h1>
  <!-- BEGIN: Profile Info -->
                <div align="right">
                  @if((Auth:: user()->role_id == 4) && ($vacacione->solicitud_id == 3))
                  <a class="button w-24 mr-1 mb-2 bg-theme-9 text-white" data-toggle="modal" data-target="#modal-aprobacion" href="#"> Aprobar </a>
                  <a class="button w-24 mr-1 mb-2 bg-theme-6 text-white" data-toggle="modal" data-target="#modal-rechazo" href="#"> Rechazar </a>
                  @endif

                  @if($vacacione->solicitud_id == 3 && Auth::id() == $vacacione->user_id)
                  <a class="button w-24 mr-1 mb-2 bg-theme-1 text-white" href="{{route('vacaciones.edit', $vacacione->id)}}"> Editar </a>
                  @endif

                  @if($vacacione->solicitud_id == 4 && Auth:: user()->role_id == 5 )
                  <a class="button w-24 mr-1 mb-2 bg-theme-7 text-white"  href="{{route('vacaciones.aprobar_ja', $vacacione->id)}}"> Aprobar </a>
                  @endif

                  @if($vacacione->solicitud_id == 5)
                  <a class="button w-24 mr-1 mb-2 bg-theme-7 text-white"  href="{{route('vacaciones.downloadPDF', $vacacione->id)}}"> Descargar </a>
                  @endif
        
                </div>
             
                      <div class="ml-5">
                        <div class="flex mt-6 lg:mt-0 items-center lg:items-start flex-1 flex-col justify-center text-gray-600 px-5 border-l border-r border-gray-200 border-t lg:border-t-0 pt-5 lg:pt-0">
                          <div class="truncate sm:whitespace-normal flex items-center mt-3"> <i data-feather="user" class="w-4 h-4 mr-2"></i> <b>Usuario:&nbsp; </b>{{$vacacione->user->name}} </div>
                          <div class="truncate sm:whitespace-normal flex items-center mt-3"> <b>Fecha:&nbsp; </b> {{$vacacione->fecha}} </div>
                          <div class="truncate sm:whitespace-normal flex items-center mt-3"> <b>Fecha de Inicio:&nbsp; </b> {{$vacacione->fecha_inicio}} </div>
                          <div class="truncate sm:whitespace-normal flex items-center mt-3"> <b>Fecha de Culminación:&nbsp; </b>{{$vacacione->fecha_culminacion}} </div>
                          <div class="truncate sm:whitespace-normal flex items-center mt-3"> <b>Fecha de Reintegro:&nbsp; </b>{{$vacacione->fecha_reintegro}} </div>
                          <div class="truncate sm:whitespace-normal flex items-center mt-3"> <b>Cantidad de Dias:&nbsp; </b>{{$vacacione->cantidad_dia}} </div>
                          @if($vacacione->solicitud_id == 1)
                          <div class="truncate sm:whitespace-normal flex items-center mt-3"> <b>Fecha de Aprobación:&nbsp; </b>{{$vacacione->fecha_aprobacion}} </div>
                          @endif
                          @if($vacacione->solicitud_id == 2)
                          <div class="truncate sm:whitespace-normal flex items-center mt-3"> <b>Fecha de Rechazo:&nbsp; </b>{{$vacacione->fecha_rechazo}} </div>
                          <div class="truncate sm:whitespace-normal flex items-center mt-3"> <b>Mensaje Rechazo de Solicitud:&nbsp; </b>{{$vacacione->mensaje_rechazo}}</div>
                          @endif
                        </div>
                        <div class="flex mt-6 lg:mt-3 items-center lg:items-start flex-1 flex-col justify-center text-gray-600 px-5 border-l border-r border-gray-200 border-t lg:border-t-0 pt-5 lg:pt-0">
                          <div class="truncate sm:whitespace-normal flex items-center"> <b>Estado de la Solicitud:&nbsp; </b>
                            @if(isset($vacacione->solicitud_id))
                            {{$vacacione->solicitud->nombre}}
                             
                            @endif
                            
                                                 
                        </div>

                        <!-- BEGIN: Recent Activities -->
                          <div class="col-span-12 md:col-span-6 xl:col-span-4 xxl:col-span-12 mt-3">
                              <div class="intro-x flex items-center h-10">
                                  <h2 class="text-lg font-medium truncate mr-5">
                                      Estado de la Solicitud
                                  </h2>

                              </div>
                         
                          @foreach($historico_vacaciones as $key => $historico)
                            
                          <div class="report-timeline mt-5 relative">
                              <div class="intro-x relative flex items-center mb-3">
                                  <div class="report-timeline__image">
                                      <div class="w-10 h-10 flex-none image-fit rounded-full overflow-hidden">
                                         <img src="{{asset('images/botones/'.$historico->order .'.png')}}" alt="">
                                      </div>
                                  </div>
                                  <div class="box px-5 py-3 ml-4 flex-1 zoom-in">
                                      <div class="flex items-center">
                                          <div class="font-medium">
                                            <div class="truncate sm:whitespace-normal flex items-center mt-3"> <b>Estado:&nbsp; </b>{{$historico->solicitud->nombre}} </div>
                                          </div>
                                          
                                      </div>
                                      @isset($historico->mensaje)
                                      <div class="flex items-center">
                                        <div class="font-medium">
                                          <div class="truncate sm:whitespace-normal flex items-center mt-3"> <b>Mensaje:&nbsp; </b>{{$historico->mensaje}} </div>
                                        </div>
                                        
                                    </div>
                                      @endisset
                                      
                                      <div class="text-gray-600 mt-1">
                                          @isset($historico->user_id)
                                            <div class="truncate sm:whitespace-normal flex items-center mt-3"> <b>Usuario:&nbsp; </b> 
                                            {{$historico->user->name}} 
                                            </div>
                                            @endisset 
                                      </div>
                                      <div class="text-xs text-gray-500 ml-auto">
                                        <div class="truncate sm:whitespace-normal flex items-center mt-3"> <b>Fecha:&nbsp; </b>{{date('d-m.Y', strtotime($historico->created_at))}} </div>
                                      </div>
                                  </div>
                              </div>
                          </div>
                          @endforeach
                          
                        </div>

                       
                                
                            </div>
                            <!-- END: Recent Activities -->
                    </div>
                
                <!-- END: Profile Info -->

                @include('vacaciones.modal-rechazo')

                @include('vacaciones.modal-aprobacion')
@endsection

@push('scripts-js')
  <script src="{{asset('js/validator/jquery.validate.min.js')}}"></script>

  <script src="{{asset('js/validator/messages_es.js')}}"></script>

  <script>
    $(document).ready(function(){

      $("#aprobar_vacaciones").validate(function(){
        
      });

      $('#saldo').click(function(){
        //alert($('#dias_solicitados').val());

        var dias_solicitados = $('#dias_solicitados').val();
        var dias_acumulados = $('#dias_acumulados').val();
        var saldo = 0;


        $("#saldo").attr("value", dias_acumulados - dias_solicitados);

      });

      //$('.error').attr('style', 'color:red');

    }); 
  </script> 
@endpush
