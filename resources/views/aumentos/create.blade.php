@extends('layouts.master')

@section('title')
<a href="{{route('aumentos.index')}}" class="btn btn-outline-primary" data-toggle="tooltip" data-placement="top" title="Aumentos Registrados">
    <i class="fa fa-list"></i>
</a>
Registro de Aumentos
@endsection

@section('content')

<div class="content">
    <div class="grid grid-cols-12 gap-6 mt-5">
        <div class="intro-y col-span-12 lg:col-span-12">
            {{ Form::open(array('route' => 'aumentos.store', 'enctype' => 'multipart/form-data')) }}
            
            <div class="intro-y box p-5">
                <div class="mt-3">
                    {!! Form::label('Funciones en Proyectos') !!}
                    {{--{!! Form::textarea('proyectos_funciones',  null, ['class' => 'input w-full border mt-2', 'placeholder'=>'Funciones en Proyectos', 'rows'=> 3])!!}
                    @if ($errors->has('proyectos_funciones'))
                    <small style="color:red">
                        *{{ $errors->first('proyectos_funciones') }}
                    </small>
                    @endif--}}
                    <textarea name="proyectos_funciones" id="editor1" rows="10" cols="80">
                    
                    </textarea>
                </div>
                
                <div class="mt-3">
                    {!! Form::label('Otras Funciones') !!}
                    {{--{!! Form::textarea('otras_funciones',  null, ['class' => 'input w-full border mt-2', 'placeholder'=>'Otras Funciones', 'rows'=> 3])!!}
                    @if ($errors->has('otras_funciones'))
                    <small style="color:red">
                        *{{ $errors->first('otras_funciones') }}
                    </small>
                    @endif--}}
                    <textarea name="otras_funciones" id="editor2" rows="10" cols="80">
                    
                    </textarea>
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
        CKEDITOR.replace( 'editor2' );
    </script>
@endpush
