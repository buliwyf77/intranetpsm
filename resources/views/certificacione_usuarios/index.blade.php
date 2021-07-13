@extends('layouts.master')

@section('title')

<div class="col-md-3">
<a  href="{{route('certificacione_usuarios.create')}}" class="button w-15 flex items-center justify-center bg-theme-3 text-white">
    <i data-feather="plus-circle"></i> 
</a>
</div>


<p><h1>Lista de Certificaciones</h1></p>



@endsection

@section('content')

<div class="intro-y datatable-wrapper box p-4 mt-0">
        <table class="table table-report table-report--bordered display datatable w-full">
            <thead>
              <tr class="info">
                <th> # </th>
                <th class="border-b-4 whitespace-no-wrap"> Usurio </th>    
                <th class="border-b-6 whitespace-no-wrap"> Cetificación </th>                      
                <th> <i data-feather="settings"></i> </th>
              </tr>
            </thead>
        
            <tbody>
                @foreach ($certificacione_usuario as $key => $cetificacion)
                <tr>
                    <td> {{ $key + 1 }}</td>
                    <td> {{ $cetificacion->user->name}} </td>
                    <td> {{ $cetificacion->certificacione->nombre}} </td>
                    <td>
                        <div class="btn-group btn-group-sm btn-group-toggle float-right" role="group" aria-label="Acciones">
                            
                            <a href="{{route('certificacione_usuarios.edit', $cetificacion->id)}}" class="btn btn-primary btn-sm" data-toggle="tooltip" data-placement="bottom" title="Editar"> <i data-feather="edit"></i> </a>
                            {!! Form::model($cetificacion, ['method' => 'delete', 'route' => ['certificacione_usuarios.destroy', $cetificacion->id], 'class' =>'form-inline form-delete']) !!}
                            {!! Form::hidden('id', $cetificacion->id) !!}
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
