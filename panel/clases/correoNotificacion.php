<?php
include_once("correo.php");
include_once("contacto.php");
include_once("postulante.php");
/*
    Los tipos de correo son:
    1: Envia un correo al solicitante.
    2: Envía un correo al Staff.
*/

class correoNotificacion extends correo
{
    var $tipo;
    var $contacto;
    var $postulante;
    var $path = "http://clientes.locker.com.mx/mid/";

    function __construct($tipo = 0, $idPostulante = 0){    
        $this -> correo();
        $this -> tipo = $tipo;
		$this -> contacto = new contacto();
        $this -> contacto -> obtener_contacto();
        $this -> postulante = new postulante($idPostulante);
        $this -> postulante -> getPostulante();
  
    }
    
    function genera_asunto(){
        $motivo = '';
        if($this -> tipo == 1)
            $motivo = 'MID TE A ENVIADO UN MENSAJE';
        if($this -> tipo == 2)
            $motivo = 'NUEVA SOLICITUD';		
        $this -> correo -> Subject = $motivo;
    }
    
    function genera_destino(){
        if($this -> tipo == 1)
            $this -> correo -> AddAddress($this -> postulante -> _correo);
        else
            $this -> correo -> AddAddress($this -> contacto -> correo);
    }
    
    function genera_mensaje(){						
    $this -> correo -> Body='
<html>
    <head>
    <meta charset="UTF-8">
    <!-- utf-8 works for most cases -->
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Forcing initial-scale shouldnt be necessary -->
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <!-- Use the latest (edge) version of IE rendering engine -->
    <title>MID</title>
    <!-- The title tag shows in email notifications, like Android 4.4. -->
    <!-- Please use an inliner tool to convert all CSS to inline as inpage or external CSS is removed by email clients -->
    <!-- important in CSS is used to prevent the styles of currently inline CSS from overriding the ones mentioned in media queries when corresponding screen sizes are encountered -->

    <!-- CSS Reset -->
    <style type="text/css">
/* What it does: Remove spaces around the email design added by some email clients. */
      /* Beware: It can remove the padding / margin and add a background color to the compose a reply window. */
html,  body {
    margin: 0 !important;
    padding: 0 !important;
    height: 100% !important;
    width: 100% !important;
}
/* What it does: Stops email clients resizing small text. */
* {
    -ms-text-size-adjust: 100%;
    -webkit-text-size-adjust: 100%;
}
/* What it does: Forces Outlook.com to display emails full width. */
.ExternalClass {
    width: 100%;
}
/* What is does: Centers email on Android 4.4 */
div[style*="margin: 16px 0"] {
    margin: 0 !important;
}
/* What it does: Stops Outlook from adding extra spacing to tables. */
table,  td {
    mso-table-lspace: 0pt !important;
    mso-table-rspace: 0pt !important;
}
/* What it does: Fixes webkit padding issue. Fix for Yahoo mail table alignment bug. Applies table-layout to the first 2 tables then removes for anything nested deeper. */
table {
    border-spacing: 0 !important;
    border-collapse: collapse !important;
    table-layout: fixed !important;
    margin: 0 auto !important;
}
table table table {
    table-layout: auto;
}
/* What it does: Uses a better rendering method when resizing images in IE. */
img {
    -ms-interpolation-mode: bicubic;
}
/* What it does: Overrides styles added when Yahoos auto-senses a link. */
.yshortcuts a {
    border-bottom: none !important;
}
/* What it does: Another work-around for iOS meddling in triggered links. */
a[x-apple-data-detectors] {
    color: inherit !important;
}
</style>

    <!-- Progressive Enhancements -->
    <style type="text/css">
        
        /* What it does: Hover styles for buttons */
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
            }

            /* What it does: Forces elements to resize to the full width of their container. Useful for resizing images beyond their max-width. */
            .fluid,
            .fluid-centered {
                max-width: 100% !important;
                height: auto !important;
                margin-left: auto !important;
                margin-right: auto !important;
            }
            /* And center justify these ones. */
            .fluid-centered {
                margin-left: auto !important;
                margin-right: auto !important;
            }

            /* What it does: Forces table cells into full-width rows. */
            .stack-column,
            .stack-column-center {
                display: block !important;
                width: 100% !important;
                max-width: 100% !important;
                direction: ltr !important;
            }
            /* And center justify these ones. */
            .stack-column-center {
                text-align: center !important;
            }
        
