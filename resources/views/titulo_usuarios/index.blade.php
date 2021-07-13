@extends('layouts.master')

@section('title')

<div class="col-md-3">
<a  href="{{route('titulo_usuarios.create')}}" class="button w-15 flex items-center justify-center bg-theme-3 text-white">
    <i data-feather="plus-circle"></i> 
</a>
</div>


<p><h1>Lista de Titulos</h1></p>



@endsection

@section('content')

<div class="intro-y datatable-wrapper box p-4 mt-0">
        <table class="table table-report table-report--bordered display datatable w-full">
            <thead>
              <tr class="info">
                <th> # </th>
                <th class="border-b-4 whitespace-no-wrap"> Usurio </th>    
                <th class="border-b-6 whitespace-no-wrap"> Titulo </th>                      
                <th> <i data-feather="settings"></i> </th>
              </tr>
            </thead>
        
            <tbody>
                @foreach ($titulo_usuario as $key => $titulo)
                <tr>
                    <td> {{ $key + 1 }}</td>
                    <td> {{ $titulo->user->name}} </td>
                    <td> {{ $titulo->titulo->nombre}} </td>
                    <td>
                        <div class="btn-group btn-group-sm btn-group-toggle float-right" role="group" aria-label="Acciones">
                            
                            <a href="{{route('titulo_usuarios.edit', $titulo->id)}}" class="btn btn-primary btn-sm" data-toggle="tooltip" data-placement="bottom" title="Editar"> <i data-feather="edit"></i> </a>
                            {!! Form::model($titulo, ['method' => 'delete', 'route' => ['titulo_usuarios.destroy', $titulo->id], 'class' =>'form-inline form-delete']) !!}
                            {!! Form::hidden('id', $titulo->id) !!}
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
