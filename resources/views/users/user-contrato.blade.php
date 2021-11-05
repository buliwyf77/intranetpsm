<div align="right">
    @if(Auth::user()->role_id == 4 || Auth::user()->role_id == 1)
    <a class="button w-24 mr-1 mb-2 bg-theme-1 text-white" href="{{route('contratos.create', $user->id)}}"> Agregar </a>
    @endif
  </div>
  <br>
<div class="intro-y datatable-wrapper box p-4 mt-0">

    <table class="table table-report table-report--bordered display datatable w-full">
        <thead>
          <tr class="info">
            <th> # </th>
            <th class="border-b-4 whitespace-no-wrap"> Inicio </th>    
            <th class="border-b-4 whitespace-no-wrap"> horas </th>    
            <th class="border-b-4 whitespace-no-wrap"> Sueldo </th> 
            <th class="border-b-4 whitespace-no-wrap"> Tipo </th>
            <th class="border-b-4 whitespace-no-wrap"> Cargo </th>
            <th class="border-b-4 whitespace-no-wrap"> Contrato </th>
            <th class="border-b-4 whitespace-no-wrap"> Anexos </th>               
            <th align="right"> <i data-feather="settings"></i> </th>
          </tr>
        </thead>
    
        <tbody>
  
            @foreach ($user->contratos as $key => $contrat)
            <tr>
                <td> {{ $key + 1 }}</td>
                <td> {{ date('d-m-Y', strtotime($contrat->fecha_inicio))}} </td>
                <td> {{ $contrat->horas_trabajo }} </td>
                <td>
                    $ {{ number_format($contrat->monto_sueldo, 2, ',', '.')  }}
                </td>

                <td> {{$contrat->tipo_contrato->nombre}} </td>
               
                <td> {{ $contrat->cargo->nombre}} </td>
                <td>
                    <a href="{{$contrat->archivo}}" target="_blank" class="btn btn-primary btn-sm" data-toggle="tooltip" data-placement="bottom" title="Descargar Contrato"> <i data-feather="file-text"></i> </a>
                </td>
                <td>  
                    @foreach ($contrat->anexos as $anexo)
                        <b> <a href="javascript:;" data-toggle="modal" data-target="#anexo{{$anexo->id}}">
                            {{date('d-m-Y',strtotime($anexo->fecha))}} </a> 
                        </b> <br>
                        <div class="modal" id="anexo{{$anexo->id}}">
                            <div class="modal__content p-10"> 
                                <div class="grid grid-cols-12 gap-6 mt-5">
                                    <div class="intro-y col-span-12 lg:col-span-12">
                                        <h3 class="text-2xl text-theme-1 font-medium leading-none mt-5">Anexo de Contrato</h3>
                                        <div align="right">
                                            <a href="{{route('anexos.add', $anexo->id)}}" target="_blank" class="btn btn-primary btn-sm" data-toggle="tooltip" data-placement="bottom" title="Editar Anexo de Contrato"> <i data-feather="edit"></i> </a>
                                            <a href="{{route('anexos.add', $anexo->id)}}" class="btn btn-primary btn-sm" data-toggle="tooltip" data-placement="bottom" title="Eliminar Anexo de Contrato"> <i data-feather="trash-2"></i> </a>
                                        </div>
                                        
                                        <div class="intro-y box p-5">
                                            <div class="mt-3">
                                                {!! Form::label('fecha') !!}
                                                <p><b> {{$anexo->fecha}} </b></p>
                                            </div>
                                            <div class="mt-3">
                                                {!! Form::label('Tipo') !!}
                                                <p><b> {{$anexo->tipo_contrato->nombre}} </b></p>
                                            </div>
                                            <div class="mt-3">
                                                {!! Form::label('Descargar Anexo') !!}
                                                <a href="{{$anexo->archivo}}" target="_blank" class="btn btn-primary btn-sm" data-toggle="tooltip" data-placement="bottom" title="Descargar Anexo"> <i data-feather="file-text"></i> </a>
                                            </div>
                                            
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>                        
                    @endforeach
                </td>
                <td>
                    <div class="btn-group btn-group-sm btn-group-toggle float-right" role="group" aria-label="Acciones">
                        @if(Auth::user()->role_id == 4 || Auth::user()->role_id == 1)
                        <a href="{{route('anexos.add', $contrat->id)}}" target="_blank" class="btn btn-primary btn-sm" data-toggle="tooltip" data-placement="bottom" title="Agregar Anexo de Contrato"> <i data-feather="file-plus"></i> </a>
                        <a href="{{route('contratos.edit', $contrat->id)}}" class="btn btn-primary btn-sm" data-toggle="tooltip" data-placement="bottom" title="Editar Contrato"> <i data-feather="edit"></i> </a>
                        {!! Form::model($contrat, ['method' => 'delete', 'route' => ['contratos.destroy', $contrat->id], 'class' =>'form-inline form-delete']) !!}
                        {!! Form::hidden('id', $contrat->id) !!}
                        <button type="submit" name="delete_modal" class="btn btn-danger btn-sm delete" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="Eliminar"><i data-feather="trash-2"></i></button>
                        {!! Form::close() !!}
                        @endif
                    </div>
                </td>
            </tr>
            @endforeach
        </tbody>
    
    </table>
    
  </div>