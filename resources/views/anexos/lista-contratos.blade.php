@extends('layouts.master')

@section('title')

<h3>Lista de Contratos de {{$user->name}}</h3>
 
@endsection

@section('content')

<div class="intro-y datatable-wrapper box p-4 mt-0">
    <table class="table table-report table-report--bordered display datatable w-full">
        <thead>
          <tr class="info">
            <th> # </th>
            <th class="border-b-4 whitespace-no-wrap"> Inicio </th>    
            <th class="border-b-4 whitespace-no-wrap"> horas </th>    
            <th class="border-b-4 whitespace-no-wrap"> Sueldo </th> 
            <th class="border-b-4 whitespace-no-wrap"> Tipo </th> 
            <th class="border-b-4 whitespace-no-wrap"> Cargo </th>                
            <th> <i data-feather="settings"></i> </th>
          </tr>
        </thead>
    
        <tbody>
            @foreach ($user->contratos as $key => $contrat)
            <tr>
                <td> {{ $key + 1 }}</td>
                <td> {{ $contrat->fecha_inicio}} </td>
                <td> {{ $contrat->horas_trabajo }} </td>
                <td>
                    $ {{ number_format($contrat->monto_sueldo, 2, ',', '.')  }}
                </td>
                <td> {{$contrat->tipo_contrato->nombre}} </td>
                <td> {{ $contrat->cargo->nombre}} </td>
                <td>
                    <div class="btn-group btn-group-sm btn-group-toggle float-right" role="group" aria-label="Acciones">
                        <a href="{{$contrat->archivo}}" target="_blank" class="btn btn-primary btn-sm" data-toggle="tooltip" data-placement="bottom" title="Descargar Contrato"> <i data-feather="file-text"></i> </a>
                    </div>
                </td>
            </tr>
            @endforeach
        </tbody>
    
    </table>
    
</div>

@endsection
