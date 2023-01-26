<?php
include_once('include/path.php');

//conexión crm
$sTokenKey = '13e48f8d19a87eb04c6c0d7bbb6f33d42e8ba06f031769c00c927e28a1';
$pathConnect = "https://sale-u.com/APIS/v1/ConexionTerceros/GenerarLeadAPIPost.php";
$headers = array(
'Authorization:key=' . $sTokenKey
);

$nombre=$_REQUEST['nombre'];
$telefono=$_REQUEST['telefono'];
$correo=$_REQUEST['correo'];
$mensaje=$_REQUEST['mensaje'];
$lote=$_REQUEST['lote'];
$asunto=$lote;
$plazo=$_REQUEST['plazo'];
$descuento=$_REQUEST['descuento'];
$enganche=$_REQUEST['enganche'];
$mensualidad=$_REQUEST['mensualidad'];
$precioTotal=$_REQUEST['precioPost'];
$response = $_REQUEST["g-recaptcha-response"];

//conexión crm II
$sCamposEnviar = array();
$rrinfoAuthApp = array();
$rrinfoAuthApp['sSecretTokenApp'] = "d23a3f8a0e656ed69f08cf26094cd064576604b851a3d1aac0f5afa14a";
$rrinfoAuthApp['tmTimeStampSol'] = date('Y/m/d H:i:s');
$rrinfoAuthUsu = array();
$rrinfoJSON = array();
$rrinfoJSON['sTituloLead'] = "Lead Formulario Torre Triada - Cotizador";
$rrinfoJSON['sEmail'] = $correo;
$rrinfoJSON['sNombre'] = utf8_encode($nombre);
$rrinfoJSON['sNumTelefono'] = $telefono;
$rrinfoJSON['sMensaje'] = utf8_encode($mensaje);
$rrinfoJSON['sProducto'] = utf8_encode($lote);
$rrinfoJSON['AgAgencia'] = UrbaSure3264;
$sCamposEnviar['infoAuthApp'] = $rrinfoAuthApp;
$sCamposEnviar['infoAuthUsu'] = $rrinfoAuthUsu;
$sCamposEnviar['infoJSON'] = $rrinfoJSON;

