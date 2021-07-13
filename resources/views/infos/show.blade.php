@extends('layouts.master')

@section('title')
  <a href="{{route('infos.index')}}" class="btn btn-outline-primary" data-toggle="tooltip" data-placement="top" title="Registrado">      <i class="fa fa-list"></i>
  </a>
  Ver Información
@endsection

@section('content')

  <div class="page-header">
    <h2 class="text-center"> <i class="fa fa-book"></i> Detalle</h2>
  </div>

  <div class="row">
      <div class="col-lg-6 col-md-6 col-12 offset-lg-3 offset-md-3">
        <div class="card ">
            <div class="card-header ">
                <p> <b> Usuario: </b>  {{$info->user->name}} </p>
                <b>Fecha de Nacimiento:  </b>{{$info->fecha_nacimiento}} <br> 
                <b>Fecha de Ingreso:  </b>{{$info->fecha_ingreso}} <br> 

                <div class="btn-group btn-group-sm btn-group-toggle float-right" role="group" aria-label="Acciones">
                    <a href="{{route('infos.edit', $info->id)}}" class="btn btn-primary btn-sm " data-toggle="tooltip" data-placement="bottom" title="Editar Info"> <i class="fa fa-edit"></i> </a>
                    {!! Form::model($info, ['method' => 'delete', 'route' => ['infos.destroy', $info->id], 'class' =>'form-inline form-delete', 'id' => 'confirm_delete']) !!}
                    {!! Form::hidden('id', $info->id) !!}
                        <button type="submit" name="delete_modal" class="btn btn-danger btn-sm form-delete" data-toggle="tooltip" data-placement="bottom" title="Eliminar Info" ><i class="fa fa-trash"></i></button>
                    {!! Form::close() !!}
                </div>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-lg-8 col-md-8 col-12">
                        <p> <b>Nacionalidad: </b>  {{$info->nacionalidad}} </p>   
                        <p> <b>Rut: </b>  {{$info->rut}} </p>         
                        <p> <b>Pasaporte: </b>  {{$info->pasaporte}} </p>
                        <p> <b>Dirección </b>  {{$info->direccion}} </p>                                             
                        <p> <b>Telefono: </b>  {{$info->telefono}} </p>   
                           
                                                     
                    </div>
                </div>
            </div>
        </div>          
      </div>
  </div>
      
@endsection

