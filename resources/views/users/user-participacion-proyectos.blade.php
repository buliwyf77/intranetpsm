<!-- participaciones en proyectos-->
<div align="right">
  <a class="button w-24 mr-1 mb-2 bg-theme-1 text-white" href="javascript:;" data-toggle="modal" data-target="#registerParticipacion"> Agregar </a>
</div>
<div class="intro-y datatable-wrapper box px-5 pt-5 mt-5">
    <table class="table table-report table-report--bordered display datatable w-full">
        <thead>
        <tr class="info">
            <th class="border-b-4 whitespace-no-wrap"> N° </th>    
            <th class="border-b-4 whitespace-no-wrap"> Proyecto </th>
            <th class="border-b-4 whitespace-no-wrap"> Funciones </th>                
            <th align="right"> <i data-feather="settings"></i> </th>
        </tr>
        </thead>
        <tbody>
            @foreach ($user->participacion_proyectos as $key => $part)
            <tr>
                <td> {{$key+1}} </td>
                <td> {{$part->proyecto->nombre}}</td>
                <td> {!! $part->funciones !!}</td>
                
                <td>
                    <div class="btn-group btn-group-sm btn-group-toggle float-right" role="group" aria-label="Acciones">
                        <a href="{{route('participaciones.edit', $part->id)}}" data-toggle="modal"  class="btn btn-primary btn-sm"> <i data-feather="edit"></i> </a>
                        {!! Form::model($part, ['method' => 'delete', 'route' => ['participaciones.destroy', $part->id], 'class' =>'form-inline form-delete']) !!}
                        {!! Form::hidden('id', $part->id) !!}
                        <button type="submit" name="delete_modal" class="btn btn-danger btn-sm delete" 
                            data-toggle="tooltip" data-placement="bottom" title="" data-original-title="Eliminar">
                            <i data-feather="trash-2"></i>
                        </button>
                        {!! Form::close() !!}
                    </div>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
<!-- END participaciones -->

<div class="modal" id="registerParticipacion">
    <div class="modal__content p-10"> 
        <div class="grid grid-cols-12 gap-6 mt-5">
            <div class="intro-y col-span-12 lg:col-span-12">
                <h3 class="text-2xl text-theme-1 font-medium leading-none mt-5">Registrar Participaciones</h3>
                {{ Form::open(array('route' => 'participaciones.store')) }}
                
                {{Form::hidden('user_id', $user->id)}}

                <div class="intro-y box p-5">
                    <div class="mt-3">
                        {!! Form::label('proyectos') !!}
                        {!! Form::select('proyecto_id',  $proyectos, null, ['class' => 'input w-full border mt-2'])!!}
                        @if ($errors->has('proyecto_id'))
                        <small style="color:red">
                            *{{ $errors->first('proyecto_id') }}
                        </small>
                        @endif
                    </div>

                    <div class="mt-3">
                        {!! Form::label('Funciones en el Proyecto') !!}
                        {!! Form::textarea('funciones', null, ['class' => 'input w-full border mt-2 summernote', 'placeholder' => 'Enumere las funciones en el proyecto', 'rows' => 3])!!}
                        @if ($errors->has('funciones'))
                        <small style="color:red">
                            *{{ $errors->first('funciones') }}
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