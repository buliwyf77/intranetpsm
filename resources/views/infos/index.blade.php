@extends('layouts.master')

@section('title')
<div class="col-md-3">
    <a  href="{{route('infos.create')}}" class="button w-15 flex items-center justify-center bg-theme-3 text-white">
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
                
            <th class="border-b-4 whitespace-no-wrap"> Usuario</th>
            <th class="border-b-4 whitespace-no-wrap"> Nacionalidad</th>    
            <th class="border-b-6 whitespace-no-wrap"> Rut</th>    
            <th class="border-b-4 whitespace-no-wrap"> Dirección</th>               
            <th> <i data-feather="settings"></i> </th>
          </tr>
        </thead>
    
        <tbody>
            @foreach ($infos as $key => $info)
            <tr>
                <td> {{ $key + 1 }}</td>
                <td> {{ $info->user->name }} </td>
                <td> {{ $info->nacionalidad}} </td>
                <td> {{ $info->rut }} </td>
                <td> {{ $info->direccion}} </td>
                <td>
                    <div class="btn-group btn-group-sm btn-group-toggle float-right" role="group" aria-label="Acciones">
                        <a href="{{route('infos.show', $info->id)}}" class="btn btn-primary btn-sm" data-toggle="tooltip" data-placement="bottom" title="Ver Info"> <i data-feather="eye"></i> </a>
                        <a href="{{route('infos.edit', $info->id)}}" class="btn btn-primary btn-sm" data-toggle="tooltip" data-placement="bottom" title="Editar Info"> <i data-feather="edit"></i> </a>
                        {!! Form::model($info, ['method' => 'delete', 'route' => ['infos.destroy', $info->id], 'class' =>'form-inline form-delete']) !!}
                        {!! Form::hidden('id', $info->id) !!}
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
