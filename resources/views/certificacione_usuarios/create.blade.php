@extends('layouts.master')

@section('title')
  <a href="{{route('certificacione_usuarios.index')}}" class="btn btn-outline-primary" data-toggle="tooltip" data-placement="top" title="Certificaciones de los Usuario Registradas">
      <i class="fa fa-list"></i>
  </a>
  Registros
@endsection

@section('content')

    

  <div class="page-header">
    <h2 class="text-center"> <i class="fa fa-archway"></i> Registrar Nueva Habilidad de Usuario </h2>
  </div>

    {{ Form::open(array('route' => 'certificacione_usuarios.store')) }}
    
    <div class="col-md-12">
        <div class="panel panel-primary">
            <div class="row">
                <div class="form-group col-md-4 col-lg-4 offset-md-1 offset-lg-1 col-12" >
                    {!! Form::label('Usuario') !!}
                    {!! Form::select('user_id',$user,  null, ['class' => 'form-control', 'placeholder'=>'Selecciona'])!!}
                    
                    @if ($errors->has('user_id'))
                        <small class="form-text text-danger">
                            {{ $errors->first('user_id') }}
                        </small>
                    @endif
                </div>

                <div class="form-group col-md-4 col-lg-4 offset-md-1 offset-lg-1 col-12" >
                    {!! Form::label('Certificación') !!}
                    {!! Form::select('certificacione_id',$certificacione, null, ['class' => 'form-control', 'placeholder'=>'Selecciona'])!!}
                    @if ($errors->has('certificacione_id'))
                    <small class="form-text text-danger">
                        {{ $errors->first('certificacione_id') }}
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

