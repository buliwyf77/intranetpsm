@extends('layouts.master')

@section('title')
<a href="{{route('contratos.index')}}" class="btn btn-outline-primary" data-toggle="tooltip" data-placement="top" title="Contratos Registrados">
    <i class="fa fa-list"></i>
</a>
Registro de Contrato
@endsection

@section('content')

<div class="content">

    

    <div class="grid grid-cols-12 gap-6 mt-5">
      <div class="intro-y col-span-12 lg:col-span-6">
          {{ Form::open(array('route' => 'contratos.store', 'enctype' => 'multipart/form-data')) }}

          <div class="intro-y box p-5">
            
            <b>Usuario: </b>  {{$user->name}}
            <hr>
            {{Form::hidden('user_id', $user->id)}}
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
                    {!! Form::label('Horas de Trabajo') !!}
                    {!! Form::text('horas_trabajo',  null, ['class' => 'input w-full border mt-2', 'placeholder'=>'Horas de Trabajo'])!!}
                    @if ($errors->has('horas_trabajo'))
                    <small style="color:red">
                        *{{ $errors->first('horas_trabajo') }}
                    </small>
                    @endif
                </div>
                <div class="mt-3">
                    {!! Form::label('Monto del Sueldo') !!}
                    {!! Form::text('monto_sueldo',  null, ['class' => 'input w-full border mt-2', 'placeholder'=>'Monto del Sueldo'])!!}
                    @if ($errors->has('monto_sueldo'))
                    <small style="color:red">
                        *{{ $errors->first('monto_sueldo') }}
                    </small>
                    @endif
                </div>
                <div class="mt-3">
                    {!! Form::label('Tipo de Contrato') !!}
                    {!! Form::select('tipo_contrato_id',$tipo_contrato,  null, ['class' => 'input w-full border mt-2', 'placeholder'=>'Tipo de Contrato'])!!}
                    @if ($errors->has('tipo_contrato_id'))
                    <small style="color:red">
                        *{{ $errors->first('tipo_contrato_id') }}
                    </small>
                    @endif
                </div>
                
                <div class="mt-3">
                    {!! Form::label('Cargos') !!}
                    {!! Form::select('cargo_id',$cargo,  null, ['class' => 'input w-full border mt-2', 'placeholder'=>'Cargos'])!!}
                    @if ($errors->has('cargo_id'))
                    <small style="color:red">
                        *{{ $errors->first('cargo_id') }}
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

@endsection

