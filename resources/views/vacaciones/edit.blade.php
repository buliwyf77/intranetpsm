@extends('layouts.master')

@section('title')
  <a href="{{route('vacaciones.index')}}" class="btn btn-outline-primary" data-toggle="tooltip" data-placement="top" title="Vacaciones Registradas">
      <i class="fa fa-list"></i>
  </a>
  Editar 
@endsection

@section('content')

<div class="content">
    <div class="grid grid-cols-12 gap-6 mt-5">
        <div class="intro-y col-span-12 lg:col-span-6">

          {{Form::model($vacacione, ['route' => ['vacaciones.update', $vacacione->id], 'method' => 'patch'])}}

            <div class="intro-y box p-5">
                <div class="mt-3">
                    {!! Form::label('Fecha') !!}
                    {!! Form::date('fecha',  null, ['class' => 'input w-full border mt-2', 'placeholder'=>'Fecha'])!!}
                    @if ($errors->has('fecha'))
                    <small style="color:red">
                        *{{ $errors->first('fecha') }}
                    </small>
                    @endif
                </div>
                <div class="mt-3">
                    {!!  Form::label('Usuario') !!}
                    {!! Form::select('user_id', $user, null, ['class' => 'input w-full border mt-2', 'placeholder'=>'Usuario'])!!}
                 @if ($errors->has('user_id'))
                <small style="color:red">
                    *{{ $errors->first('user_id') }}
                </small>
                @endif
                </div>
                <div class="mt-3">
                    {!! Form::label('Dias Solicitados') !!}
                    {!! Form::number('cantidad_dia',  null, ['class' => 'input w-full border mt-2', 'placeholder'=>'Dias Solicitados'])!!}
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
                <div class="mt-3">
                  {!! Form::label('Fecha de Culminación') !!}
                  {!! Form::date('fecha_culminacion',  null, ['class' => 'input w-full border mt-2', 'placeholder'=>'Fecha de Culminación'])!!}
                  @if ($errors->has('fecha_culminacion'))
                  <small style="color:red">
                      *{{ $errors->first('fecha_culminacion') }}
                  </small>
                  @endif
                </div>
                <div class="mt-3">
                  {!! Form::label('Fecha de Reintegro') !!}
                  {!! Form::date('fecha_reintegro',  null, ['class' => 'input w-full border mt-2', 'placeholder'=>'Fecha de Reintegro'])!!}
                  @if ($errors->has('fecha_reintegro'))
                  <small style="color:red">
                      *{{ $errors->first('fecha_reintegro') }}
                  </small>
                @endif
                </div>
               
               <div class="mt-3">
                {!! Form::label('Fecha de Aprobación') !!}
                {!! Form::date('fecha_aprobacion',  null, ['class' => 'input w-full border mt-2', 'placeholder'=>'Fecha de Aprobación'])!!}
                @if ($errors->has('fecha_aprobacion'))
                <small style="color:red">
                   *{{ $errors->first('fecha_aprobacion') }}
              </small>
              @endif
              </div>
              {{--<div class="mt-3">
                {!! Form::label('Fecha de Rechazo') !!}
                {!! Form::date('fecha_rechazo',  null, ['class' => 'input w-full border mt-2', 'placeholder'=>'Fecha de Rechazo'])!!}
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
            <div class="text-right mt-5">
              {{ Form::submit('Guardar', array('class' => "button w-24 bg-theme-1 text-white")) }}
              {{ Form::close() }}
          </div>
      </div>
  </div>
  
</div>
</div>

@endsection
