@extends('layouts.master')

@section('title')
  <a href="{{route('documentos.index')}}" class="btn btn-outline-primary" data-toggle="tooltip" data-placement="top" title="Ir a Documentos">
      <i class="fa fa-list"></i>
  </a>
  Registro de Documeto
@endsection

@section('content')

<div class="content">
    <div class="grid grid-cols-12 gap-6 mt-5">
        <div class="intro-y col-span-12 lg:col-span-6">
            {{ Form::open(array('route' => 'documentos.store', 'enctype' => 'multipart/form-data')) }}


            <div class="intro-y box p-5">
                <div class="mt-3">
                    {!! Form::label('Nombre') !!}
                    {!! Form::text('nombre',  null, ['class' => 'input w-full border mt-2', 'placeholder'=>'Nombre'])!!}
                    @if ($errors->has('nombre'))
                    <small style="color:red">
                        *{{ $errors->first('nombre') }}
                    </small>
                    @endif
                </div>

                <div class="mt-5"> <label>Documento visible para todos ?</label>
                <div class="mt-2"> <input name="visible" type="checkbox" class="input input--switch border" id="visible" value="1"> </div>

                <div class="mt-3">
                    {!! Form::label('Archivo') !!}
                    {!! Form::file('url', null, ['class' => 'input w-full border mt-2'])!!}
                    @if ($errors->has('url'))
                    <small style="color:red">
                        *{{ $errors->first('url') }}
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