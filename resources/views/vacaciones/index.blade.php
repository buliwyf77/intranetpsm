@extends('layouts.master')

@section('title')

<div class="col-md-3">
<a  href="{{route('vacaciones.create')}}" class="button w-15 flex items-center justify-center bg-theme-3 text-white">
    <i data-feather="plus-circle"></i> 
</a>
</div>

@endsection

@section('content')
<div class="page-header">
    <h1 class="text-center text-4xl text-theme-1 font-medium leading-none m-5">Solicitud de Vacaciones</h1>
</div>

<div class="intro-y datatable-wrapper box p-4 mt-0">
    <table class="table table-report table-report--bordered display datatable w-full">
        <thead>
          <tr class="info">
            <th> # </th>
            <th class="border-b-4 whitespace-no-wrap" width="200px"> Usuario</th>
            <th class="border-b-4 whitespace-no-wrap">Área</th>
            <th class="border-b-4 whitespace-no-wrap"> Fecha</th>    
            <th class="border-b-4 whitespace-no-wrap"> Dias Solicitados</th>    
            <th class="border-b-4 whitespace-no-wrap" width="250px"> Estado de la Solicitud</th>               
            <th align="right"> <i data-feather="settings"></i> </th>
          </tr>
        </thead>
    
        <tbody>
            @foreach ($vacacione as $key => $vacacion)
            <tr>
                <td> {{ $key + 1 }}</td>
                <td> {{ $vacacion->user->name }} </td>
                <td> {{$vacacion->area->nombre}} </td>
                <td> {{date('d-m-Y', strtotime($vacacion->fecha))}} </td>
                <td> {{ $vacacion->cantidad_dia }} </td>
                <td> @if(isset($vacacion->solicitud_id))
                    <div class="circle" style="background-color:{{ $vacacion->solicitud->color}};">
                        <p style="margin-left:30px; display: inline-block; width:250px">{{ $vacacion->solicitud->nombre}} </p>
                    </div> 
                    @endif
                </td>
                <td>
                    <div class="btn-group btn-group-sm btn-group-toggle float-right" role="group" aria-label="Acciones">
                        <a href="{{route('vacaciones.show', $vacacion->id)}}" class="btn btn-primary btn-sm" data-toggle="tooltip" data-placement="bottom" title="Ver Vacacione"> <i data-feather="eye"></i> </a>
                        {{--@if($vacacion->solicitud_id == 3 && Auth::id() == $vacacion->user_id)
                        <a href="{{route('vacaciones.edit', $vacacion->id)}}" class="btn btn-primary btn-sm" data-toggle="tooltip" data-placement="bottom" title="Editar Vacacione"> <i data-feather="edit"></i> </a>
                        {!! Form::model($vacacion, ['method' => 'delete', 'route' => ['vacaciones.destroy', $vacacion->id], 'class' =>'form-inline form-delete']) !!}
                        {!! Form::hidden('id', $vacacion->id) !!}
                        <button type="submit" name="delete_modal" class="btn btn-danger btn-sm delete" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="Eliminar"><i data-feather="trash-2"></i></button>
                        {!! Form::close() !!}
                        @endif--}}
                    </div>
                </td>
            </tr>
            @endforeach
        </tbody>
    
    </table>
    
</div>

@endsection
