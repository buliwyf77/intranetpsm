@extends('layouts.master')

@section('title')
Editar Noticia  
@endsection

@section('content')

<div class="content">
    <div class="grid grid-cols-12 gap-6 mt-5">
        <div class="intro-y col-span-12 lg:col-span-12">
            
            <div class="flex">
                <div class="">
                    <img alt="{{$noticia->titulo}}" width="400px" class="" src="{{$noticia->imagen}}" title="{{$noticia->titulo}}">
                </div>
            </div>
            <br>

            {{Form::model($noticia, ['route' => ['noticias.update', $noticia->id], 'method' => 'patch', 'enctype' => 'multipart/form-data',  'data-file-types'=>"image/jpeg|image/png|image/jpg"])}}

            <div class="intro-y box p-5">
                <div class="mt-3">
                    {!! Form::label('Título') !!}
                    {!! Form::text('titulo',  null, ['class' => 'input w-full border mt-2', 'placeholder'=>'Título'])!!}
                    @if ($errors->has('titulo'))
                    <small style="color:red">
                        *{{ $errors->first('titulo') }}
                    </small>
                    @endif
                </div>

                <div class="mt-3">
                    {!! Form::label('Descripción') !!}
                </div>

                <textarea name="descripcion" id="editor1" rows="10" cols="80">
                    {{$noticia->descripcion}}
                </textarea>

                <div class="mt-1">
                    @if ($errors->has('descripcion'))
                    <small style="color:red">
                        *{{ $errors->first('descripcion') }}
                    </small>
                    @endif
                </div>
                <div class="mt-3">
                    {!! Form::label('Imagen') !!}
                    {!! Form::file('imagen',  null, ['class' => 'input w-full border mt-2', 'placeholder'=>'Imagen'])!!}
                    @if ($errors->has('imagen'))
                    <small style="color:red">
                        *{{ $errors->first('imagen') }}
                    </small>
                    @endif
                </div>

                <div class="text-right mt-5">
                    {{ Form::submit('Guardar', array('class' => "button w-24 bg-theme-1 text-white")) }}
                    {{ Form::close() }}
                </div>
            </div>
        </div>
        
    </div>
</div>
@endsection

@push('scripts-js')
    <script>
        CKEDITOR.replace( 'editor1' );
    </script>
@endpush