if(!empty($response))
{
    $secret = "6Lebh_kaAAAAAOlidzlhrH-ArghFgOmA0nSPR6Gc";
    $ip = $_SERVER['REMOTE_ADDR'];
    $respuestaValidacion = file_get_contents("https://www.google.com/recaptcha/api/siteverify?secret=$secret&response=$response&remoteip=$ip");

    //Si queremos visualizar la información obtenida de la petición a la api de validación de Google para comprobar el estado de esta lo haremos con la función de PHP var_dump
    //var_dump($respuestaValidación);

    $jsonResponde = json_decode($respuestaValidacion);
    if($jsonResponde->success)
    {

			//Correo de información
			$mensajedelsitio='Mensaje del Sitio Web - Torre Triada';
			$mensajedesde='Mensaje desde Torre Triada';
			$logo='logo.png';
			$logoAlt='Torre Triada';

			$owner_email = "info@yucatanpremier.com,eleazar@yucatanpremier.com,socialmedia.urbaz@gmail.com,pablo@awagencia.com,socialmedia_urbaz@outlook.com,ventas@urbaz.mx";
			//$owner_email = "cdbs_3@hotmail.com";
			//$owner_email = "carlos@locker.com.mx";
			$froms = "noreply@torretriada.com"; // noreply de la página web
			//$froms = "noreply@locker.com.mx"; // noreply de la página web
			$EMAILheaders = "From: " .strip_tags ($froms). "\r\n";
			$EMAILheaders .= "MIME-Version: 1.0\r\n";
			$EMAILheaders .= "Content-Type: text/html; charset=UTF-8\r\n";
			$subject = $mensajedelsitio;
			$messageBody = '
			<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/1999/REC-html401-19991224/strict.dtd">
			<html>
			<head>
				<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
				<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0" />
				<title>'.$mensajedesde.'</title> <!-- Nombre del sitio web -->


				<style>
					@media only screen and (max-width: 300px){
						body {
							width:218px !important;
							margin:auto !important;
						}
						.table {width:195px !important;margin:auto !important;}
						.logo, .titleblock, .linkbelow, .box, .footer, .space_footer{width:auto !important;display: block !important;}
						span.title{font-size:20px !important;line-height: 23px !important}
						span.subtitle{font-size: 14px !important;line-height: 18px !important;padding-top:10px !important;display:block !important;}
						td.box p{font-size: 12px !important;font-weight: bold !important;}
						.table-recap table, .table-recap thead, .table-recap tbody, .table-recap th, .table-recap td, .table-recap tr {
							display: block !important;
						}
						.table-recap{width: 200px!important;}
						.table-recap tr td, .conf_body td{text-align:center !important;}
						.address{display: block !important;margin-bottom: 10px !important;}
						.space_address{display: none !important;}
					}
					@media only screen and (min-width: 301px) and (max-width: 500px) {
						body {width:308px!important;margin:auto!important;}
						.table {width:285px!important;margin:auto!important;}
						.logo, .titleblock, .linkbelow, .box, .footer, .space_footer{width:auto!important;display: block!important;}
						.table-recap table, .table-recap thead, .table-recap tbody, .table-recap th, .table-recap td, .table-recap tr {
							display: block !important;
						}
						.table-recap{width: 293px !important;}
						.table-recap tr td, .conf_body td{text-align:center !important;}

					}
					@media only screen and (min-width: 501px) and (max-width: 768px) {
						body {width:478px!important;margin:auto!important;}
						.table {width:450px!important;margin:auto!important;}
						.logo, .titleblock, .linkbelow, .box, .footer, .space_footer{width:auto!important;display: block!important;}
					}
					@media only screen and (max-device-width: 480px) {
						body {width:308px!important;margin:auto!important;}
						.table {width:285px;margin:auto!important;}
						.logo, .titleblock, .linkbelow, .box, .footer, .space_footer{width:auto!important;display: block!important;}

						.table-recap{width: 285px!important;}
						.table-recap tr td, .conf_body td{text-align:center!important;}
						.address{display: block !important;margin-bottom: 10px !important;}
						.space_address{display: none !important;}
					}
				</style>
			</head>
			<body style="-webkit-text-size-adjust:none;background-color:#fff;width:650px;font-family:Open-sans, sans-serif;color:#555454;font-size:13px;line-height:18px;margin:auto">
				<table class="table table-mail" style="width:100%;margin-top:10px;">
					<tr>
						<td class="space" style="width:20px;padding:7px 0">&nbsp;</td>
						<td align="center" style="padding:7px 0">
							<table class="table" bgcolor="#ffffff" style="width:100%">
								<tr>
									<td align="center" class="logo" style="border-bottom:4px solid #333333;padding:7px 0">
										<!-- Nombre del sitio web, url de la página, ruta del logo de la página y otra ves el nombre.-->
										<a title="'.$logoAlt.'" href="'.PATH.'" style="color:#337ff1">
											TORRE TRIADA
										</a>
									</td>
								</tr>
								<tr>
									<td align="center" class="titleblock" style="padding:7px 0">
										<font size="2" face="Open-sans, sans-serif" color="#555454">
											<span class="subtitle" style="font-weight:500;font-size:16px;text-transform:uppercase;line-height:25px">Nuevo mensaje de contacto</span>
										</font>
									</td>
								</tr>
								<tr>
									<td class="space_footer" style="padding:0!important">&nbsp;</td>
								</tr>
								<tr>
									<td class="box" style="border:1px solid #D6D4D4;background-color:#f8f8f8;padding:7px 0">
										<table class="table" style="width:100%">
											<tr>
												<td width="10" style="padding:7px 0">&nbsp;</td>
												<td style="padding:7px 0">
													<font size="2" face="Open-sans, sans-serif" color="#555454">
														<p data-html-only="1" style="border-bottom:1px solid #D6D4D4;margin:3px 0 7px;text-transform:uppercase;font-weight:500;font-size:18px;padding-bottom:10px">
															Detalles del interesado</p>
														<span style="color:#777">
															Estos son los datos del mensaje:<br />
															<span style="color:#333"><strong>Nombre:</strong></span> '.$nombre.' <br />
															<span style="color:#333"><strong>Teléfono:</strong></span> '.$telefono.' <br />
															<span style="color:#333"><strong>Correo electrónico: <a href="mailto:'.$correo.'" style="color:#337ff1">'.$correo.'</a></strong></span><br />
															<span style="color:#333"><strong>Mensaje:</strong></span> '.$mensaje.' <br />
															<span style="color:#333"><strong>Lote/Departamento/Oficina:</strong></span> '.$lote.' <br />
														</span>
													</font>
												</td>
												<td width="10" style="padding:7px 0">&nbsp;</td>
											</tr>
										</table>
									</td>
								</tr>
								<tr>
									<td class="space_footer" style="padding:0!important">&nbsp;</td>
								</tr>
								<tr>
									<td class="space_footer" style="padding:0!important">&nbsp;</td>
								</tr>
								<tr>
									<td class="footer" style="border-top:4px solid #333333;padding:7px 0">
												<!-- url y nombre de la página web -->
										<span><a href="'.PATH.'" style="color:#337ff1">'.$logoAlt.'</a></span>
									</td>
								</tr>
							</table>
						</td>
						<td class="space" style="width:20px;padding:7px 0">&nbsp;</td>
					</tr>
				</table>
			</body>
			</html>';

      $envio_valores = http_build_query(array(
      'jsnInfo' => json_encode($sCamposEnviar)
      ));

      $curl_session = curl_init();
      // Definir la URL a la que se le hará el post
      curl_setopt($curl_session, CURLOPT_URL, $pathConnect);
      // Indicar el tipo de petición: POST
      curl_setopt($curl_session, CURLOPT_POST, TRUE);
      curl_setopt($curl_session, CURLOPT_HTTPHEADER, $headers);
      // Recibimos una respuesta y la guardamos en una variable
      curl_setopt($curl_session, CURLOPT_RETURNTRANSFER, true);
      curl_setopt($curl_session, CURLOPT_SSL_VERIFYPEER, false);
      curl_setopt($curl_session, CURLOPT_IPRESOLVE, CURL_IPRESOLVE_V4);
      // Definir cada uno de los parámetros
      // curl_setopt($curl_session, CURLOPT_CUSTOMREQUEST, 'POST');
      curl_setopt($curl_session, CURLOPT_POSTFIELDS, $envio_valores);
      $remote_server_output = curl_exec($curl_session);
      // $result = curl_exeec($curl_session);
      // Cerrar la sesion
      curl_close($curl_session);
      $JSNdcRemoOutput = json_decode($remote_server_output);

      $respuestaConexionCRM=$JSNdcRemoOutput->success;

      echo 'Success:'.$JSNdcRemoOutput->success;
      echo 'Mensaje:'.$JSNdcRemoOutput->message;

      if($respuestaConexionCRM==1 || $respuestaConexionCRM==0){

			try{
					if(!mail($owner_email, $subject, $messageBody, $EMAILheaders)){
							throw new Exception('mail failed');
							echo "false";
					}else{
							//echo("ZS1aFTKNN7zh");
							header("location:agradecimiento");
					}
			}catch(Exception $e){
					echo $e->getMessage()."\n";
			}

      }

		}
		else
		{
		    //Google ha detectado que se trata de un proceso no humano
		    echo "Ha ocurrido un error, intente más tarde";
		}
	}
	else
	{
			//si entra aquí significa que no se ha pulsado el Captcha
			echo "Ha ocurrido un error, intente más tarde";
	}

?>
