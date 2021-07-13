@extends('layouts.master')

@section('title')
  <a href="{{route('contratos.index')}}" class="btn btn-outline-primary" data-toggle="tooltip" data-placement="top" title="Contrato Registrado">      <i class="fa fa-list"></i>
  </a>
  Ver Información
@endsection

@section('content')

  <div class="page-header">
    <h2 class="text-center"> <i class="fa fa-book"></i> Contratos </h2>
  </div>

  <div class="row">
      <div class="col-lg-6 col-md-6 col-12 offset-lg-3 offset-md-3">
        <div class="card ">
            <div class="card-header ">
                <b>Fecha de inicio:  </b> {{date('d-m-Y', strtotime($contrato->fecha_inicio))}}
                
                @if($contrato->fecha_culminacion != NULL)
                <br>
                <b>Fecha de Culminación: </b>
                {{date('d-m-Y', strtotime($contrato->fecha_culminacion))}}  
                @endif 

                <div class="btn-group btn-group-sm btn-group-toggle float-right" role="group" aria-label="Acciones">
                    <a href="{{route('contratos.edit', $contrato->id)}}" class="btn btn-primary btn-sm " data-toggle="tooltip" data-placement="bottom" title="Editar Contrato"> <i class="fa fa-edit"></i> </a>
                    {!! Form::model($contrato, ['method' => 'delete', 'route' => ['contratos.destroy', $contrato->id], 'class' =>'form-inline form-delete', 'id' => 'confirm_delete']) !!}
                    {!! Form::hidden('id', $contrato->id) !!}
                        <button type="submit" name="delete_modal" class="btn btn-danger btn-sm form-delete" data-toggle="tooltip" data-placement="bottom" title="Eliminar Contrato" ><i class="fa fa-trash"></i></button>
                    {!! Form::close() !!}
                </div>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-lg-8 col-md-8 col-12">
                        <p> <b>Horas de Trabajo: </b>  {{$contrato->horas_trabajo}} </p>   
                        <p> <b>Sueldo: </b>  {{$contrato->monto_sueldo}} </p>         
                        <p> <b>Tipo de Contrato: </b>  {{$contrato->tipo_contrato->nombre}} </p>   
                        <p> <b>Usuario: </b>  {{$contrato->user->name}} </p>   
                        <p> <b>Cargo: </b>  {{$contrato->cargo->nombre}} </p>                                  
                    </div>
                </div>
            </div>
        </div>          
      </div>
  </div>
      
@endsection

