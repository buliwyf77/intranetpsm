<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>

<style>
    @page {
        margin-top: 2em;
        margin-left: 4em;
        margin-right: 3em;
        margin-bottom: 5em;
    }

    .caja
    { 
        margin-right: 0px;
        border-width: 1px;
        border-style: solid;
        border-color: black;
        padding: 10px;
        text-align: center; 
        font-weight: bold;
        font-style: none;
        font-size: 14px;
    }

    .caja1
    { 
        margin-right: 0px;
        margin-left: 140px;
        border-width: 1px;
        border-style: solid;
        border-color: black;
        padding: 3px;
        text-align: center; 
        font-weight: bold;
        font-style: none;
        font-size: 14px;
    }

    .firmas
    {
        padding: 10px;
        padding-bottom: 50px;
    }

    .lado-izquierdo
    {
        float: left;
        padding: 10px;
        width: 50%;
        text-align: center;
    }

    .lado-derecho
    {
        float: left;
        padding: 10px;
        width: 50%;
        text-align: center; 
    }

    p{
        font-family: Arial,Helvetica,sans-serif;
        font-size: 14px;
    }

    .p1
    {
        line-height : 25px;
        font-style: italic;
    }

    .p2{
        line-height : 18px;
    }

    .mayuscula
    {
        text-transform: uppercase;
    }

    #footer{
        position:fixed;
        left: 0px;
        bottom: 0px;
        right: 0px;
        height: 40px;
        text-align: center;
    }

    #footer .page:after { 
    content: counter(page, upper-decimal); 
    }

</style>

<table>
    <tr>
        <td align="left"><img src="C:/xampp/htdocs/intranet/public/images/psm-small.png" alt="logo-psm" ></td>
        <td align="right">
            <p class="p2 caja1">
                <b> {{$empresa->nombre_empresa}} </b> <br>
                Gerencia de RRHH <br>
                Departamento de Desarrollo de Personas
            </p>
        </td>
    </tr>
</table>

<p class="caja">
    SOLICITUD DE VACACIONES
</p>

<p class="p1">
    Señor: <br>
    <b class="mayuscula">{{$empresa->nombre_empresa}} </b><br>
    Presente.
</p>

<p class="p2 caja mayuscula">
<b>De: </b> {{$solicitud_vacaciones->user->name}} <br>
<b>Materia: </b> VACACIONES <br>
<b>Fecha de Solicitud: </b> {{date('d-m-Y', strtotime($solicitud_vacaciones->fecha))}}
</p>

<p class="p1"> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Solicito a usted autorizar mi petición de vacaciones de acuerdo al siguiente detalle:</p>
<p class="p1">N° de días solicitados: <b> {{$solicitud_vacaciones->cantidad_dia}} días hábiles </b> </p>
<p class="p1">Periodo solicitado desde el <b> {{date('d-m-Y', strtotime($solicitud_vacaciones->fecha_inicio))}} </b> al <b>{{date('d-m-Y', strtotime($solicitud_vacaciones->fecha_culminacion))}}, </b> ambas fechas inclusive.</p>
<p class="p1">Fecha de reintegro a mis funciones: <b> {{date('d-m-Y', strtotime($solicitud_vacaciones->fecha_reintegro))}} </b> </p>
<br>
<p class="p1">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Sin otro particular, saluda atentamente a usted,</p>

<br>
<div class="firmas">
    <div class="lado-izquierdo">
        <img src="{{$solicitud_vacaciones->user->info->firma}}" alt="" width="200px" height="140px" style="z-index:2;">
        <div style="margin-top:-50px;">
            <p class="mayuscula"> <b>{{$solicitud_vacaciones->user->name}}</b> </p>
            <p class="mayuscula"><b>{{$solicitud_vacaciones->cargo_trabajador}}</b> </p>
        </div>
    </div>
    
    <div class="lado-derecho">
        <img src="{{$jefe_area->info->firma}}" alt="" width="200px" height="140px" style="z-index:2;">
        <div style="margin-top:-50px;">
            <p class="mayuscula"><b>{{$jefe_area->name}}</b></p>
            <p> <b>{{$jefe_area->cargo_trabajador}}</b> </p>
        </div>
    </div>
</div>

<br>
<p style="margin-top:100px;"><b>USO INTERNO:</b> </p>
<p>Feha ingreso del trabajador: {{ date('d-m-Y', strtotime($solicitud_vacaciones->user->info->fecha_ingreso))}}</p>
<p>Periodo de vacaciones: {{$solicitud_vacaciones->periodo_vacaciones}}</p>
<p>Días acumulados: {{$solicitud_vacaciones->dias_acumulados}}</p>
<p>Saldo: {{$solicitud_vacaciones->saldo}} días.</p>
<br>

<div id="footer">
    <p class="mayuscula" >
        <b> {{$empresa->nombre_empresa}} Rut: {{$empresa->rut}} </b>
    </p>
    <hr>
    <p class="p2">
        * Dirección: {{$empresa->direccion}} * Fono: {{$empresa->telefono}} * E-mail: {{$empresa->email}}
        <br>
        * WEB: www.psmservicios.cl
    </p>
</div>


