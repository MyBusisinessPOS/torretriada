<?php
include_once('usuario.php');
include_once('correo.php');


class correoRecuperacion extends correo
{
    var $usuario;
    var $datosusuario;
    var $path = 'http://localhost/tamara/';

    function correoRecuperacion($idusuario)
    {
        $this->correo();
        $this->datosusuario= new datosusuario($idusuario,'','','');
    		$this->datosusuario->obtener_datos_usuario();
        $this->usuario = new usuario($idusuario,'','','',0);
        $this->usuario->obten_usuario();
    }

    function genera_asunto()
    {
        $this->correo->Subject='Recuperación de contraseña Panel Tamara';
    }

    function genera_destino()
    {
        $this->correo->AddAddress($this->datosusuario->email);
    }

    function genera_mensaje()
    {
        $usuario= $this->usuario;
        $this->correo->Body = '<h3>Hola, '.$this->datosusuario->nombre.' esta por comenzar el proceso para recuperar su contraseña</h3>
        <br/>
        <h5>SOPORTE TÉCNICO</h5>
    		<p>Entre al siguiente link, y ahi usted podra crear una nueva contraseña... ¡Gracias!</p>
    		<p>Su nombre de usuario es: '.$this->usuario->nomusuario.'</p>
        <a href="'.$this->path.'panel/js/recuperar/recuperar.php?verify='.$this->datosusuario->token.'" target="_blank">Recuperar Contraseña</a>
        <br/>
        <br/>';

    }
}
?>
