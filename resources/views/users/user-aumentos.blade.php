<!-- Aumentos -->
<div align="right">
    <a class="button w-24 mr-1 mb-2 bg-theme-1 text-white" href="{{route('aumentos.create')}}"> Agregar </a>
</div>

<div class="intro-y datatable-wrapper box px-5 pt-5 mt-5">
    <table class="table table-report table-report--bordered display datatable w-full">
        <thead>
        <tr class="info">
            <th class="border-b-4 whitespace-no-wrap" width="250px"> N° </th>    
            <th class="border-b-4 whitespace-no-wrap"> Fecha Solicitud </th>
            <th class="border-b-4 whitespace-no-wrap" width="250px"> Estado </th>         
            <th align="right"> <i data-feather="settings"></i> </th>
        </tr>
        </thead>
        <tbody>
            @foreach ($aumentos as $key => $aumento)
            <tr>
                <td> {{$key+1}} </td>
                <td> {{date('d-m-Y', strtotime($aumento->fecha))}}</td>
                <td>
                    @if(isset($aumento->solicitud_id))
                     <div class="circle" style="background-color:{{ $aumento->solicitud->color}}">
                        <p style="margin-left:30px; display: inline-block; width:250px">{{ $aumento->solicitud->nombre}} </p>
                    </div>
                    
                    @endif
                </td>
              
                <td>
                    <div class="btn-group btn-group-sm btn-group-toggle float-right" role="group" aria-label="Acciones">
                        <a href="{{route('aumentos.show', $aumento->id)}}" class="btn btn-primary btn-sm" data-toggle="tooltip" data-placement="bottom" title="Ver Vacacione"> <i data-feather="eye"></i> </a>
                        {{--@if($aumento->solicitud_id == 3)
                        <a href="{{route('aumentos.edit', $aumento->id)}}" class="btn btn-primary btn-sm" data-toggle="tooltip" data-placement="bottom" title="Editar Vacacione"> <i data-feather="edit"></i> </a>
                        {!! Form::model($aumento, ['method' => 'delete', 'route' => ['aumentos.destroy', $aumento->id], 'class' =>'form-inline form-delete']) !!}
                        {!! Form::hidden('id', $aumento->id) !!}
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
<!-- END aumentos -->