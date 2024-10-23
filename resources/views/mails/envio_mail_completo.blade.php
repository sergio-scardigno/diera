<!doctype html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0">
    <title>  {{ $completo->codigo_jurisdiccional }}</title>
</head>
<body>
    <p>            
      </p>
    <table cellpadding="0" border="0" cellspacing="0" width="100%">
      <tbody><tr><td align="left" style="color:#000;font-family:'Atlas Grotesk','Open Sans','Lucida Grande','Segoe UI',Arial,Verdana,'Lucida Sans Unicode',Tahoma,'Sans Serif','Proxima Nova',Georgia;font-size:18px;font-weight:500;line-height:26px;padding:15px 0 0">
          <b> {{ $completo->nombre }} <br></b>
        </td></tr>
         <tr><td align="left" style="border-bottom:1px solid #e6e8eb;color:#000;font-family:'Atlas Grotesk','Open Sans','Lucida Grande','Segoe UI',Arial,Verdana,'Lucida Sans Unicode',Tahoma,'Sans Serif','Proxima Nova',Georgia;font-size:18px;font-weight:300;line-height:26px;padding:5px 0 20px">
           Te enviamos este correo electrónico porque tienes un formulario <b>{{$completo->nombre_corto}} </b> con el estado <b> {{ $completo->descripcion}} </b>   
            en el relevamiento {{$periodo->periodo}}. <br>
            <b> Por favor te pedimos que lo confirmes.</b><br>

            <b> Responsable de la encuesta: </b> {{ $completo->responsable }} <br>
            <b>Clave Jurisdiccional: </b> {{ $completo->codigo_jurisdiccional }} <br>
            <b>Cue-Anexo: </b> {{ $completo->cueanexo }} <br>
        </td></tr>
            </tbody></table>
            <br>
            <table cellpadding="0" style="width:260px" cellspacing="0"><tbody><tr><td style="background-color:#38c172;text-align:center;width:250px">
                <a style="background-color:#38c172;border:0px solid #38c172;border-radius:0px;color:#fff;display:block;font-family:'Atlas Grotesk','Open Sans','Lucida Grande','Segoe UI',Arial,Verdana,'Lucida Sans Unicode',Tahoma,'Sans Serif','Proxima Nova',Georgia;font-size:18px;font-weight:300;max-width:250px;padding:15px;text-align:center;text-decoration:none"                  
                href="http://mapaescolar.abc.gob.ar/dierefi/formulario/{{$completo->id_localizacion_periodo}}/1?">
                    Confirmar el formulario </a>
            </td></tr></tbody></table>
            <br>
            <table cellpadding="0" border="0" cellspacing="0" width="100%"><tbody><tr>
              <td style="border-bottom:1px solid #e6e8eb;color:#000;font-family:'Atlas Grotesk','Open Sans','Lucida Grande','Segoe UI',Arial,Verdana,'Lucida Sans Unicode',Tahoma,'Sans Serif','Proxima Nova',Georgia;font-size:18px;font-weight:300;line-height:26px;padding:5px 0 20px">
                Por favor, no responda este mensaje. <br>
                <b>Dirección de Información y Estadística  </b><br>
                Teléfonos 0800-2222338 / (0221)483-6721 <br>
                Email: die.relevamientos@gmail.com
            </td></tr></tbody></table>
    
</body>
</html>