            /* What it does: Generic utility class for centering. Useful for images, buttons, and nested tables. */
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
    <body bgcolor="#fff" width="100%" style="margin: 0;" yahoo="yahoo">
    <table bgcolor="#fff" cellpadding="0" cellspacing="0" border="0" height="100%" width="100%" style="border-collapse:collapse;">
        <tr>
            <td>
                <center style="width: 100%;">
            
                <!-- Visually Hidden Preheader Text : BEGIN -->
                <div style="display:none;font-size:1px;line-height:1px;max-height:0px;max-width:0px;opacity:0;overflow:hidden;mso-hide:all;font-family: sans-serif;"> Correo Contacto </div>
                <!-- Visually Hidden Preheader Text : END --> 
            
                <!-- Email Header : BEGIN -->
                <table align="center" width="600" style="margin-bottom:10px !important;" class="email-container">
                    <tr>
                        <td width="240"><img src="'.$this -> path.'img/logo-mid.png"  alt="alt_text" border="0"></td>
                        <td width="360" style="padding: 20px 0; text-align: right; border:1px solid #000">
                            <a href=""><img src="'.$this -> path.'img/correoResources/logo-face.jpg"></a>
                            <a style="margin-right:10px;" href=""><img src="'.$this -> path.'img/correoResources/logo-ins.jpg"></a>
                        </td>
                    </tr>
                </table>
                <!-- Email Header : END --> 
            
                <!-- Email Body : BEGIN -->
                <table cellspacing="0" cellpadding="0" border="0" align="center" bgcolor="#ffffff" width="600" class="email-container">
            
                <!-- Hero Image, Flush : BEGIN -->
                <tr>
                    <td style="background-color:#000; color:#fff; padding:20px; font-size:30px;">MID ÚNETE</td>
                </tr>
                <tr>
                    <td style="background-color:#fff; color:#fff; padding:5px; font-size:30px;"></td>
                </tr>
                <tr>
                    <td style="background-color:#fff; color:#fff; padding:20px; border:1px solid #000;">&nbsp;</td>
                </tr>
                <tr>
                    <td style="background-color:#fff; color:#fff; padding:5px; font-size:30px;"></td>
                </tr>
                <!-- Hero Image, Flush : END --> 
            
                <!-- 1 Column Text : BEGIN -->
                <tr>
                    <td style="border:1px solid #000; padding: 20px; text-align: left; font-family: sans-serif; font-size: 15px; mso-height-rule: exactly; line-height: 20px; color: #555555;"> 
                        <b>Nombre:</b> '.$this -> postulante -> _nombre.' <br>
                        <b>Correo:</b> '.$this -> postulante -> _correo.' <br>
                        <b>Telèfono:</b> '.$this -> postulante -> _telefono.' <br>
                        <b>Especialidad:</b> '.$this -> postulante -> _especialidad.' <br>
                        <b>Estado:</b> '.$this -> postulante -> _estado.' <br>
                        <b>Ciudad:</b> '.$this -> postulante -> _ciudad.' <br>
                        <b>Mensaje:</b> '.$this -> postulante -> _mensaje.' <br>
                    </td>
                </tr>
                <!-- 1 Column Text : BEGIN --> 
                <tr>
                    <td style="background-color:#fff; color:#fff; padding:5px; font-size:30px;"></td>
                </tr>
                <!-- Background Image with Text : BEGIN -->
                <tr>
                    <td background="images/Image_600x230.png" bgcolor="#222222" valign="middle" style="text-align: center; background-position: center center !important; background-size: cover !important;"><!--[if gte mso 9]>
                        <v:rect xmlns:v="urn:schemas-microsoft-com:vml" fill="true" stroke="false" style="width:600px;height:175px; background-position: center center !important;">
                        <v:fill type="tile" src="assets/Responsive/Image_600x230.png" color="#222222" />
                        <v:textbox inset="0,0,0,0">
                        <![endif]-->
                    
                        <div>
                            <table align="center" border="0" cellpadding="0" cellspacing="0" width="100%">
                                <tr>
                                    <td valign="middle" style="text-align: center; padding: 40px; font-family: sans-serif; font-size: 12px; mso-height-rule: exactly; line-height: 20px; color: #ffffff;">
                                        <table cellspacing="0" cellpadding="0" border="0" class="center-on-narrow" style="float:left;">
                                            <tr>
                                                <td width="25px" height="20px;" style="background: #fff; text-align: center; border-spacing: 10px;" class="button-td">
                                                    &nbsp;
                                                </td>
                                                <td width="5px" style="width:5px !important; background: #222222; text-align: center;" class="button-td">
                                                    
