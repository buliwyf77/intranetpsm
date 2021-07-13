@extends('layouts.master')

@section('title')
  <a href="{{route('experiencias.index')}}" class="btn btn-outline-primary" data-toggle="tooltip" data-placement="top" title="Experiencia">
      <i class="fa fa-list"></i>
  </a>
  Editar
@endsection

@section('content')

<div class="content">
    <div class="grid grid-cols-12 gap-6 mt-5">
        <div class="intro-y col-span-12 lg:col-span-6">
          {{Form::model($experiencia, ['route' => ['experiencias.update', $experiencia->id], 'method' => 'patch'])}}
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
                  {!! Form::date('fecha_termino',  null, ['class' => 'input w-full border mt-2', 'placeholder'=>'Fecha de Termino'])!!}
                  @if ($errors->has('fecha_termino'))
                  <small style="color:red">
                      *{{ $errors->first('fecha_termino') }}
                  </small>
                  @endif
              </div>
              <div class="mt-3">
                {!! Form::label('Cargo') !!}
                {!! Form::text('cargo',  null, ['class' => 'input w-full border mt-2', 'placeholder'=>'Cargo'])!!}
                @if ($errors->has('cargo'))
                <small style="color:red">
                    *{{ $errors->first('cargo') }}
                </small>
                @endif
              </div>
              <div class="mt-3">
              {!! Form::label('Funciones') !!}
              {!! Form::textarea('funciones',  null, ['class' => 'input w-full border mt-2', 'placeholder'=>'Funciones', 'rows' => 3])!!}
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

@endsection

