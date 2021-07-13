@extends('layouts.master')

@section('title')
<div class="col-md-3">
    <a  href="{{route('aumentos.create')}}" class="button w-15 flex items-center justify-center bg-theme-3 text-white">
        <i data-feather="plus-circle"></i> 
    </a>
    </div>
 
@endsection

@section('content')
<div class="page-header">
    <h1 class="text-center text-4xl text-theme-1 font-medium leading-none m-5">Solicitud de Aumento</h1>
</div>

<div class="intro-y datatable-wrapper box p-4 mt-0">
    <table class="table table-report table-report--bordered display datatable w-full">
        <thead>
          <tr class="info">
            <th> # </th>
            <th class="border-b-4 whitespace-no-wrap" width="200px"> Usuario</th>
            <th class="border-b-4 whitespace-no-wrap"> Fecha</th>    
            <th class="border-b-4 whitespace-no-wrap" width="250px"> Estado de la Solicitud</th>             
            <th align="right"> <i data-feather="settings"></i> </th>
          </tr>
        </thead>
    
        <tbody>
            @foreach ($aumento as $key => $aument)
            <tr>
                <td> {{ $key + 1 }}</td>
                <td> {{ $aument->user->name }} </td>
                <td> {{date('d-m-Y', strtotime($aument->fecha))}} </td>
                <td> <div class="circle" style="background-color:{{ $aument->solicitud->color}}">
                    <p style="margin-left:30px; display: inline-block; width:250px">{{ $aument->solicitud->nombre}} </p></div>
                 </td>
                <td>
                    <div class="btn-group btn-group-sm btn-group-toggle float-right" role="group" aria-label="Acciones">
                        <a href="{{route('aumentos.show', $aument->id)}}" class="btn btn-primary btn-sm" data-toggle="tooltip" data-placement="bottom" title="Ver Aumento"> <i data-feather="eye"></i> </a>
                        {{--@if($aument->solicitud_id == 3 && Auth::id() == $aument->user_id)
                            <a href="{{route('aumentos.edit', $aument->id)}}" class="btn btn-primary btn-sm" data-toggle="tooltip" data-placement="bottom" title="Editar Aumento"> <i data-feather="edit"></i> </a>
                            {!! Form::model($aument, ['method' => 'delete', 'route' => ['aumentos.destroy', $aument->id], 'class' =>'form-inline form-delete']) !!}
                            {!! Form::hidden('id', $aument->id) !!}
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
