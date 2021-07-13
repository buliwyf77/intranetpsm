<script src="{{ asset('ckeditor/ckeditor.js') }}"></script>
@extends('layouts.master')

@section('title')
        Psm | Infos
@endsection


@section('content')

  <div class="page-header">
    <h2 class="text-center"> <i class="fa fa-book"></i> Editar </h2>
  </div>




  {!! Form::model($info, array('route'=>array('infos.update', $info->id))) !!}

  <input type="hidden" name="_method" value="PUT">

  <div class="col-md-8 col-md-offset-2">
    <div class="panel panel-primary">
      <div class="panel-heading">
        <h3 class="panel-title">Info</h3>
      </div>
      <div class="panel-body">
        
        <div class="row">
            <div class="col-lg-6 col-md-6 col-12  ">

         <div class="form-group col-md-8 col-md-offset-2">
              {{  Form::label('Fecha de Nacimiento:') }}
              {!! Form::text('fecha_nacimiento',  null, ['class' => 'form-control', 'placeholder'=>'Fecha de Nacimiento', 'required'])!!}
          </div>

          <div class="form-group col-md-8 col-md-offset-2">
            {{  Form::label('Fecha de Ingreso:') }}
            {!! Form::text('fecha_ingreso',  null, ['class' => 'form-control', 'placeholder'=>'Fecha de Ingreso', 'required'])!!}
        </div>

        <div class="form-group col-md-8 col-md-offset-2">
            {{  Form::label('Nacionalidad:') }}
            {!! Form::text('nacionalidad',  null, ['class' => 'form-control', 'placeholder'=>'Nacionalidad'])!!}
        </div>

        <div class="form-group col-md-8 col-md-offset-2">
          {{  Form::label('Rut:') }}
          {!! Form::text('rut',  null, ['class' => 'form-control', 'placeholder'=>'Rut'])!!}
        </div>

        <div class="form-group col-md-8 col-md-offset-2">
          {{  Form::label('Pasaporte:') }}
          {!! Form::text('pasaporte',  null, ['class' => 'form-control', 'placeholder'=>'Pasaporte'])!!}
        </div>

        <div class="form-group col-md-8 col-md-offset-2">
          {{  Form::label('Dirección:') }}
          {!! Form::text('direccion',  null, ['class' => 'form-control', 'placeholder'=>'Dirección'])!!}
        </div>

        <div class="form-group col-md-8 col-md-offset-2">
          {{  Form::label('Telefono:') }}
          {!! Form::text('telefono',  null, ['class' => 'form-control', 'placeholder'=>'Telefono'])!!}
        </div>

        <div class="form-group col-md-8 col-md-offset-2">
          {{  Form::label('Imagen:') }}
          {!! Form::file('imagen', null, ['class' => 'form-control', 'placeholder'=>'Imagen', 'required'])!!}
        </div>

        <div class="form-group col-md-8 col-md-offset-2">
          {{  Form::label('Usuario:') }}
          {!! Form::select('user_id', $user, null, ['class' => 'form-control', 'placeholder'=>'Usuario', 'required'])!!}
        </div>

        
          <div class="form-group col-md-8 col-md-offset-2">
            {{ Form::submit('Guardar', array('class' => 'btn btn-success')) }}

            {{ Form::close() }}
          </div>
        </div>
        </div>

        </div>

@endsection
