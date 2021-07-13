<!-- certificaciones -->

<div align="right">
  <a class="button w-24 mr-1 mb-2 bg-theme-1 text-white" href="javascript:;" data-toggle="modal" data-target="#registerCertificacion"> Agregar </a>
</div>
<div class="intro-y datatable-wrapper box px-5 pt-5 mt-5">
    <table class="table table-report table-report--bordered display datatable w-full">
        <thead>
        <tr class="info">
            <th class="border-b-4 whitespace-no-wrap"> N° </th>    
            <th class="border-b-4 whitespace-no-wrap"> Nombre </th>
            <th class="border-b-4 whitespace-no-wrap"> Tipo </th>
            <th class="border-b-4 whitespace-no-wrap"> Descripción </th>                
            <th align="right"> <i data-feather="settings"></i> </th>
        </tr>
        </thead>
        <tbody>
            @foreach ($user->certificaciones as $key => $cert)
            <tr>
                <td> {{$key+1}} </td>
                <td> {{$cert->nombre}}</td>
                <td> {{$cert->tipo}}</td>
                <td> {{$cert->descripcion}} </td>
                
                <td>
                    <div class="btn-group btn-group-sm btn-group-toggle float-right" role="group" aria-label="Acciones">
                        <a href="{{route('users.deleteCertificacion', ['user_id' => $user->id , 'certificacione_id' => $cert->id])}}" data-toggle="modal" data-target="" class="btn btn-primary btn-sm"> <i data-feather="trash-2"></i> </a>
                    </div>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
<!-- END certificaciones -->

<div class="modal" id="registerCertificacion">
    <div class="modal__content p-10"> 
        <div class="grid grid-cols-12 gap-6 mt-5">
            <div class="intro-y col-span-12 lg:col-span-12">
                <h3 class="text-2xl text-theme-1 font-medium leading-none mt-5">Registrar Certificación</h3>
                {{ Form::open(array('route' => 'users.storeCertificacion')) }}
                
                {{Form::hidden('user_id', $user->id)}}

                <div class="intro-y box p-5">
                    <div class="mt-3">
                        {!! Form::label('Certificaciones') !!}
                        {!! Form::select('certificacione_id',  $certificaciones, null, ['class' => 'input w-full border mt-2'])!!}
                        @if ($errors->has('certificacione_id'))
                        <small style="color:red">
                            *{{ $errors->first('certificacione_id') }}
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
</div>