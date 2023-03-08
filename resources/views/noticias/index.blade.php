@extends('layouts.master')

@section('title')
<div class="col-md-3">
    <a  href="{{route('noticias.create')}}" class="button w-15 flex items-center justify-center bg-theme-3 text-white">
        <i data-feather="plus-circle"></i> 
    </a>
    </div>
@endsection

@section('content')

<div class="page-header">
    <h1 class="text-center text-4xl text-theme-1 font-medium leading-none m-5"> Listado de Noticias </h1>
</div>

<div class="intro-y datatable-wrapper box p-4 mt-0">
    <table class="table table-report table-report--bordered display datatable w-full" id="datatable">
        <thead>
          <tr class="info">
            <th> # </th>
            <th class="border-b-4 whitespace-no-wrap"> Título </th>    
            <th class="border-b-4 whitespace-no-wrap"> Imagen </th> 
            <th class="border-b-4 whitespace-no-wrap"> Usuario </th>
            <th></th>
           </tr>
        </thead>
    
        <tbody>
            @foreach ($noticias as $key => $noticia)
            <tr class="intro-x">
                <td> {{ $key + 1 }}</td>
                <td> {{ $noticia->titulo}} </td>
                <td class="w-40">
                    <div class="flex">
                        <div class="w-10 h-10 image-fit zoom-in">
                            <img alt="{{$noticia->titulo}}" class="tooltip rounded-full" src="{{$noticia->imagen}}" title="{{$noticia->titulo}}">
                        </div>
                    </div>
                </td>
                <td></td>
                <td>
                    <div class="btn-group btn-group-sm btn-group-toggle float-right" role="group" aria-label="Acciones">
                        {{--<a href="{{route('solicitudes.show', $solicitude->id)}}" class="btn btn-primary btn-sm" data-toggle="tooltip" data-placement="bottom" title="Ver Solicitude"> <i data-feather="eye"></i> </a>--}}
                        <a href="{{route('noticias.edit', $noticia->id)}}" class="btn btn-primary btn-sm" data-toggle="tooltip" data-placement="bottom" title="Editar Noticia"> <i data-feather="edit"></i> </a>
                        {!! Form::model($noticia, ['method' => 'delete', 'route' => ['noticias.destroy', $noticia->id], 'class' =>'form-inline form-delete']) !!}
                        {!! Form::hidden('id', $noticia->id) !!}
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
