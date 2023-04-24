@extends('layouts.master')

@section('title')
  <a href="{{route('users.index')}}" class="btn btn-outline-primary" data-toggle="tooltip" data-placement="top" title="Usuarios Registrados">
      <i class="fa fa-list"></i>
  </a>
  Editar 
@endsection

@section('content')

<div class="content">
        {{Form::model($user, ['route' => ['users.update', $user->id], 'method' => 'patch', 'enctype' => 'multipart/form-data'])}}

        <div class="grid grid-cols-12 gap-12 mt-5 box">
            <div class="p-5 lg:col-span-6">    
                <div class="mt-3">
                    {!! Form::label('Nombre') !!}
                    {!! Form::text('name',  $user->name, ['class' => 'input w-full border mt-2', 'placeholder'=>'Nombre'])!!}
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
                    {!!  Form::select('doc_identidad', ['RUT' => 'RUT', 'PASAPORTE' => 'PASAPORTE'], $user->info->doc_identidad, ['class' => 'input w-full border mt-2'])!!}
                    @if ($errors->has('doc_identidad'))
                    <small style="color:red">
                        *{{ $errors->first('doc_identidad') }}
                    </small>
                    @endif
                </div>
                <div class="mt-3">
                    {!!  Form::label('Nacionalidad') !!}
                    {!!  Form::select('nacionalidad', ['CHILENA' => 'CHILENA', 'VENEZOLANA' => 'VENEZOLANA'], $user->info->nacionalidad, ['class' => 'input w-full border mt-2'])!!}
                    @if ($errors->has('nacionalidad'))
                    <small style="color:red">
                        *{{ $errors->first('nacionalidad') }}
                    </small>
                    @endif
                </div>
                <div class="mt-3">
                    {!!  Form::label('Fecha de Ingreso') !!}
                    {!! Form::date('fecha_ingreso', $user->info->fecha_ingreso, ['class' => 'input w-full border mt-2', 'placeholder'=>'Fecha de Ingreso'])!!}
                    @if ($errors->has('fecha_ingreso'))
                    <small style="color:red">
                        *{{ $errors->first('fecha_ingreso') }}
                    </small>
                    @endif            
                </div>
                <div class="mt-3">
                    {!!  Form::label('Teléfono') !!}
                    {!!  Form::text('telefono', $user->info->telefono, ['class' => 'input w-full border mt-2', 'placeholder'=>'Teléfono'])!!}
                    @if ($errors->has('telefono'))
                    <small style="color:red">
                        *{{ $errors->first('telefono') }}
                    </small>
                    @endif
                </div>

                <div class="mt-3">
                    {!!  Form::label('Contacto de Emergencia') !!}
                    {!!  Form::text('emergencia_nombre', $user->info->emergencia_nombre, ['class' => 'input w-full border mt-2', 'placeholder'=>'Nombre'])!!}
                    @if ($errors->has('emergencia_nombre'))
                    <small style="color:red">
                        *{{ $errors->first('emergencia_nombre') }}
                    </small>
                    @endif
                </div>

                <div class="mt-3">
                    {!!  Form::label('Foto') !!}
                    <div class="w-20 h-20 sm:w-24 sm:h-24 flex-none lg:w-32 lg:h-32 image-fit relative">
                        <img alt="{{$user->name}}" class="rounded-full" src="{{$user->info->imagen}}">
                        <div class="absolute mb-1 mr-1 flex items-center justify-center bottom-0 right-0 bg-theme-1 rounded-full p-2"></div>
                    </div>
              
                    {!!  Form::file('imagen', null, ['class' => 'input w-full border mt-2', 'placeholder'=>'Foto'])!!}
                    @if ($errors->has('imagen'))
                    <small style="color:red">
                        *{{ $errors->first('imagen') }}
                    </small>
                    @endif
                </div>

                {{--<div class="mt-5"> <label>Jefe de Área</label>
                    <div class="mt-2"> <input name="jefe_area" type="checkbox" class="input input--switch border" id="jefe_area"> </div>
                </div>
    
                <div class="mt-3" id="areas">
                    {!! Form::label('Áreas') !!}
                    {!! Form::select('areas[]', $area, null, ['class' => 'input w-full border mt-2', 'placeholder'=>'--Seleccionar--', 'multiple' => true])!!}
                </div>--}}
        
                <div class="mt-5">
                    {{ Form::submit('Guardar', array('class' => "button w-24 bg-theme-1 text-white")) }}
                    {{ Form::close() }}
                </div>
                
            </div>
            <div class="p-5 lg:col-span-6">    
                <div class="mt-3">
                    {!!  Form::label('Email') !!}
                    {!! Form::text('email', $user->email, ['class' => 'input w-full border mt-2', 'placeholder'=>'Email'])!!}
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
                    {!!  Form::text('num_doc', $user->info->num_doc,['class' => 'input w-full border mt-2', 'placeholder'=>'Número de Documento'])!!}
                    @if ($errors->has('num_doc'))
                    <small style="color:red">
                        *{{ $errors->first('num_doc') }}
                    </small>
                    @endif
                </div>
                <div class="mt-3">
                    {!!  Form::label('Fecha de Nacimiento') !!}
                    {!!  Form::date('fecha_nacimiento', $user->info->fecha_nacimiento, ['class' => 'input w-full border mt-2', 'placeholder'=>'Fecha de Nacimiento'])!!}
                    @if ($errors->has('fecha_nacimiento'))
                    <small style="color:red">
                        *{{ $errors->first('fecha_nacimiento') }}
                    </small>
                    @endif
                </div>
                <div class="mt-3">
                    {!!  Form::label('Dirección') !!}
                    {!!  Form::text('direccion', $user->info->direccion, ['class' => 'input w-full border mt-2 ', 'placeholder'=>'Dirección'])!!}
                    @if ($errors->has('direccion'))
                    <small style="color:red">
                        *{{ $errors->first('direccion') }}
                    </small>
                    @endif
                </div>
                
                <div class="mt-3">
                    {!! Form::label('Área a la que pertenece') !!}
                    {!! Form::select('area_id', $area, $user->info->area_id, ['class' => 'input w-full border mt-2', 'placeholder'=>'Selecciona'])!!}
                    @if ($errors->has('area_id'))
                    <small style="color:red">
                        *{{ $errors->first('area_id') }}
                    </small>
                    @endif
                </div>

                <div class="mt-3">
                    {!!  Form::label('Teléfono del Contacto') !!}
                    {!!  Form::text('emergencia_telefono', $user->info->emergencia_telefono, ['class' => 'input w-full border mt-2', 'placeholder'=>'Teléfono del Contacto'])!!}
                    @if ($errors->has('emergencia_telefono'))
                    <small style="color:red">
                        *{{ $errors->first('emergencia_telefono') }}
                    </small>
                    @endif
                </div>

                <div class="mt-5"> <label>Usuario esta Vinculado ?</label>
                <div class="mt-2"> <input name="activo" type="checkbox" class="input input--switch border" id="activo" value="{{$user->activo}}" {{ $user->activo === 1 ? 'checked' : ''}}> </div>
            </div>

            </div>
            
        </div>
    
        {{ Form::close() }}
             
        </div>
    </div>
</div>

@endsection