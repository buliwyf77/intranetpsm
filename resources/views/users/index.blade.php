@extends('layouts.master')

@section('title')
    <a  href="{{route('users.create')}}" class="button w-15 flex items-center justify-center bg-theme-3 text-white">
        <i data-feather="plus-circle"></i> 
    </a>
@endsection

@section('content')
<div class="page-header">
    <h1 class="text-center text-4xl text-theme-1 font-medium leading-none m-5"> Lista de Usuarios </h1>
</div>

<div class="intro-y datatable-wrapper box p-4 mt-0">
    <table class="table table-report table-report--bordered display datatable w-full">
        <thead>
          <tr class="info">
            <th> # </th>
            <th class="border-b-4 whitespace-no-wrap"> Nombre </th>    
            <th class="border-b-6 whitespace-no-wrap"> Número de Documento </th>  
            <th class="border-b-6 whitespace-no-wrap"> Área </th>                      
            <th align="right"><i data-feather="settings"></i> </th>
          </tr>
        </thead>
    
        <tbody>
            @foreach ($users as $key => $user)
            <tr>
                <td> {{ $key + 1 }}</td>
                <td> {{ $user->name}} </td>
                <td> {{ $user->info->num_doc }} </td>
                <td> {{ $user->info->area->nombre }} </td>
                <td>
                    <div class="btn-group btn-group-sm btn-group-toggle float-right" role="group" aria-label="Acciones">
                        <a href="{{route('users.show', $user->slug)}}" class="btn btn-primary btn-sm" data-toggle="tooltip" data-placement="bottom" title="Ver user"> <i data-feather="eye"></i> </a>
                        @if(Auth::user()->role_id == 1)
                        <a href="{{route('users.edit', $user->slug)}}" class="btn btn-primary btn-sm" data-toggle="tooltip" data-placement="bottom" title="Editar user"> <i data-feather="edit"></i> </a>
                        <a href="/user/{{$user->id}}/eliminar" class="btn btn-danger btn-sm delete" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="Eliminar"><i data-feather="trash-2"></i> </a>

                        <!-- {! Form::model($user, ['method' => 'delete', 'route' => ['users.destroy', $user->id], 'class' =>'form-inline form-delete']) !!}
                        {! Form::hidden('id', $user->id) !!}
                        <button type="submit" name="delete_modal" class="btn btn-danger btn-sm delete" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="Eliminar"><i data-feather="trash-2"></i></button>
                        {! Form::close() !!} -->
                        @endif
                    </div>
                </td>
            </tr>
            @endforeach
        </tbody>
    
    </table>
    
</div>

@endsection
