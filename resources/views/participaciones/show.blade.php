@extends('layouts.master')

@section('title')
  <a href="{{route('participaciones.index')}}" class="btn btn-outline-primary" data-toggle="tooltip" data-placement="top" title="Participaciones Registradas">      <i class="fa fa-list"></i>
  </a>
  Ver Información
@endsection

@section('content')

  <div class="page-header">
    <h2 class="text-center"> <i class="fa fa-book"></i> Participaciones </h2>
  </div>

  <div class="row">
      <div class="col-lg-6 col-md-6 col-12 offset-lg-3 offset-md-3">
        <div class="card ">
            <div class="card-header ">
                <b>Funciones:  </b>{{$participacione->funciones}}

                <div class="btn-group btn-group-sm btn-group-toggle float-right" role="group" aria-label="Acciones">
                    <a href="{{route('participaciones.edit', $participacione->id)}}" class="btn btn-primary btn-sm " data-toggle="tooltip" data-placement="bottom" title="Editar Participacione"> <i class="fa fa-edit"></i> </a>
                    {!! Form::model($participacione, ['method' => 'delete', 'route' => ['participaciones.destroy', $participacione->id], 'class' =>'form-inline form-delete', 'id' => 'confirm_delete']) !!}
                    {!! Form::hidden('id', $participacione->id) !!}
                        <button type="submit" name="delete_modal" class="btn btn-danger btn-sm form-delete" data-toggle="tooltip" data-placement="bottom" title="Eliminar Participacione" ><i class="fa fa-trash"></i></button>
                    {!! Form::close() !!}
                </div>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-lg-8 col-md-8 col-12">
                        <p> <b>Proyecto: </b>  {{$participacione->proyecto->nombre}} </p>         
                        <p> <b>Usuario: </b>  {{$participacione->user->name}} </p>                                  
                    </div>
                </div>
            </div>
        </div>          
      </div>
  </div>
      
@endsection

