@extends('layouts.master')

@section('title')
   
@endsection

@section('content')

<div class="page-header">
    <h1 class="text-center text-4xl text-theme-1 font-medium leading-none m-5"> Directorio de Personal </h1>
</div>

<div class="intro-y datatable-wrapper box p-4 mt-0">
    <table class="table table-report table-report--bordered display datatable w-full">
        <thead>
          <tr class="info">
            <th> # </th>
            <th class="border-b-4 whitespace-no-wrap"> Foto </th> 
            <th class="border-b-4 whitespace-no-wrap"> Nombre </th>    
            <th class="border-b-6 whitespace-no-wrap"> Área </th>
            <th class="border-b-6 whitespace-no-wrap"> Email </th>
            <th class="border-b-6 whitespace-no-wrap"> Teléfono </th>                         
           </tr>
        </thead>
    
        <tbody>
            @foreach ($users as $key => $user)
            <tr class="intro-x">
                <td> {{ $key + 1 }}</td>
                <td class="w-40">
                    <div class="flex">
                        <div class="w-10 h-10 image-fit zoom-in">
                            <img alt="{{$user->name}}" class="tooltip rounded-full" src="{{$user->info->imagen}}" title="{{$user->name}}">
                        </div>
                    </div>
                </td>
                <td> {{ $user->name}} </td>
                <td> {{ $user->info->area->nombre }} </td>
                <td> {{ $user->email }} </td>
                <td> {{ $user->info->telefono }} </td>
            </tr>
            @endforeach
        </tbody>
    
    </table>
    
</div>

@endsection
