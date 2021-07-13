@extends('layouts.master')

@section('title')
  <!-- Boton Index -->
@endsection

@section('content')
<h1 class="text-4xl text-theme-1 font-medium leading-none"> Aumento Registrado</h1>
  <!-- BEGIN: Profile Info -->
              
                <div align="right">
                  @if((Auth::user()->role_id == 4) && ($aumento->solicitud_id == 3))
                  <a class="button w-24 mr-1 mb-2 bg-theme-9 text-white" href="{{route('aumentos.aprobar', $aumento->id)}}"> Aprobar </a>
                  <a class="button w-24 mr-1 mb-2 bg-theme-6 text-white" data-toggle="modal" data-target="#modal-rechazo" href="#"> Rechazar </a>
                  @endif
                  @if(Auth::id()==$aumento->user_id && $aumento->solicitud_id == 3)
                  <a class="button w-24 mr-1 mb-2 bg-theme-1 text-white" href="{{route('aumentos.edit', $aumento->id)}}"> Editar </a>
                  @endif
                 
                  @if(Auth::id()==$aumento->user_id && $aumento->solicitud_id == 1)
                  <a class="button w-24 mr-1 mb-2 bg-theme-7 text-white" href="{{route('aumentos.downloadPDF', $aumento->id)}}"> Descargar </a>
                  @endif

                  @if(Auth::user()->role_id == 4)
                  <a class="button w-24 mr-1 mb-2 bg-theme-7 text-white" href="{{route('aumentos.downloadPDF', $aumento->id)}}"> Descargar </a>
                  @endif

                </div>
                 
                      <div class="ml-5">
                        <div class="flex mt-6 lg:mt-0 items-center lg:items-start flex-1 flex-col justify-center text-gray-600 px-5 border-l border-r border-gray-200 border-t lg:border-t-0 pt-5 lg:pt-0">
                          <div class="truncate sm:whitespace-normal flex items-center mt-3"> <i data-feather="user" class="w-4 h-4 mr-2"></i> <b>Usuario:&nbsp; </b>{{$aumento->user->name}} </div>
                          <div class="truncate sm:whitespace-normal flex items-center mt-3">  <b>Fecha:&nbsp; </b>{{$aumento->fecha}} </div>
                        </div>
                        <div class="flex mt-6 lg:mt-0 items-center lg:items-start flex-1 flex-col justify-center text-gray-600 px-5 border-l border-r border-gray-200 border-t lg:border-t-0 pt-5 lg:pt-0">
                         
                          <!-- BEGIN: Recent Activities -->
                          <div class="col-span-12 md:col-span-6 xl:col-span-4 xxl:col-span-12 mt-3">
                              <div class="intro-x flex items-center h-10">
                                  <h2 class="text-lg font-medium truncate mr-5">
                                      Estado de la Solicitud
                                  </h2>

                              </div>
                          @foreach($historico_aumentos as $key => $historico)
                         
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

                @include('aumentos.modal-rechazo')

                {{--@include('aumentos.modal-aprobacion')--}}
      
@endsection
