<script src="{{ asset('ckeditor/ckeditor.js') }}"></script>
@extends('layouts.master')

@section('title')
        Psm | Certificaciones de los Usuarios
@endsection


@section('content')

  <div class="page-header">
    <h2 class="text-center"> <i class="fa fa-archway"></i> Editar</h2>
  </div>

  {{Form::model($certificacione_usuario, ['route' => ['certificacione_usuarios.update', $certificacione_usuario->id], 'method' => 'patch'])}}

  <div class="col-md-8 col-md-offset-2">
    <div class="panel panel-primary">
      <div class="panel-body">
        <div class="row">
            <div class="col-md-6 col-md-offset-1">
                {{  Form::label('Usuario:') }}
                {!! Form::select('user_id',$user,  null, ['class' => 'form-control', 'placeholder'=>'Selecciona', 'required'])!!}
            </div>
            <div class="col-md-6 col-md-offset-1">
              {{  Form::label('Titulo:') }}
              {!! Form::select('titulo_id',$titulo,  null, ['class' => 'form-control', 'placeholder'=>'Selecciona', 'required'])!!}
            </div>
        </div>
        <div class="row">
          <div class="col-md-6 my-3">
            {{ Form::submit('Guardar', array('class' => 'btn btn-success')) }}
            {{ Form::close() }}
          </div>
        </div>
      </div>
    </div>
  </div>

@endsection
