@extends('layouts.master')

@section('title')
  <a href="{{route('anexos.index')}}" class="btn btn-outline-primary" data-toggle="tooltip" data-placement="top" title="anexos Registrados">
      <i class="fa fa-list"></i>
  </a>
  Editar anexo
@endsection

@section('content')

<div class="content">
    <div class="grid grid-cols-12 gap-6 mt-5">
        <div class="intro-y col-span-12 lg:col-span-6">

          {{Form::model($anexo, ['route' => ['anexos.update', $anexo->id], 'method' => 'patch', 'enctype' => 'multipart/form-data'])}}
 
          <div class="intro-y box p-5">
            <div class="mt-3">
                {!! Form::label('Usuario') !!}
                <p><b>{{$anexo->contrato->user->name}}</b></p>
                <div class="mt-3">
                    {!! Form::label('Ver Archivo de Anexo') !!}
                    <a href="{{$anexo->archivo}}" target="_blank" class="btn btn-primary btn-sm" data-toggle="tooltip" data-placement="bottom" title="Descargar Anexo"> <i data-feather="file-text"></i> </a>
                </div>
            </div>

            <div class="mt-3">
                {!! Form::label('Fecha') !!}
                {!! Form::date('fecha',  $anexo->fecha, ['class' => 'input w-full border mt-2', 'placeholder'=>'Fecha'])!!}
                @if ($errors->has('fecha'))
                <small style="color:red">
                    *{{ $errors->first('fecha') }}
                </small>
                @endif
            </div>
            
            <div class="mt-3">
                {!! Form::label('Tipo de Contrato') !!}
                {!! Form::select('tipo_contrato_id',$tipo_contrato,  $anexo->tipo_contrato_id, ['class' => 'input w-full border mt-2', 'placeholder'=>'Tipo de Contrato'])!!}
                @if ($errors->has('tipo_contrato_id'))
                <small style="color:red">
                    *{{ $errors->first('tipo_contrato_id') }}
                </small>
                @endif
            </div>

            <div class="mt-3">
                {!! Form::label('Archivo') !!}
                {!! Form::file('archivo', null, ['class' => 'input w-full border mt-5'])!!}
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

