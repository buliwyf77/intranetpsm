@extends('layouts.master')

@section('title')

<div class="col-md-3">
<a  href="{{route('documentos.create')}}" class="button w-15 flex items-center justify-center bg-theme-3 text-white">
    <i data-feather="plus-circle"></i> 
</a>
</div>

@endsection

@section('content')
<div class="page-header">
    <h1 class="text-center text-4xl text-theme-1 font-medium leading-none m-5">Lista de Documentos</h1>
</div>

<div class="intro-y datatable-wrapper box p-4 mt-0">
        <table class="table table-report table-report--bordered display datatable w-full">
            <thead>
              <tr class="info">
                <th> # </th>
                <th class="border-b-4 whitespace-no-wrap"> Documento </th> 
                <th class="border-b-6 whitespace-no-wrap"> Autor </th>      
                <th align="right"> <i data-feather="settings"></i> </th>
              </tr>
            </thead>
        
            <tbody>
                @foreach ($documentos as $key => $documento)
                <tr>
                    <td> {{ $key + 1 }}</td>
                    <td> {{ $documento->nombre}} </td>
                    <td> {{ $documento->user->name}}</td>
                    <td>
                        <div class="btn-group btn-group-sm btn-group-toggle float-right" role="group" aria-label="Acciones">
                            <a href="{{route('documentos.show', $documento->id)}}" class="btn btn-primary btn-sm" data-toggle="tooltip" data-placement="bottom" title="Ver Documento"> <i data-feather="download"></i> </a>
                            @if($documento->user_id == Auth::user()->id)
                            {!! Form::model($documento, ['method' => 'delete', 'route' => ['documentos.destroy', $documento->id], 'class' =>'form-inline form-delete']) !!}
                            {!! Form::hidden('id', $documento->id) !!}
                            <button type="submit" name="delete_modal" class="btn btn-danger btn-sm delete" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="Eliminar"><i data-feather="trash-2"></i></button>
                            @endif

                            {!! Form::close() !!}
                        </div>
                    </td>
                </tr>
                @endforeach
            </tbody>
        
        </table>
        
    </div>

        

@endsection
