@extends('layouts.master')

@section('title')
  <a href="{{route('aumentos.index')}}" class="btn btn-outline-primary" data-toggle="tooltip" data-placement="top" title="Aumento Registrado">
      <i class="fa fa-list"></i>
  </a>
  Editar 
@endsection

@section('content')

<div class="content">
    <div class="grid grid-cols-12 gap-6 mt-5">
        <div class="intro-y col-span-12 lg:col-span-6">

          {{Form::model($aumento, ['route' => ['aumentos.update', $aumento->id], 'method' => 'patch'])}}

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
                    {!! Form::label('Ciudad') !!}
                    {!! Form::text('ciudad',  null, ['class' => 'input w-full border mt-2', 'placeholder'=>'Ciudad'])!!}
                    @if ($errors->has('ciudad'))
                    <small style="color:red">
                        *{{ $errors->first('ciudad') }}
                    </small>
                    @endif
                </div>
                {{--<div class="mt-3">
                  {!! Form::label('Fecha de Aprobación') !!}
                  {!! Form::date('fecha_aprobacion',  null, ['class' => 'input w-full border mt-2', 'placeholder'=>'Fecha de Aprobación'])!!}
                  @if ($errors->has('fecha_aprobacion'))
                  <small style="color:red">
                     *{{ $errors->first('fecha_aprobacion') }}
                </small>
                @endif
                </div>
                <div class="mt-3">
                  {!! Form::label('Fecha de Rechazo') !!}
                  {!! Form::date('fecha_rechazo',  null, ['class' => 'input w-full border mt-2', 'placeholder'=>'Fecha de Rechazo'])!!}
                @if ($errors->has('fecha_rechazo'))
                <small style="color:red">
                    *{{ $errors->first('fecha_rechazo') }}
                </small>
               @endif
               </div>--}}
               <div class="mt-3">
                  {!! Form::label('Directivos') !!}
                  {!! Form::select('directivo_id', $directivo, null, ['class' => 'input w-full border mt-2', 'placeholder'=>'Directivos'])!!}
                @if ($errors->has('directivo_id'))
                <small style="color:red">
                    *{{ $errors->first('directivo_id') }}
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
                {{--<div class="mt-3">
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
