@extends('layouts.master')

@section('title')
  Configuraciones del Sistema
@endsection

@section('content')

<div class="content">
  <div class="grid grid-cols-12 gap-6 mt-5">
    <div class="intro-y col-span-12 lg:col-span-6">
        <!-- BEGIN: Form Layout -->
        {{Form::model($configuracione, ['route' => ['configuraciones.update', $configuracione->id], 'method' => 'patch', 'enctype'=>"multipart/form-data"])}}
        <div class="intro-y box p-5">
            <div class="mt-3">
                {!! Form::label('Nombre de la Empresa') !!}
                {!! Form::text('nombre_empresa',  null, ['class' => 'input w-full border mt-2', 'placeholder'=>'Nombre de la Empresa'])!!}
                @if ($errors->has('nombre_empresa'))
                <small style="color:red">
                    *{{ $errors->first('nombre_empresa') }}
                </small>
                @endif
            </div>
            <div class="mt-3">
              {!! Form::label('Dirección') !!}
              {!! Form::text('direccion', null, ['class' => 'input w-full border mt-2', 'placeholder'=>'Dirección'])!!}
              @if ($errors->has('direccion'))
              <small style="color:red">
                  *{{ $errors->first('direccion') }}
              </small>
              @endif
            </div>
            <div class="mt-3">
                {{  Form::label('Rut:') }}
                {!! Form::text('rut',  null, ['class' => 'input w-full border mt-2', 'placeholder'=>'Rut'])!!}
                @if ($errors->has('rut'))
                <small style="color:red">
                    *{{ $errors->first('rut') }}
                </small>
                 @endif
            </div>
            <div class="mt-3">
                {{  Form::label('Telefono:') }}
                {!! Form::text('telefono',  null, ['class' => 'input w-full border mt-2', 'placeholder'=>'Telefono'])!!}
                @if ($errors->has('telefono'))
                <small style="color:red">
                    {{ $errors->first('telefono') }}
                </small>
            @endif
            </div>
            <div class="mt-3">
                {{  Form::label('Email:') }}
                {!! Form::text('email',  null, ['class' => 'input w-full border mt-2', 'placeholder'=>'Email'])!!}
                @if ($errors->has('email'))
                <small style="color:red">
                    {{ $errors->first('email') }}
                </small>
            @endif
            </div>
            <div class="mt-3">
                {{  Form::label('Ciudad:') }}
                {!! Form::text('ciudad',  null, ['class' => 'input w-full border mt-2', 'placeholder'=>'Ciudad'])!!}
                @if ($errors->has('ciudad'))
                <small style="color:red">
                    {{ $errors->first('ciudad') }}
                </small>
            @endif
            </div>
            <div class="mt-3">
                {{  Form::label('Pagina Web:') }}
                {!! Form::text('pagina_web',  null, ['class' => 'input w-full border mt-2', 'placeholder'=>'Pagina Web'])!!}
                @if ($errors->has('pagina_web'))
                <small style="color:red">
                    {{ $errors->first('pagina_web') }}
                </small>
            @endif
            </div>
            <div class="mt-3">
                {{  Form::label('Logo:') }}
                {!! Form::file('logo',  null, ['class' => 'input w-full border mt-2', 'placeholder'=>'Logo'])!!}
                @if ($errors->has('logo'))
                        <small style="color:red">
                            {{ $errors->first('logo') }}
                        </small>
                @endif
            </div>
            <div class="text-right mt-5">
               {{ Form::submit('Guardar', array('class' => "button w-24 bg-theme-1 text-white")) }}
            {{ Form::close() }}
            </div>
        </div>
        <!-- END: Form Layout -->
    </div>
</div>

@endsection
