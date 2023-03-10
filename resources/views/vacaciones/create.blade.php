@extends('layouts.master')

@section('title')
<a href="{{route('vacaciones.index')}}" class="btn btn-outline-primary" data-toggle="tooltip" data-placement="top" title="Vacaciones Registradas">
    <i class="fa fa-list"></i>
</a>
Registro de las Vacaciones
@endsection

@section('content')

<div class="content">

      <div class="grid grid-cols-12 gap-6 mt-5">
        <div class="intro-y col-span-12 lg:col-span-6">
            {{ Form::open(array('route' => 'vacaciones.store', 'enctype' => 'multipart/form-data')) }}
            
            <div class="intro-y box p-5">
                <div class="mt-3">
                    {!! Form::label('Fecha') !!}
                    {!! Form::date('fecha',  \Carbon\Carbon::now(), ['class' => 'input w-full border mt-2', 'readonly' => true])!!}
                    @if ($errors->has('fecha'))
                    <small style="color:red">
                        *{{ $errors->first('fecha') }}
                    </small>
                    @endif
                </div>
                {{--<div class="mt-3">
                    {!!  Form::label('Usuario') !!}
                    {!! Form::select('user_id', $user, null, ['class' => 'input w-full border mt-2', 'placeholder'=>'Usuario'])!!}
                    @if ($errors->has('user_id'))
                    <small style="color:red">
                        *{{ $errors->first('user_id') }}
                    </small>
                    @endif            
                </div>--}}
                <div class="mt-3">
                    @php
                     $habiles = [1 => 1, 2 => 2, 3 => 3, 4 => 4, 5 => 5, 6 => 6, 7 => 7,
                     8 => 8, 9 => 9, 10 => 10, 11 => 11, 12 => 12, 13 => 13, 14 => 14,
                      15 => 15];  
                    @endphp
                    {!!  Form::label('Dias Solicitados') !!}
                    {!!  Form::select('cantidad_dia', $habiles, null, ['class' => 'input w-full border mt-2', 'placeholder'=>'Dias Solicitados'])!!}
                    @if ($errors->has('cantidad_dia'))
                    <small style="color:red">
                        *{{ $errors->first('cantidad_dia') }}
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

               {{--  <div class="mt-3">
                    {!!  Form::label('Fecha de Culminaci??n') !!}
                    {!!  Form::date('fecha_culminacion', null, ['class' => 'input w-full border mt-2', 'placeholder'=>'Fecha de Culminaci??n'])!!}
                    @if ($errors->has('fecha_culminacion'))
                    <small style="color:red">
                        *{{ $errors->first('fecha_culminacion') }}
                    </small>
                    @endif
                </div>
                <div class="mt-3">
                    {!!  Form::label('Fecha de Reintegro') !!}
                    {!!  Form::date('fecha_reintegro', null, ['class' => 'input w-full border mt-2', 'placeholder'=>'Fecha de Reintegro'])!!}
                    @if ($errors->has('fecha_reintegro'))
                    <small style="color:red">
                        *{{ $errors->first('fecha_reintegro') }}
                    </small>
                    @endif
                </div>
                
                {{--<div class="mt-3">
                    {!!  Form::label('Fecha de Aprobaci??n') !!}
                    {!!  Form::date('fecha_aprobacion', null, ['class' => 'input w-full border mt-2', 'placeholder'=>'Fecha de Aprobaci??n'])!!}
                    @if ($errors->has('fecha_aprobacion'))
                    <small style="color:red">
                        *{{ $errors->first('fecha_aprobacion') }}
                    </small>
                    @endif
                </div>--}}
                {{--<div class="mt-3">
                    {!!  Form::label('Fecha de Rechazo') !!}
                    {!!  Form::date('fecha_rechazo', null, ['class' => 'input w-full border mt-2', 'placeholder'=>'Fecha de Rechazo'])!!}
                    @if ($errors->has('fecha_rechazo'))
                    <small style="color:red">
                        *{{ $errors->first('fecha_rechazo') }}
                    </small>
                    @endif
                </div>
             
                <div class="mt-3">
                    {!!  Form::label('Estado de la Solicitud') !!}
                    {!! Form::select('solicitud_id', $solicitudes, null, ['class' => 'input w-full border mt-2', 'placeholder'=>'Estado de la Solicitud'])!!}
                    @if ($errors->has('solicitud_id'))
                    <small style="color:red">
                        *{{ $errors->first('solicitud_id') }}
                    </small>
                    @endif            
                </div>--}}
                <div class="mt-3"> <label>Estoy de acuerdo con la informaci??n suministrada</label>
                    <div class="mt-2"> <input name="de_acuerdo" type="checkbox" class="input input--switch border"> </div>
                    @if ($errors->has('de_acuerdo'))
                    <small style="color:red">
                        *{{ $errors->first('de_acuerdo') }}
                    </small>
                    @endif 
                </div>

                <div class="text-right mt-5">
                    {{ Form::submit('Guardar', array('class' => "button w-24 bg-theme-1 text-white")) }}
                    {{ Form::close() }}
                </div>
            </div>
        </div>
        <div class="intro-y col-span-12 lg:col-span-6">
            <div class="intro-y box p-5">
                <p align = "justify  my-3">
                    <b>PROCEDIMIENTO DE SOLICITUD DE VACACIONES</b> <br>
                    <b>Art??culo 140: </b> Las vacaciones deber??n solicitarse con la anticipaci??n debida, esto es, al menos de 15 (quince) d??as antes para solicitudes 
                    entre 5 a diez d??as h??biles, y un (1) mes de anticipaci??n cuando se soliciten 11 o m??s d??as h??biles.
                </p>
                <hr>
                <p class="mt-3">
                    <span>
                        <b>REGLAMENTO INTERNO DE ORDEN, HIGIENE Y SEGURIDAD</b> <br>
                        PSM Servicios Inform??ticos y Log??sticos LTDA.
                        
                    </span>
                </p>
            </div>
        </div>
    </div>
</div>

@endsection
