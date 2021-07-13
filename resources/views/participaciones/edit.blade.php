@extends('layouts.master')

@section('title')
  <a href="{{route('participaciones.index')}}" class="btn btn-outline-primary" data-toggle="tooltip" data-placement="top" title="Participaciones Registradas">
      <i class="fa fa-list"></i>
  </a>
  Editar Participaciones
@endsection

@section('content')

<div class="content">
    <div class="grid grid-cols-12 gap-6 mt-5">
        <div class="intro-y col-span-12 lg:col-span-6">

          {{Form::model($participacione, ['route' => ['participaciones.update', $participacione->id], 'method' => 'patch'])}}

            <div class="intro-y box p-5">
              <div class="mt-3">
                {!! Form::label('Proyectos') !!}
                {!! Form::select('proyecto_id',$proyecto, null, ['class' => 'input w-full border mt-2', 'placeholder'=>'Proyectos'])!!}
                @if ($errors->has('proyecto'))
                <small style="color:red">
                    *{{ $errors->first('proyecto') }}
                </small>
                @endif
            </div>

            {{Form::hidden('user_id', $participacione->user_id)}}
                     
                <div class="mt-3">
                    {!! Form::label('Funciones') !!}
                    {!! Form::textarea('funciones',  null, ['class' => 'input w-full border mt-2 summernote', 'placeholder'=>'Funciones', 'rows' => 3])!!}
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

