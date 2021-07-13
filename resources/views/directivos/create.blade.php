@extends('layouts.master')

@section('title')
<a href="{{route('directivos.index')}}" class="btn btn-outline-primary" data-toggle="tooltip" data-placement="top" title="Directivos Registrados">
    <i class="fa fa-list"></i>
</a>
Registro de los Directivos
@endsection

@section('content')

<div class="content">
    <div class="grid grid-cols-12 gap-6 mt-5">
        <div class="intro-y col-span-12 lg:col-span-6">
            {{ Form::open(array('route' => 'directivos.store', 'enctype' => 'multipart/form-data')) }}
            
            <div class="intro-y box p-5">
                <div class="mt-3">
                    {!! Form::label('Nombre Completo') !!}
                    {!! Form::text('nombre_completo',  null, ['class' => 'input w-full border mt-2', 'placeholder'=>'Nombre Completo'])!!}
                    @if ($errors->has('nombre_completo'))
                    <small style="color:red">
                        *{{ $errors->first('nombre_completo') }}
                    </small>
                    @endif
                </div>

                <div class="mt-3">
                    {!! Form::label('Rut') !!}
                    {!! Form::text('rut',  null, ['class' => 'input w-full border mt-2', 'placeholder'=>'Rut'])!!}
                    @if ($errors->has('rut'))
                    <small style="color:red">
                        *{{ $errors->first('rut') }}
                    </small>
                    @endif
                </div>

                <div class="mt-3">
                    {!!  Form::label('Cargo') !!}
                    {!! Form::text('cargo', null, ['class' => 'input w-full border mt-2', 'placeholder'=>'Cargo'])!!}
                    @if ($errors->has('cargo'))
                    <small style="color:red">
                        *{{ $errors->first('cargo') }}
                    </small>
                    @endif
                </div>
                <div class="mt-3">
                    {!! Form::label('Email:') !!}
                    {!! Form::text('email',  null, ['class' => 'input w-full border mt-2', 'placeholder'=>'Email'])!!}
                    @if ($errors->has('email'))
                    <small style="color:red">
                        *{{ $errors->first('email') }}
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

