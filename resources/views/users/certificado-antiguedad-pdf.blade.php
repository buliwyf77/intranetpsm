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
        font-size: 18px;
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
        padding: 0px;
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
        <td align="left"><img src="C:/xampp/htdocs/intranet-v-2/public/images/psm-small.png" alt="logo-psm" ></td>
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
    CERTIFICADO DE ANTIGUEDAD
</p>

<div align="right" class="p1">
    @php 
        //\Carbon\Carbon::setLocale('es');
        $date = \Carbon\Carbon::now()->locale('es');
    @endphp
    @php $mes_ingreso = \Carbon\Carbon::parse($contrato->fecha_inicio) @endphp
    <p> Santiago, {{date('d')}} de {{$date->formatLocalized('%B')}} de {{date('Y')}} </p>
</div>
<br>
<div align="justify">
<p class="p1">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <b>{{$empresa->nombre_empresa}}</b>, Rut: {{$empresa->rut}}, CERTIFICA
que Don (ña) <b> {{$user->name}}, </b> <b>{{$user->info->doc_identidad}}: {{$user->info->num_doc}}, </b> de nacionalidad <b>{{$user->info->nacionalidad}},</b>
es empleado de nuestra empresa desde el <b>{{date('d', strtotime($contrato->fecha_inicio))}} de {{$mes_ingreso->monthName}} de
    {{date('Y', strtotime($contrato->fecha_inicio))}},
</b> hasta la fecha, desempeñándose en el cargo de 
<b class="mayuscula"> {{$contrato->cargo->nombre}} </b>. 
</p>
<p class="p1">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Se hace mención que su contrato de trabajo es de carácter <b class="mayuscula">{{$contrato->tipo_contrato->nombre}} </b>.</p>
<br>
<p class="p1">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Se extiende el presente certificado a petición del interesado, para los fines que estime conveniente.</p>
<br>
<br>
<p class="p1">Saluda atentamente a Ud.</p>
</div>
<br>
<br>
<br>
<br>
<br>

<div class="firmas ">
    <div class="lado-izquierdo">
        <img src="https://intranet1.s3-sa-east-1.amazonaws.com/users-firmas/xassdas115ada4s5da.png" alt="firma1"  width="200px" height="140px" style="z-index:2;>
	<div style="margin-top:-60px;">        
		<p class="p2"> <b>PABLO ANDRES POBLETE GUERRERO </b> <br>
		C.I.: 13.045.824-6 <br>
		Representante Legal <br>
		Gerente de Administración y Finanzas</p>
	</div>
    </div>
    
    <div class="lado-derecho">
        <img src="C:/xampp/htdocs/intranet/public/images/firmas/firma1.png" alt="firma1" >
        <p> <b>ALFREDO HERNAN MORALES TAPIA</b> <br>
        C.I.: 15.889.048-8 <br>
        Representante Legal <br>
        Gerente General</p>    
    </div>
</div>

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