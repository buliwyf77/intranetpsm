<!-- vacaciones -->
<div align="right">
  <a class="button w-24 mr-1 mb-2 bg-theme-1 text-white" href="{{route('vacaciones.create')}}"> Agregar </a>
</div>

<div class="intro-y datatable-wrapper box px-5 pt-5 mt-5">
    <table class="table table-report table-report--bordered display datatable w-full">
        <thead>
        <tr class="info">
            <th class="border-b-4 whitespace-no-wrap" > N° </th>    
            <th class="border-b-4 whitespace-no-wrap"> Fecha Solicitud </th>
            <th class="border-b-6 whitespace-no-wrap"> Dias Solicitados</th>  
            <th class="border-b-4 whitespace-no-wrap" width="250px"> Estado </th>         
            <th align="right"> <i data-feather="settings"></i> </th>
        </tr>
        </thead>
        <tbody>
            @foreach ($vacaciones as $key => $vacacion)
            <tr>
                <td> {{$key+1}} </td>
                <td> {{date('d-m-Y', strtotime($vacacion->fecha))}}</td>
                <td> {{ $vacacion->cantidad_dia }} </td>
                <td>
                    @if(isset($vacacion->solicitud_id))
                    <div class="circle" style="background-color:{{ $vacacion->solicitud->color}}">
                        <p style="margin-left:30px; display: inline-block; width:250px">{{ $vacacion->solicitud->nombre}} </p>
                    </div>
                    @endif
                </td>
                
                <td>
                    <div class="btn-group btn-group-sm btn-group-toggle float-right" role="group" aria-label="Acciones">
                        <a href="{{route('vacaciones.show', $vacacion->id)}}" class="btn btn-primary btn-sm" data-toggle="tooltip" data-placement="bottom" title="Ver Vacacione"> <i data-feather="eye"></i> </a>
                        {{--@if($vacacion->solicitud_id == 3)
                        <a href="{{route('vacaciones.edit', $vacacion->id)}}" class="btn btn-primary btn-sm" data-toggle="tooltip" data-placement="bottom" title="Editar Vacacione"> <i data-feather="edit"></i> </a>
                        {!! Form::model($vacacion, ['method' => 'delete', 'route' => ['vacaciones.destroy', $vacacion->id], 'class' =>'form-inline form-delete']) !!}
                        {!! Form::hidden('id', $vacacion->id) !!}
                        <button type="submit" name="delete_modal" class="btn btn-danger btn-sm delete" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="Eliminar"><i data-feather="trash-2"></i></button>
                        {!! Form::close() !!}
                        @endif--}}
                    </div>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
<!-- END vacaciones -->