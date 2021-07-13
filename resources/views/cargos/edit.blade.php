@extends('layouts.master')

@section('title')
  <a href="{{route('cargos.index')}}" class="btn btn-outline-primary" data-toggle="tooltip" data-placement="top" title="Cargos Registrados">
      <i class="fa fa-list"></i>
  </a>
  Editar Cargo
@endsection

@section('content')

<div class="content">
    <div class="grid grid-cols-12 gap-6 mt-5">
        <div class="intro-y col-span-12 lg:col-span-6">

          {{Form::model($cargo, ['route' => ['cargos.update', $cargo->id], 'method' => 'patch'])}}
 
            <div class="intro-y box p-5">
                <div class="mt-3">
                    {!! Form::label('Cargo') !!}
                    {!! Form::text('nombre',  null, ['class' => 'input w-full border mt-2', 'placeholder'=>'Cargo'])!!}
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
                <div class="mt-3">
                  {!! Form::label('Función') !!}
                  {!! Form::textarea('funcion',  null, ['class' => 'input w-full border mt-2', 'placeholder'=>'Funciones', 'rows' => 3])!!}
                  @if ($errors->has('funcion'))
                  <small style="color:red">
                      *{{ $errors->first('funcion') }}
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

