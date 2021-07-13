@extends('layouts.master')

@section('title')
<div class="col-md-3">
    <a  href="{{route('directivos.create')}}" class="button w-15 flex items-center justify-center bg-theme-3 text-white">
        <i data-feather="plus-circle"></i> 
    </a>
    </div>
 
@endsection

@section('content')
<div class="page-header">
    <h1 class="text-center text-4xl text-theme-1 font-medium leading-none m-5">Lista de Directivos</h1>
</div>

<div class="intro-y datatable-wrapper box p-4 mt-0">
    <table class="table table-report table-report--bordered display datatable w-full">
        <thead>
          <tr class="info">
            <th> # </th>
            <th class="border-b-4 whitespace-no-wrap"> Nombre Completo </th>    
            <th class="border-b-6 whitespace-no-wrap"> Rut </th>    
            <th class="border-b-4 whitespace-no-wrap"> Cargo </th>
            <th class="border-b-4 whitespace-no-wrap"> Email </th>                   
            <th align="right"> <i data-feather="settings"></i> </th>
          </tr>
        </thead>
    
        <tbody>
            @foreach ($directivo as $key => $directiv)
            <tr>
                <td> {{ $key + 1 }}</td>
                <td> {{ $directiv->nombre_completo}}</td>
                <td> {{ $directiv->rut }}</td>
                <td> {{ $directiv->cargo}}</td>
                <td> {{ $directiv->email}}</td>
                <td>
                    <div class="btn-group btn-group-sm btn-group-toggle float-right" role="group" aria-label="Acciones">
                        <a href="{{route('directivos.show', $directiv->id)}}" class="btn btn-primary btn-sm" data-toggle="tooltip" data-placement="bottom" title="Ver Directivo"> <i data-feather="eye"></i> </a>
                        <a href="{{route('directivos.edit', $directiv->id)}}" class="btn btn-primary btn-sm" data-toggle="tooltip" data-placement="bottom" title="Editar Directivo"> <i data-feather="edit"></i> </a>
                        {!! Form::model($directiv, ['method' => 'delete', 'route' => ['directivos.destroy', $directiv->id], 'class' =>'form-inline form-delete']) !!}
                        {!! Form::hidden('id', $directiv->id) !!}
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