                                                </td>
                                                <td width="500px" style="border: 1px solid #fff; background: #222222; text-align: left; padding-left:10px; color:#fff" class="button-td">
                                                    Manufactura en Industria de Diseño
                                                </td>
                                                
                                            </tr>
                                            <tr style="line-height:.5">
                                                <td collspan="3">&nbsp;</td>
                                            </tr>
                                            <tr>
                                                <td width="25px" height="20px;" style="background: #fff; text-align: center; color:#000;" class="button-td">
                                                    T.
                                                </td>
                                                <td width="5px" style="width:5px !important; background: #222222; text-align: center;" class="button-td">
                                                    
                                                </td>
                                                <td width="500px" style="border: 1px solid #fff; background: #222222; text-align: left; padding-left:10px; color:#fff" class="button-td">
                                                    +52 (999) 941 5728
                                                </td>
                                            </tr>
                                            <tr style="line-height:.5">
                                                <td collspan="3">&nbsp;</td>
                                            </tr>
                                            <tr>
                                                <td width="25px" height="20px;" style="background: #fff; text-align: center; color:#000;" class="button-td">
                                                    C.
                                                </td>
                                                <td width="5px" style="width:5px !important; background: #222222; text-align: center;" class="button-td">
                                                    
                                                </td>
                                                <td width="500px" style="border: 1px solid #fff; background: #222222; text-align: left; padding-left:10px; color:#fff" class="button-td">
                                                    contacto@mid.mx
                                                </td>
                                            </tr>
                                            <tr style="line-height:.5">
                                                <td collspan="3">&nbsp;</td>
                                            </tr>
                                            <tr>
                                                <td width="25px" height="20px;" style="background: #fff; text-align: center; color:#000;" class="button-td">
                                                    D.
                                                </td>
                                                <td width="5px" style="width:5px !important; background: #222222; text-align: center;" class="button-td">
                                                    
                                                </td>
                                                <td width="500px" style="border: 1px solid #fff; background: #222222; text-align: left; padding-left:10px; color:#fff" class="button-td">
                                                    C. 19, #289 entre 30 y 32, Col. Montecarlo
                                                </td>
                                                
                                            </tr>
                                            <tr style="line-height:.5">
                                                <td collspan="3">&nbsp;</td>
                                            </tr>
                                            <tr>
                                                <td width="50px" height="20px;" style="background: #fff; text-align: center; color:#000;" class="button-td">
                                                    F.
                                                </td>
                                                <td width="5px" style="width:5px !important; background: #222222; text-align: center;" class="button-td">
                                                    
                                                </td>
                                                <td width="500px" style="border: 1px solid #fff; background: #222222; text-align: left; padding-left:10px; color:#fff" class="button-td">
                                                    /MID-Arquitectos
                                                </td>
                                                
                                            </tr>
                                            <tr style="line-height:.5">
                                                <td collspan="3">&nbsp;</td>
                                            </tr>
                                            <tr>
                                                <td width="25px" height="20px;" style="background: #fff; text-align: center; color:#000;" class="button-td">
                                                    I.
                                                </td>
                                                <td width="5px" style="width:5px !important; background: #222222; text-align: center;" class="button-td">
                                                    
                                                </td>
                                                <td width="500px" style="border: 1px solid #fff; background: #222222; text-align: left; padding-left:10px; color:#fff" class="button-td">
                                                    @MID-Arquitectos
                                                </td>
                                            </tr>
                                            <tr style="line-height:.5">
                                                <td colspan="3">&nbsp;</td>
                                            </tr>
                                             <tr style="line-height:.5">
                                                <td colspan="3">&nbsp;</td>
                                            </tr>
                                            <tr>
                                                <td colspan="3" background="'.$this -> path.'img/correoResources/correo-patron.jpg" style="background-repeat: repeat; background-position: right top; height:30px;" >
                                                    &nbsp;
                                                </td>
                                            </tr>
                                        </table>
                                        
                                    </td>
                                </tr>
                            </table>
                        </div>
                    
                    <!--[if gte mso 9]>
                        </v:textbox>
                        </v:rect>
                        <![endif]-->
                    </td>
                </tr>
                </table>    
                <!-- Background Image with Text : END --> 
            </center>
        </td>
      </tr>
    </table>
</body>
</html>';
    }
}
?>