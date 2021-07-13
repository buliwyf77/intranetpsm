<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>

<style>
    @page {
        margin-top: 3em;
        margin-left: 4em;
        margin-right: 3em;
        margin-bottom: 5em;
        font-family: Arial,Helvetica,sans-serif;
        font-size: 14px;
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
        line-height : 16px;
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
        height: 80px;
        text-align: center;
        font-size: 10px;
    }

    #footer .page:after { 
    content: counter(page, upper-decimal); 
    }

    .p-proyectos>p {
        display: inline;
    }
    .p3{
        line-height : 5px;
    }

    #firma-usuario {
        position:fixed;
        left: 0px;
        right: 0px;
        bottom: 100px;
        height: 100px;
        text-align: center;
    }
   
</style>

<div id="footer"><br>
    <p class="mayuscula p2" >
        <b> {{$empresa->nombre_empresa}} Rut: {{$empresa->rut}} </b>
        <hr>
    </p>
      <p class="p2">
        * Dirección: {{$empresa->direccion}} * Fono: {{$empresa->telefono}} * E-mail: {{$empresa->email}}
        <br>
        * WEB: www.psmservicios.cl
    </p> 
    <p class="page" align="right">Página N°: </p>
</div>

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
    SOLICITUD AUMENTO DE SUELDO
</p>

<p class="p1">
    Señor (a): <b> Gerencia de RRHH </b> <br>
    <b> Departamento de Desarrollo de Personas </b> <br>
    <b> {{$empresa->nombre_empresa}} </b><br>
    {{$aumento->ciudad}}
</p>
<p>Estimado Señor.</p>
<p align="justify">
    A través de la presente, quiero darle a conocer mi requerimiento, de obtener un aumento en mi salario. 
    De este modo, es importante resaltar, que mi sueldo, se ha mantenido constante, durante los 
    últimos {{ \Carbon\Carbon::createFromDate($user->info->fecha_ingreso)->age}} años 
    a pesar de que siempre, he demostrado un excelente rendimiento en mis funciones laborales; y una gran contribución, 
    al logro de objetivos, de su institución, las cuales están avaladas en las evaluaciones de desempeños realizadas 
    constantemente por mi superior directo dentro de la empresa.
</p>
<p align="justify">
    A continuación menciono algunos de los proyectos y/o funciones que me destacan, que me han encomendado, 
    los cuales han tenido un excelente resultado.
</p>
<p align="justify">
    {!!$aumento->proyectos_funciones!!}
</p>
<p align="justify">
    De esta forma además quisiera incorporar otras funciones para esta nueva etapa, las cuales de acuerdo al conocimiento 
    que poseo de la empresa, sé que serán un excelente aporte para los nuevos desafíos que se nos presentan.
</p>

<p align="justify">
    {!!$aumento->otras_funciones!!}
</p>
<p>
    A la espera de su pronta respuesta, y agradeciendo su atención a la presente. 
    Me despido de usted Atentamente, 
</p>
    <br>
    
    <!--<div id="firma-usuario">
        <div align="center" class="firmas">
            <img src="{{$user->info->firma}}" alt="" width="200px" height="140px" style="z-index:2;">
        </div>
        <div style="margin-top: -75px;">
            <p class="mayuscula p3"> <b>{{$user->name}}</b> </p>
            <p class="mayuscula p3"> <b>{{$aumento->cargo_trabajador}}</b> </p>
        </div>
    </div>-->

    <br>
    <div class="firmas">
        <div class="lado-izquierdo">
            <img src="{{$aumento->user->info->firma}}" alt="" width="200px" height="140px" style="z-index:2;">
            <div style="margin-top:-50px;">
                <p class="mayuscula"> <b>{{$aumento->user->name}}</b> </p>
                <p class="mayuscula"><b>{{$aumento->cargo_trabajador}}</b> </p>
            </div>
        </div>
        
        @if($aumento->solicitud_id == 1)
        <div class="lado-derecho">
            <img src="{{$jefe_aprueba->info->firma}}" alt="" width="200px" height="140px" style="z-index:2;">
            <div style="margin-top:-50px;">
                <p class="mayuscula"><b>{{$jefe_aprueba->name}}</b></p>
                <p> <b>{{$jefe_aprueba->cargo_trabajador}}</b> </p>
            </div>
        </div>
        @endif
    </div>





