@extends('layouts.master')

@section('title')
<div class="col-md-3">
    <a  href="{{route('contratos.create')}}" class="button w-15 flex items-center justify-center bg-theme-3 text-white">
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
            <th class="border-b-4 whitespace-no-wrap"> Inicio </th>    
            <th class="border-b-6 whitespace-no-wrap"> Culminación </th>    
            <th class="border-b-4 whitespace-no-wrap"> horas </th>    
            <th class="border-b-4 whitespace-no-wrap"> Sueldo </th> 
            <th class="border-b-4 whitespace-no-wrap"> Usuario </th> 
            <th class="border-b-4 whitespace-no-wrap"> Cargo </th>                
            <th> <i data-feather="settings"></i> </th>
          </tr>
        </thead>
    
        <tbody>
            @foreach ($contrato as $key => $contrat)
            <tr>
                <td> {{ $key + 1 }}</td>
                <td> {{ $contrat->fecha_inicio}} </td>
                <td> {{ $contrat->fecha_culminacion }} </td>
                <td> {{ $contrat->horas_trabajo }} </td>
                <td>
                    $ {{ number_format($contrat->monto_sueldo, 2, ',', '.')  }}
                </td>
                <td> {{ $contrat->user->name }} </td>
                <td> {{ $contrat->cargo->nombre}} </td>
                <td>
                    <div class="btn-group btn-group-sm btn-group-toggle float-right" role="group" aria-label="Acciones">
                        <a href="{{route('contratos.show', $contrat->id)}}" class="btn btn-primary btn-sm" data-toggle="tooltip" data-placement="bottom" title="Ver Contrato"> <i data-feather="eye"></i> </a>
                        <a href="{{route('contratos.edit', $contrat->id)}}" class="btn btn-primary btn-sm" data-toggle="tooltip" data-placement="bottom" title="Editar Contrato"> <i data-feather="edit"></i> </a>
                        {!! Form::model($contrat, ['method' => 'delete', 'route' => ['contratos.destroy', $contrat->id], 'class' =>'form-inline form-delete']) !!}
                        {!! Form::hidden('id', $contrat->id) !!}
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
