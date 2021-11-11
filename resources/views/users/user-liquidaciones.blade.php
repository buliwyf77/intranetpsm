<!-- LIQUIDACIONES -->

<div align="right">
    <a class="button w-24 mr-1 mb-2 bg-theme-1 text-white" href="javascript:;" data-toggle="modal" data-target="#registrarLiquidacion"> Agregar </a>
  </div>
  <div class="intro-y datatable-wrapper box px-5 pt-5 mt-5">
      <table class="table table-report table-report--bordered display datatable w-full">
          <thead>
          <tr class="info">
              <th class="border-b-4 whitespace-no-wrap"> N° </th>    
              <th class="border-b-4 whitespace-no-wrap"> Fecha </th>
              <th class="border-b-4 whitespace-no-wrap"> Archivo </th>                
              <th align="right"> <i data-feather="settings"></i> </th>
          </tr>
          </thead>
          <tbody>
              @foreach ($user->liquidaciones as $key => $liq)
              <tr>
                  <td> {{$key+1}} </td>
                  <td> {{$liq->fecha}}</td>
                  <td> <a href="{{$liq->archivo}}" target="_blank" class="btn btn-primary btn-sm" data-toggle="tooltip" data-placement="bottom" title="Descargar Contrato"> <i data-feather="file-text"></i> </a> </td>
                  
                  <td>
                      <div class="btn-group btn-group-sm btn-group-toggle float-right" role="group" aria-label="Acciones">
                        {!! Form::model($liq, ['method' => 'delete', 'route' => ['liquidaciones.destroy', $liq->id], 'class' =>'form-inline form-delete']) !!}
                        {!! Form::hidden('id', $liq->id) !!}
                        <button type="submit" name="delete_modal" class="btn btn-danger btn-sm delete" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="Eliminar"><i data-feather="trash-2"></i></button>
                        {!! Form::close() !!}
                      </div>
                  </td>
              </tr>
              @endforeach
          </tbody>
      </table>
  </div>
  <!-- END HABILIDADES -->
  
<div class="modal" id="registrarLiquidacion">
    <div class="modal__content p-10"> 
        <div class="grid grid-cols-12 gap-6 mt-5">
            <div class="intro-y col-span-12 lg:col-span-12">
                <h3 class="text-2xl text-theme-1 font-medium leading-none mt-5">Registrar Habilidad</h3>
                {{ Form::open(array('route' => 'liquidaciones.store', 'enctype' => 'multipart/form-data')) }}

                {{Form::hidden('user_id', $user->id)}}

                <div class="intro-y box p-5">
                    <div class="mt-3">
                        {!! Form::label('Fecha') !!}
                        {!! Form::date('fecha', null, ['class' => 'input w-full border mt-2'])!!}
                        @if ($errors->has('fecha'))
                        <small style="color:red">
                            *{{ $errors->first('fecha') }}
                        </small>
                        @endif
                    </div>

                    <div class="mt-3">
                        {!! Form::label('Archivo') !!}
                        {!! Form::file('archivo', null, ['class' => 'input w-full border mt-2'])!!}
                        @if ($errors->has('archivo'))
                        <small style="color:red">
                            *{{ $errors->first('archivo') }}
                        </small>
                        @endif
                    </div>
                    
                    <div class="text-right mt-5">
                        {{ Form::submit('Guardar', array('class' => "button w-24 bg-theme-1 text-white")) }}
                        {{ Form::close() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>