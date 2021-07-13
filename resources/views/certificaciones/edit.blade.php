@extends('layouts.master')

@section('title')
<div class="page-header">
  <h2 class="text-center"> <i class="fa fa-archway"></i> Editar Certificación</h2>
</div>
@endsection

@section('content')

<div class="content">
    <div class="grid grid-cols-12 gap-6 mt-5">
        <div class="intro-y col-span-12 lg:col-span-6">

          {{Form::model($certificacione, ['route' => ['certificaciones.update', $certificacione->id], 'method' => 'patch'])}}

            <div class="intro-y box p-5">
                <div class="mt-3">
                    {!! Form::label('Certificación') !!}
                    {!! Form::text('nombre',  null, ['class' => 'input w-full border mt-2', 'placeholder'=>'Nombre'])!!}
                    @if ($errors->has('nombre'))
                    <small style="color:red">
                        *{{ $errors->first('nombre') }}
                    </small>
                    @endif
                </div>
                <div class="mt-3">
                  {!! Form::label('Tipo') !!}
                  {!! Form::text('tipo',  null, ['class' => 'input w-full border mt-2', 'placeholder'=>'Tipo'])!!}
                  @if ($errors->has('tipo'))
                  <small style="color:red">
                      *{{ $errors->first('tipo') }}
                  </small>
                  @endif
              </div>

                <div class="mt-3">
                    {!! Form::label('Descripción') !!}
                    {!! Form::text('descripcion',  null, ['class' => 'input w-full border mt-2', 'placeholder'=>'Descripción'])!!}
                    @if ($errors->has('descripcion'))
                    <small style="color:red">
                        *{{ $errors->first('descripcion') }}
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
