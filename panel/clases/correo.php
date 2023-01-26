<?php
include_once('class.phpmailer.php');
include_once('settingsEmail.php');

class correo{

	/**
	 * Variable que contiene la instancia de PHPMailer.
	 * @var Object
	 */
	var $correo;

	/**
	 * Variable que contiene la instancia de settingsEmail.
	 * @var Object
	 */
	var $settingsEmail;

	var $emailPrueba;
	/**
	 * Metodo constructor de correo.
	 */
	function correo(){
		$this -> settingsEmail = new settingsEmail(1);
		$this -> settingsEmail -> obtener_settingsEmail();

		$this -> correo = new PHPMailer();
		//$this -> correo -> IsSMTP();
		$this -> SMTPSecure = "ssl";
		$this -> Mailer = "smtp";
		$this -> correo -> Host = $this -> settingsEmail -> host;
		$this -> correo -> SMTPDebug = 1;
		$this -> correo -> SMTPAuth = true;
		$this -> correo -> Port = $this -> settingsEmail -> port;
		$this -> correo -> Username = $this -> settingsEmail -> username;
		$this -> correo -> Password = $this -> settingsEmail -> password;

		$this -> correo -> From = $this -> settingsEmail -> username;
		$this -> correo -> FromName = $this -> settingsEmail -> fromname;

		$this -> correo -> AddReplyTo($this -> settingsEmail -> noReply);
		//$this -> correo -> AddCC($this -> settingsEmail -> addCC);
		$this -> correo -> IsHTML(true);
		$this -> correo -> CharSet = 'UTF-8';
	}


	function genera_mensaje(){
		$this -> correo -> Body = '<h1> Prueba correo SMTP</h1>';
	}

	function genera_asunto(){
		$this -> correo -> Subject= 'Locker Agencia';
	}

	function genera_destino(){
		$this -> correo -> AddAddress($this -> emailPrueba);
	}

	function enviarCopias(){
		if($this -> settingsEmail -> addCC != ''){
			$emails = explode(",", $this -> settingsEmail -> addCC);
			foreach ($emails as $email) {
				$this -> correo -> AddCC($email);
			}
		}
	}

	function enviar(){
		$this->genera_asunto();
		$this->genera_destino();
		$this->genera_mensaje();
		$this->enviarCopias();

		if($this->correo->Send()){
			return true;
		}
		else{
			echo 'Error'.$this->correo->ErrorInfo;
			return false;
		}
	}
}
?>
