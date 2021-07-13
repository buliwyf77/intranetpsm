@extends('layouts.master')

@section('title')
  <a href="{{route('cargos.index')}}" class="btn btn-outline-primary" data-toggle="tooltip" data-placement="top" title="Cargo Registrado">      <i class="fa fa-list"></i>
  </a>
  Ver Información
@endsection

@section('content')

  <div class="page-header">
    <h2 class="text-center"> <i class="fa fa-book"></i> Cargos </h2>
  </div>

  <div class="row">
      <div class="col-lg-6 col-md-6 col-12 offset-lg-3 offset-md-3">
        <div class="card ">
            <div class="card-header ">
                <b>Nombre:  </b>{{$cargo->nombre}}

                <div class="btn-group btn-group-sm btn-group-toggle float-right" role="group" aria-label="Acciones">
                    <a href="{{route('cargos.edit', $cargo->id)}}" class="btn btn-primary btn-sm " data-toggle="tooltip" data-placement="bottom" title="Editar Cargo"> <i class="fa fa-edit"></i> </a>
                    {!! Form::model($cargo, ['method' => 'delete', 'route' => ['cargos.destroy', $cargo->id], 'class' =>'form-inline form-delete', 'id' => 'confirm_delete']) !!}
                    {!! Form::hidden('id', $cargo->id) !!}
                        <button type="submit" name="delete_modal" class="btn btn-danger btn-sm form-delete" data-toggle="tooltip" data-placement="bottom" title="Eliminar Cargo" ><i class="fa fa-trash"></i></button>
                    {!! Form::close() !!}
                </div>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-lg-8 col-md-8 col-12">
                        <p> <b>Nombre: </b>  {{$cargo->nombre}} </p>   
                        <p> <b>Descripción: </b>  {{$cargo->descripcion}} </p>                                 
                    </div>
                </div>
            </div>
        </div>
      </div>
  </div>
      
@endsection

