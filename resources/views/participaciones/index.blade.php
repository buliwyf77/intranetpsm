@extends('layouts.master')

@section('title')
<div class="col-md-3">
    <a  href="{{route('participaciones.create')}}" class="button w-15 flex items-center justify-center bg-theme-3 text-white">
        <i data-feather="plus-circle"></i> 
    </a>
    </div>
 
@endsection

@section('content')

<div class="intro-y datatable-wrapper box p-4 mt-0">
    <table class="table table-report table-report--bordered display datatable w-full">
        <thead>
          <tr class="info">
            <th> # </th>
            <th class="border-b-4 whitespace-no-wrap"> Funciones </th>    
            <th class="border-b-6 whitespace-no-wrap"> Proyecto </th>    
            <th class="border-b-4 whitespace-no-wrap"> Usuario </th>                   
            <th> <i data-feather="settings"></i> </th>
          </tr>
        </thead>
    
        <tbody>
            @foreach ($participacione as $key => $participacion)
            <tr>
                <td> {{ $key + 1 }}</td>
                <td> {{ $participacion->funciones}} </td>
                <td> {{ $participacion->proyecto->nombre }} </td>
                <td> {{ $participacion->user->name}} </td>
                <td>
                    <div class="btn-group btn-group-sm btn-group-toggle float-right" role="group" aria-label="Acciones">
                        <a href="{{route('participaciones.show', $participacion->id)}}" class="btn btn-primary btn-sm" data-toggle="tooltip" data-placement="bottom" title="Ver Participacione"> <i data-feather="eye"></i> </a>
                        <a href="{{route('participaciones.edit', $participacion->id)}}" class="btn btn-primary btn-sm" data-toggle="tooltip" data-placement="bottom" title="Editar Participacione"> <i data-feather="edit"></i> </a>
                        {!! Form::model($participacion, ['method' => 'delete', 'route' => ['participaciones.destroy', $participacion->id], 'class' =>'form-inline form-delete']) !!}
                        {!! Form::hidden('id', $participacion->id) !!}
                        <button type="submit" name="delete_modal" class="btn btn-danger btn-sm delete" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="Eliminar"><i data-feather="trash-2"></i></button>
                        {!! Form::close() !!}
                    </div>
                </td>
            </tr>
            @endforeach
        </tbody>
    
    </table>
    
</div>

@endsection
