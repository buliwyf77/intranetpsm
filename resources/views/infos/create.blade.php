@extends('layouts.master')

@section('title')
  <a href="{{route('infos.index')}}" class="btn btn-outline-primary" data-toggle="tooltip" data-placement="top" title="Registrados">
      <i class="fa fa-list"></i>
  </a>
  Registro de la Información
@endsection

@section('content')

    

  <div class="page-header">
    <h2 class="text-center"> <i class="fa fa-book"></i> Registrar Nuevo Detalle </h2>
  </div>

    {{ Form::open(array('route' => 'infos.store', 'enctype' => 'multipart/form-data')) }}

    <div class="col-md-12">
        <div class="panel panel-primary">
            <div class="row">
                
                <div class="form-group col-md-4 col-lg-4 offset-md-1 offset-lg-1 col-12" >
                    {!! Form::label('Fecha de Nacimiento') !!}
                    {!! Form::date('fecha_nacimiento', null, ['class' => 'form-control', 'placeholder'=>'Fecha de Nacimiento'])!!}            
                
                    @if ($errors->has('fecha_nacimiento'))
                    <small class="form-text text-danger">
                        {{ $errors->first('fecha_nacimiento') }}
                    </small>
                @endif
                </div>

                <div class="form-group col-md-4 col-lg-4 offset-md-1 offset-lg-1 col-12" >
                    {!! Form::label('Fecha de Ingreso') !!}
                    {!! Form::date('fecha_ingreso', null, ['class' => 'form-control', 'placeholder'=>'Fecha de Ingreso'])!!}            
                
                    @if ($errors->has('fecha_ingreso'))
                    <small class="form-text text-danger">
                        {{ $errors->first('fecha_ingreso') }}
                    </small>
                @endif
                </div>

                <div class="form-group col-md-4 col-lg-4 offset-md-1 offset-lg-1 col-12" >
                        {!! Form::label('Nacionalidad') !!}
                        {!! Form::text('nacionalidad', null, ['class' => 'form-control', 'placeholder'=>'Nacionalidad'])!!}            
                       
                        @if ($errors->has('nacionalidad'))
                        <small class="form-text text-danger">
                            {{ $errors->first('nacionalidad') }}
                        </small>
                    @endif
                </div>

                <div class="form-group col-md-4 col-lg-4 offset-md-1 offset-lg-1 col-12" >
                    {!! Form::label('Rut') !!}
                    {!! Form::text('rut', null, ['class' => 'form-control', 'placeholder'=>'Rut'])!!}            
                   
                    @if ($errors->has('rut'))
                    <small class="form-text text-danger">
                        {{ $errors->first('rut') }}
                    </small>
                @endif
                </div>

                <div class="form-group col-md-4 col-lg-4 offset-md-1 offset-lg-1 col-12" >
                    {!! Form::label('Pasaporte') !!}
                    {!! Form::text('pasaporte', null, ['class' => 'form-control', 'placeholder'=>'Pasaporte'])!!}            
                   
                @if ($errors->has('pasaporte'))
                    <small class="form-text text-danger">
                        {{ $errors->first('pasaporte') }}
                    </small>
                @endif
                </div>

                <div class="form-group col-md-4 col-lg-4 offset-md-1 offset-lg-1 col-12" >
                    {!! Form::label('Dirección') !!}
                    {!! Form::text('direccion', null, ['class' => 'form-control', 'placeholder'=>'Dirección'])!!}            
                   
                    @if ($errors->has('direccion'))
                    <small class="form-text text-danger">
                        {{ $errors->first('direccion') }}
                    </small>
                @endif
                </div>

                <div class="form-group col-md-4 col-lg-4 offset-md-1 offset-lg-1 col-12" >
                    {!! Form::label('Telefono') !!}
                    {!! Form::text('telefono', null, ['class' => 'form-control', 'placeholder'=>'Telefono'])!!}            
                   
                    @if ($errors->has('telefono'))
                    <small class="form-text text-danger">
                        {{ $errors->first('telefono') }}
                    </small>
                @endif
                </div>

                <div class="form-group col-md-4 col-lg-4 offset-md-1 offset-lg-1 col-12" >
                    {!! Form::label('Imagen') !!}
                    {!! Form::file('imagen', null, ['class' => 'form-control', 'placeholder'=>'Imagen'])!!}            
                   
                    @if ($errors->has('imagen'))
                    <small class="form-text text-danger">
                        {{ $errors->first('imagen') }}
                    </small>
                @endif
                </div>

                <div class="form-group col-md-4 col-lg-4 offset-md-1 offset-lg-1 col-12" >
                    {!! Form::label('Usuario') !!}
                    {!! Form::select('user_id',$user, null, ['class' => 'form-control', 'placeholder'=>'Usuario'])!!}            
                   
                    @if ($errors->has('user_id'))
                    <small class="form-text text-danger">
                        {{ $errors->first('user_id') }}
                    </small>
                    @endif
                </div>

                
                <div class="form-group col-md-4 col-lg-4 offset-md-1 offset-lg-1 col-12">
                    {{ Form::submit('Guardar', array('class' => 'btn btn-success')) }}
        
                    {{ Form::close() }}
        
                </div>
        
            </div>
        </div>
      
    </div>
      
@endsection

