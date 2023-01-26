<?php
include_once("correo.php");
include_once("../include/path.php");
/*
    Los tipos de correo son:
    1: Envia un correo al solicitante.
    2: Envía un correo al Staff.
*/

class correoContacto extends correo
{
    var $contacto;
    var $nombre;
    var $correo_mensaje;
    var $telefono;
    var $servicio;
    var $mensaje;

    function __construct($nombre = '', $correo = '', $telefono = '', $asunto = '', $mensaje = ''){    
        $this -> correo();
        $this -> nombre = $nombre;
        $this -> correo_mensaje = $correo;
        $this -> asunto = $asunto;
        $this -> telefono = $telefono;
        $this -> mensaje = $mensaje;
    }
    
    function genera_asunto(){		
        $this -> correo -> Subject = $this->asunto;
    }
    
    function genera_destino(){

        $contacto=new contacto();
        $contacto->obtener_contacto();
        $this -> correo -> AddAddress($contacto -> correo);
    }
    
    function genera_mensaje(){
        $SITENAME = 'Incotherm';
         /*ESTILOS CORREO:*/
        $backgroundColor="#0E1524";
        $sectionColor="#ffffff";
        $borderSectionColor="#0E1524";
        $StaticColor="#000000";
        $dinamicColor="#000000";
        $buttonColor="#21a7ff";
        $backgroundDatosMensaje="#21a7ff";
        $colorDatosMensaje="#ffffff";
        $logo="logo-inco.png";
        $imgFondo="";
        $direccionEmpresa="";
        $telefonoEmpresa="";

        date_default_timezone_set('America/Merida');
        $date = date ("H");
        if ($date < 12) $saludo= "¡Buenos dias!";
        else if ($date < 18) $saludo= "¡Buenas tardes!";
        else $saludo= "¡Buenas noches!";
        $this -> correo -> Body = ' <!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta charset="utf-8"> <!-- utf-8 works for most cases -->
    <meta name="viewport" content="width=device-width"> 
    <meta http-equiv="X-UA-Compatible" content="IE=edge"> <!-- Use the latest (edge) version of IE rendering engine -->
    <meta name="x-apple-disable-message-reformatting">  <!-- Disable auto-scale in iOS 10 Mail entirely -->
    <title></title> <!-- The title tag shows in email notifications, like Android 4.4. -->
        <style>
        html,
        body {
            margin: 0 auto !important;
            padding: 0 !important;
            height: 100% !important;
            width: 100% !important;
        }
        * {
            -ms-text-size-adjust: 100%;
            -webkit-text-size-adjust: 100%;
        }
        div[style*="margin: 16px 0"] {
            margin:0 !important;
        }
        table,
        td {
            mso-table-lspace: 0pt !important;
            mso-table-rspace: 0pt !important;
        }
         table {
            border-spacing: 0 !important;
            border-collapse: collapse !important;
            table-layout: fixed !important;
            margin: 0 auto !important;
        }
        table table table {
            table-layout: auto; 
        }
          img {
            -ms-interpolation-mode:bicubic;
        }
        .mobile-link--footer a,
        a[x-apple-data-detectors] {
            color:inherit !important;
            text-decoration: underline !important;
        }
        .button-link {
            text-decoration: none !important;
        }
      
    </style>
     <style>
         .button-td,
        .button-a {
            transition: all 100ms ease-in;
        }
        .button-td:hover,
        .button-a:hover {
            background: #555555 !important;
            border-color: #555555 !important;
        }

        /* Media Queries */
        @media screen and (max-width: 600px) {
            .email-container {
                width: 100% !important;
                margin: auto !important;
            }
            .fluid {
                max-width: 100% !important;
                height: auto !important;
                margin-left: auto !important;
                margin-right: auto !important;
            }
            .stack-column,
            .stack-column-center {
                display: block !important;
                width: 100% !important;
                max-width: 100% !important;
                direction: ltr !important;
            }
            .stack-column-center {
                text-align: center !important;
            }
             .center-on-narrow {
                text-align: center !important;
                display: block !important;
                margin-left: auto !important;
                margin-right: auto !important;
                float: none !important;
            }
            table.center-on-narrow {
                display: inline-block !important;
            }
        }
    </style>
</head>
<body bgcolor="#222222" width="100%" style="margin: 0;">
    <center style="width: 100%; background: '.$backgroundColor.';">
        <div style="display:none;font-size:1px;line-height:1px;max-height:0px;max-width:0px;opacity:0;overflow:hidden;mso-hide:all;font-family: sans-serif;">
            Has recibido un nuevo mensaje de '.$nombre.' desde el sitio '.$SITENAME.'
        </div>
         <table role="presentation" cellspacing="0" cellpadding="0" border="0" align="center" width="600" style="margin: auto;" class="email-container">
            <tr>
                <td style="padding: 20px 0; text-align: center;" >
                    <img src="'.PATH.'img/'.$logo.'" alt="'.$SITENAME.'" border="0" style="height: auto; background: transparent; font-family: sans-serif; font-size: 15px; mso-height-rule: exactly; line-height: 20px; color: '.$StaticColor.';">
                </td>
            </tr>
        </table>
        <table role="presentation" cellspacing="0" cellpadding="0" border="0" align="center" width="600" style="margin: auto;" class="email-container">
             <tr style="border: 1px solid '.$borderSectionColor.';">
                <td bgcolor="'.$sectionColor.'" style="padding: 40px; text-align: center; font-family: sans-serif; font-size: 15px; mso-height-rule: exactly; line-height: 20px; color: '.$StaticColor.';">
                    '.$saludo.' Usted ah recibido un nuevo mensaje de: <a style="color:'.$dinamicColor.'" href="mailto:'.$correo.'">'.$this -> correo_mensaje.'</a> 
                    <br><br>
                    
                </td>
            </tr>
            <tr>
                <td height="40" style="font-size: 0; line-height: 0;">
                    &nbsp;
                </td>
            </tr>
            <tr style="border-right:1px solid '.$borderSectionColor.'; border-left: 1px solid '.$borderSectionColor.'; border-top:1px solid '.$borderSectionColor.'">
                <td bgcolor="'.$backgroundDatosMensaje.'" align="center" valign="top" style="padding: 10px;">
                    <table role="presentation" cellspacing="0" cellpadding="0" border="0" width="100%">
                        <tr>
                            <!-- Column : BEGIN -->
                            <td class="stack-column-center">
                                <table role="presentation" cellspacing="0" cellpadding="0" border="0">
                                    <tr>
                                        <td style="font-family: sans-serif; font-size: 15px; mso-height-rule: exactly; line-height: 20px; color: '.$colorDatosMensaje.';  text-align: left;" class="center-on-narrow">
                                            Estos son los datos del mensaje:

                                        </td>
                                    </tr>
                                </table>
                            </td>
                        </tr>
                    </table>
                </td>
            </tr>
            <tr style="border-right:1px solid '.$borderSectionColor.';border-left:1px solid '.$borderSectionColor.'">
                <td bgcolor="'.$sectionColor.'" dir="ltr" align="center" valign="top" width="100%" style="padding: 10px;">
                    <table role="presentation" align="center" border="0" cellpadding="0" cellspacing="0" width="100%">
                        <tr>
                            <td width="33.33%" class="stack-column-center" bgcolor="#000000">
                                <table role="presentation" align="center" border="0" cellpadding="0" cellspacing="0" width="100%">
                                    <tr>
                                        <td dir="ltr" valign="top" style="padding: 0 10px;text-align:center;" >
                                            <img src="'.PATH.'img/'.$logo.'" width="70%" alt="'.$SITENAME.'" border="0" class="center-on-narrow" style="height: auto; background: transparent; font-family: sans-serif; font-size: 15px; mso-height-rule: exactly; line-height: 20px; color: '.$StaticColor.';">
                                        </td>
                                    </tr>
                                </table>
                            </td>
                            <td width="66.66%" class="stack-column-center">
                                <table role="presentation" align="center" border="0" cellpadding="0" cellspacing="0" width="100%">
                                    <tr>
                                        <td dir="ltr" valign="top" style="font-family: sans-serif; font-size: 15px; mso-height-rule: exactly; line-height: 20px; color: '.$dinamicColor.'; padding: 10px; text-align: left;" class="center-on-narrow">
                                            <strong style="color:'.$StaticColor.';">Nombre:</strong>
                                            <br>
                                            '.$this->nombre.'
                                            <br><br>
                                            <strong style="color:'.$StaticColor.';">Telefono:</strong>
                                            <br>
                                            '.$this->telefono.'
                                            <br><br>
                                            <strong style="color:'.$StaticColor.';">Asunto:</strong>
                                            <br>
                                            '.$this->asunto.'
                                            <br>   
                                        </td>
                                    </tr>
                                </table>
                            </td>
                        </tr>
                    </table>
                </td>
            </tr>
            <tr style="border-right:1px solid '.$borderSectionColor.';border-left:1px solid '.$borderSectionColor.'">
                <td bgcolor="'.$sectionColor.'" dir="rtl" align="center" valign="top" width="100%" style="padding: 10px;">
                    <table role="presentation" align="center" border="0" cellpadding="0" cellspacing="0" width="100%">
                        <tr>
                            <td width="80%" class="stack-column-center">
                                <table role="presentation" align="center" border="0" cellpadding="0" cellspacing="0" width="100%">
                                    <tr>
                                        <td dir="ltr" valign="top" style="font-family: sans-serif; font-size: 15px; mso-height-rule: exactly; line-height: 20px; color: '.$dinamicColor.'; padding: 10px; text-align: left;" class="center-on-narrow">
                                            <strong style="color:'.$StaticColor.';">Mensaje: </strong>
                                            <br><br>
                                            '.$this->mensaje.'
                                            <br><br>  
                                        </td>
                                    </tr>

                                </table>
                    <table role="presentation" cellspacing="0" cellpadding="0" border="0" align="center" style="margin: auto">
                        <tr>
                            <td style="border-radius: 3px; background: '.$buttonColor.'; text-align: center;" class="button-td">
                                <a href="mailto:'.$this->correo_mensaje.'" style="background: '.$buttonColor.'; border: 15px solid '.$buttonColor.'; font-family: sans-serif; font-size: 13px; line-height: 1.1; text-align: center; text-decoration: none; display: block; border-radius: 3px; font-weight: bold;" class="button-a">
                                    &nbsp;&nbsp;&nbsp;&nbsp;<span style="color:#ffffff;">Responder</span>&nbsp;&nbsp;&nbsp;&nbsp;
                                </a>
                            </td>
                        </tr>
                    </table>
                            </td>
                        </tr>
                    </table>
                </td>
            </tr>            
            <tr style="border-right:1px solid '.$borderSectionColor.';border-left:1px solid '.$borderSectionColor.';border-bottom:1px solid '.$borderSectionColor.'">
                <td bgcolor="'.$sectionColor.'">
                    <table role="presentation" cellspacing="0" cellpadding="0" border="0" width="100%">
                        <tr>
                            <td style="padding: 40px; font-family: sans-serif; font-size: 15px; mso-height-rule: exactly; line-height: 20px; color: #555555;">
                               
                            </td>
                            </tr>
                    </table>
                </td>
            </tr>
        </table>
        <table role="presentation" cellspacing="0" cellpadding="0" border="0" align="center" width="600" style="margin: auto;" class="email-container">
            <tr>
                <td style="padding: 40px 10px;width: 100%;font-size: 12px; font-family: sans-serif; mso-height-rule: exactly; line-height:18px; text-align: center; color: #888888;">
                    <a href="'.PATH.'" style="color:#cccccc; text-decoration:underline; font-weight: bold;">'.$SITENAME.'</a>
                    <br><br><span class="mobile-link--footer">'.$direccionEmpresa.'</span><br><span class="mobile-link--footer">'.$telefonoEmpresa.'</span>
                    <br><br> 
                </td>
            </tr>
        </table>
    </center>
</body>
</html>';
    }
}
?>