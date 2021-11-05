@extends('layouts.master')

@section('title')
<a href="{{route('users.index')}}" class="btn btn-outline-primary" data-toggle="tooltip" data-placement="top" title="Usuario Registrado">
    <i class="fa fa-list"></i>
</a>
Registro de Usuarios
@endsection

@section('content')

<div class="content">

    {{ Form::open(array('route' => 'users.store', 'enctype' => 'multipart/form-data',  'data-file-types'=>"image/jpeg|image/png|image/jpg")) }}

    <div class="grid grid-cols-12 gap-12 mt-5 box">
        <div class="p-5 lg:col-span-6">    
            <div class="mt-3">
                {!! Form::label('Nombre') !!}
                {!! Form::text('name',  null, ['class' => 'input w-full border mt-2', 'placeholder'=>'Nombre'])!!}
                @if ($errors->has('name'))
                <small style="color:red">
                    *{{ $errors->first('name') }}
                </small>
                @endif
            </div>
            <div class="mt-3">
                {!!  Form::label('Contraseña') !!}
                {!!  Form::password('password', ['class' => 'input w-full border mt-2', 'placeholder'=>'Contraseña'])!!}
                @if ($errors->has('password'))
                <small style="color:red">
                    *{{ $errors->first('password') }}
                </small>
                @endif
            </div>
            <div class="mt-3">
                {!!  Form::label('Documento de Identidad') !!}
                {!!  Form::select('doc_identidad', ['RUT' => 'RUT', 'PASAPORTE' => 'PASAPORTE'], null, ['class' => 'input w-full border mt-2', 'placeholder'=>'Documento de Identidad'])!!}
                @if ($errors->has('doc_identidad'))
                <small style="color:red">
                    *{{ $errors->first('doc_identidad') }}
                </small>
                @endif
            </div>
            <div class="mt-3">
                {!!  Form::label('Nacionalidad') !!}
                {!!  Form::select('nacionalidad', ['CHILENA' => 'CHILENA', 'VENEZOLANA' => 'VENEZOLANA'], null, ['class' => 'input w-full border mt-2', 'placeholder'=>'Nacionalidad'])!!}
                @if ($errors->has('nacionalidad'))
                <small style="color:red">
                    *{{ $errors->first('nacionalidad') }}
                </small>
                @endif
            </div>
            <div class="mt-3">
                {!!  Form::label('Fecha de Ingreso') !!}
                {!! Form::date('fecha_ingreso', null, ['class' => 'input w-full border mt-2', 'placeholder'=>'Fecha de Ingreso'])!!}
                @if ($errors->has('fecha_ingreso'))
                <small style="color:red">
                    *{{ $errors->first('fecha_ingreso') }}
                </small>
                @endif            
            </div>
            <div class="mt-3">
                {!!  Form::label('Teléfono') !!}
                {!!  Form::text('telefono', null, ['class' => 'input w-full border mt-2', 'placeholder'=>'Teléfono'])!!}
                @if ($errors->has('telefono'))
                <small style="color:red">
                    *{{ $errors->first('telefono') }}
                </small>
                @endif
            </div>

            
            <div class="mt-3">
                {!!  Form::label('Contacto de Emergencia') !!}
                {!!  Form::text('emergencia_nombre', null, ['class' => 'input w-full border mt-2', 'placeholder'=>'Nombre'])!!}
                @if ($errors->has('emergencia_nombre'))
                <small style="color:red">
                    *{{ $errors->first('emergencia_nombre') }}
                </small>
                @endif
            </div>
           
            <div class="mt-3">
                {!!  Form::label('Foto') !!} <br>
                {!!  Form::file('imagen', null, ['class' => 'input w-full border mt-2 '])!!}
                <br>
                @if ($errors->has('imagen'))
                <small style="color:red">
                    *{{ $errors->first('imagen') }}
                </small>
                @endif
            </div>

            <div class="mt-5"> <label>Jefe de Área</label>
                <div class="mt-2"> <input name="jefe_area" type="checkbox" class="input input--switch border" id="jefe_area"> </div>
            </div>

            <div class="mt-3" id="areas">
                {!! Form::label('Áreas') !!}
                {!! Form::select('areas[]', $area, null, ['class' => 'input w-full border mt-2', 'placeholder'=>'--Seleccionar--', 'multiple' => true])!!}
            </div>
    
            <div class="mt-5">
                {{ Form::submit('Guardar', array('class' => "button w-24 bg-theme-1 text-white")) }}
                {{ Form::close() }}
            </div>
            
        </div>
        <div class="p-5 lg:col-span-6">    
            <div class="mt-3">
                {!!  Form::label('Email') !!}
                {!! Form::text('email', null, ['class' => 'input w-full border mt-2', 'placeholder'=>'Email'])!!}
                @if ($errors->has('email'))
                <small style="color:red">
                    *{{ $errors->first('email') }}
                </small>
                @endif            
            </div>
            <div class="mt-3">
                {!! Form::label('Verificar Contraseña') !!}
                {!! Form::password('password_confirmation', ['class' => 'input w-full border mt-2', 'placeholder'=>'Verificar Contraseña'])!!}
                @if ($errors->has('password_confirmation'))
                <small style="color:red">
                    *{{ $errors->first('password_confirmation') }}
                </small>
                @endif
            </div>
            <div class="mt-3">
                {!!  Form::label('Número de Documento') !!}
                {!!  Form::text('num_doc', null, ['class' => 'input w-full border mt-2', 'placeholder'=>'Número de Documento'])!!}
                @if ($errors->has('num_doc'))
                <small style="color:red">
                    *{{ $errors->first('num_doc') }}
                </small>
                @endif
            </div>
            <div class="mt-3">
                {!!  Form::label('Fecha de Nacimiento') !!}
                {!!  Form::date('fecha_nacimiento', null, ['class' => 'input w-full border mt-2', 'placeholder'=>'Fecha de Nacimiento'])!!}
                @if ($errors->has('fecha_nacimiento'))
                <small style="color:red">
                    *{{ $errors->first('fecha_nacimiento') }}
                </small>
                @endif
            </div>
            <div class="mt-3">
                {!!  Form::label('Dirección') !!}
                {!!  Form::text('direccion', null, ['class' => 'input w-full border mt-2 ', 'placeholder'=>'Dirección'])!!}
                @if ($errors->has('direccion'))
                <small style="color:red">
                    *{{ $errors->first('direccion') }}
                </small>
                @endif
            </div>

            <div class="mt-3">
                {!! Form::label('Área a la que pertenece') !!}
                {!! Form::select('area_id', $area, null, ['class' => 'input w-full border mt-2', 'placeholder'=>'Selecciona'])!!}
                @if ($errors->has('area_id'))
                <small style="color:red">
                    *{{ $errors->first('area_id') }}
                </small>
                @endif
            </div>

            <div class="mt-3">
                {!!  Form::label('Teléfono del Contacto') !!}
                {!!  Form::text('emergencia_telefono', null, ['class' => 'input w-full border mt-2', 'placeholder'=>'Teléfono del Contacto'])!!}
                @if ($errors->has('emergencia_telefono'))
                <small style="color:red">
                    *{{ $errors->first('emergencia_telefono') }}
                </small>
                @endif
            </div>
        </div>
        
    </div>

    {{ Form::close() }}
</div>


@endsection

@push('scripts-js')
    <script>
        $(document).ready(function(){
            $('#areas').hide();
            $('#jefe_area').change(function(event) {
                if(this.checked){
                    $('#areas').show();
                }else{
                    $('#areas').hide();
                }
            });
        });
    </script>
@endpush