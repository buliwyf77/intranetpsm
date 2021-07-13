@extends('layouts.master')

@section('title')
  <a href="{{route('areas.index')}}" class="btn btn-outline-primary" data-toggle="tooltip" data-placement="top" title="Areas Registradas">
      <i class="fa fa-list"></i>
  </a>
  Editar Título
@endsection

@section('content')

<div class="content">
    <div class="grid grid-cols-12 gap-6 mt-5">
        <div class="intro-y col-span-12 lg:col-span-6">

          {{Form::model($titulo, ['route' => ['titulos.update', $titulo->id], 'method' => 'patch'])}}

            <div class="intro-y box p-5">
                <div class="mt-3">
                    {!! Form::label('Título') !!}
                    {!! Form::text('nombre',  null, ['class' => 'input w-full border mt-2', 'placeholder'=>'Nombre'])!!}
                    @if ($errors->has('nombre'))
                    <small style="color:red">
                        *{{ $errors->first('nombre') }}
                    </small>
                    @endif
                </div>

                <div class="mt-3">
                    {!! Form::label('Descripción') !!}
                    {!! Form::text('descripcion',  null, ['class' => 'input w-full border mt-2', 'placeholder'=>'Descripción'])!!}
                    @if ($errors->has('descripcion'))
                    <small style="color:red">
                        *{{ $errors->first('descripcion') }}
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