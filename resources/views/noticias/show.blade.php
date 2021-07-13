@extends('layouts.master')

@section('title')

@endsection

@section('content')

<div class="intro-y news p-5 box mt-8">
    <!-- BEGIN: Blog Layout -->
    <h2 class="intro-y font-medium text-xl sm:text-2xl">
        {{$noticia->titulo}}
    </h2>

    <div class="intro-y text-gray-700 mt-3 text-xs sm:text-sm"> 
        {{date('d-m-Y', strtotime($noticia->created_at))}} 
    </div>

    <div class="intro-y mt-6">
        <div class="news__preview image-fit">
            <img alt="{{$noticia->titulo}}" class="rounded-md" src="{{$noticia->imagen}}">
        </div>
    </div>

    <br>

    <div class="intro-y text-justify leading-relaxed">
        {!! $noticia->descripcion !!}
    </div>
    <!-- END: Blog Layout -->
</div>
@endsection