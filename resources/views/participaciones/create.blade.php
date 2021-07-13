@extends('layouts.master')

@section('title')
  <a href="{{route('participaciones.index')}}" class="btn btn-outline-primary" data-toggle="tooltip" data-placement="top" title="Participaciones Registradas">
      <i class="fa fa-list"></i>
  </a>
  Registro de la Participacion en los Proyectos
@endsection

@section('content')

  <div class="page-header">
    <h2 class="text-center"> <i class="fa fa-book"></i> Registrar Nueva Participación </h2>
  </div>

    {{ Form::open(array('route' => 'participaciones.store', 'enctype' => 'multipart/form-data')) }}

    <div class="col-md-12">
        <div class="panel panel-primary">
            <div class="row">
                <div class="form-group col-md-4 col-lg-4 offset-md-1 offset-lg-1 col-12" >
                    {!! Form::label('Funciones') !!}
                    {!! Form::text('funciones',  null, ['class' => 'form-control', 'placeholder'=>'Funciones'])!!}
                    
                    @if ($errors->has('funciones'))
                        <small class="form-text text-danger">
                            {{ $errors->first('funciones') }}
                        </small>
                    @endif
                </div>

                <div class="form-group col-md-4 col-lg-4 offset-md-1 offset-lg-1 col-12" >
                    {!! Form::label('Proyecto') !!}
                    {!! Form::select('proyecto_id',$proyectos, null, ['class' => 'form-control', 'placeholder'=>'Selecciona'])!!}            
                @if ($errors->has('proyecto_id'))
                    <small class="form-text text-danger">
                        {{ $errors->first('proyecto_id') }}
                    </small>
                @endif
                </div>

                {{Form::hidden('user_id', $user_id)}}

                <div class="form-group col-md-4 col-lg-4 offset-md-1 offset-lg-1 col-12">
                    {{ Form::submit('Guardar', array('class' => 'btn btn-success')) }}
        
                    {{ Form::close() }}
        
                </div>
        
            </div>
        </div>
      
    </div>
      
@endsection

