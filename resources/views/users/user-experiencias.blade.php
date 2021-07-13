<!-- EXPERIENCIA LABORAL -->

<div align="right">
    <a class="button w-24 mr-1 mb-2 bg-theme-1 text-white" href="javascript:;" data-toggle="modal" data-target="#registerExperiencia"> Agregar </a>
</div>
<div class="intro-y datatable-wrapper box px-5 pt-5 mt-5">
    <table class="table table-report table-report--bordered display datatable w-full">
        <thead>
        <tr class="info">
            <th class="border-b-4 whitespace-no-wrap"> N° </th>    
            <th class="border-b-4 whitespace-no-wrap"> Empresa </th>    
            <th class="border-b-6 whitespace-no-wrap"> Desde </th>  
            <th class="border-b-6 whitespace-no-wrap"> Hasta </th>
            <th class="border-b-6 whitespace-no-wrap"> Cargo </th>
            <th class="border-b-6 whitespace-no-wrap"> Funciones </th>                      
            <th align="right"> <i data-feather="settings"></i> </th>
        </tr>
        </thead>
        <tbody>
            @foreach ($user->experiencias as $key => $exp)
            <tr>
                <td> {{$key+1}} </td>
                <td> {{$exp->empresa}}</td>
                <td> {{  date('d-m-Y', strtotime($exp->fecha_inicio))}} </td>
                <td> {{  date('d-m-Y', strtotime($exp->fecha_termino))}} </td>
                <td> {{$exp->cargo}} </td>
                <td>
                    @if(($exp->funciones) != null)  
                        {{$exp->funciones}}
                    @endif
                </td>
                
                <td>
                    <div class="btn-group btn-group-sm btn-group-toggle float-right" role="group" aria-label="Acciones">
                        <a href="{{route('experiencias.edit', $exp->id)}}" data-toggle="modal"  class="btn btn-primary btn-sm"> <i data-feather="edit"></i> </a>
                        {!! Form::model($exp, ['method' => 'delete', 'route' => ['experiencias.destroy', $exp->id], 'class' =>'form-inline form-delete']) !!}
                        {!! Form::hidden('id', $exp->id) !!}
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

<!-- END EXPERIENCIA LABORAL -->

<div class="modal" id="registerExperiencia">
    <div class="modal__content p-10"> 
        <div class="grid grid-cols-12 gap-6 mt-5">
            <div class="intro-y col-span-12 lg:col-span-12">
                {{ Form::open(array('route' => 'experiencias.store')) }}
                
                {{Form::hidden('user_id', $user->id)}}

                <div class="intro-y box p-5">
                    <div class="mt-3">
                        {!! Form::label('Empresa') !!}
                        {!! Form::text('empresa',  null, ['class' => 'input w-full border mt-2', 'placeholder'=>'Empresa'])!!}
                        @if ($errors->has('empresa'))
                        <small style="color:red">
                            *{{ $errors->first('empresa') }}
                        </small>
                        @endif
                    </div>
    
                    <div class="mt-3">
                        {!! Form::label('Fecha de Inicio') !!}
                        {!! Form::date('fecha_inicio',  null, ['class' => 'input w-full border mt-2', 'placeholder'=>'Fecha de Inicio'])!!}
                        @if ($errors->has('fecha_inicio'))
                        <small style="color:red">
                            *{{ $errors->first('fecha_inicio') }}
                        </small>
                        @endif
                    </div>
    
                    <div class="mt-3">
                        {!!  Form::label('Fecha de Termino') !!}
                        {!!  Form::date('fecha_termino', null, ['class' => 'input w-full border mt-2', 'placeholder'=>'Fecha de Termino'])!!}
                        @if ($errors->has('fecha_termino'))
                        <small style="fecha_termino:red">
                            *{{ $errors->first('fecha_termino') }}
                        </small>
                        @endif
                    </div>
                    <div class="mt-3">
                        {!!  Form::label('Cargo') !!}
                        {!! Form::text('cargo', null, ['class' => 'input w-full border mt-2', 'placeholder'=>'Cargo'])!!}
                        @if ($errors->has('cargo'))
                        <small style="cargo:red">
                            *{{ $errors->first('cargo') }}
                        </small>
                        @endif
                    </div>
                    <div class="mt-3">
                        {!!  Form::label('Funciones') !!}
                        {!! Form::textarea('funciones', null, ['class' => 'input w-full border mt-2', 'placeholder'=>'Funciones', 'rows'=>3])!!}
                        @if ($errors->has('funciones'))
                        <small style="funciones:red">
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



