<?php
require_once 'conexion.php';

class datos_galeria
{
    var $_id_galeria;
    var $_titulo;
    var $_frase;
    var $_link;
    var $_lang;
    var $_obj_datos_galeria;

    function __construct($_id_galeria = 0, $_titulo = '', $_frase = '', $_link = '', $_lang = ''){
        $this -> _id_galeria = $_id_galeria;
        $this -> _titulo = htmlentities($_titulo, ENT_QUOTES);
        $this -> _frase = htmlentities($_frase, ENT_QUOTES);
        $this -> _link  = $_link;
        $this -> _lang = $_lang;
    }

    function insert_datos_galeria(){
        $_MYSQL = new conexion();
        $_SQL = "INSERT INTO datos_galeria (id_galeria, titulo, frase, link, lang) VALUES ({$this -> _id_galeria}, '{$this -> _titulo}', '{$this -> _frase}', '{$this -> _link}', '{$this -> _lang}')";
        $_MYSQL -> ejecutar_sentencia($_SQL);
    }

    function update_datos_galeria(){
        $_MYSQL = new conexion();
        $_SQL = "UPDATE datos_galeria SET titulo = '{$this -> _titulo}', frase = '{$this -> _frase}', link = '{$this -> _link}' WHERE id_galeria = {$this -> _id_galeria} AND lang = '{$this -> _lang}'";
        $_MYSQL -> ejecutar_sentencia($_SQL);
    }

    function delete_datos_galeria(){
        $_MYSQL = new conexion();
        $_SQL = "DELETE FROM datos_galeria WHERE id_galeria = {$this -> _id_galeria}";
        $_MYSQL -> ejecutar_sentencia($_SQL);
    }

    function get_datos_galeria(){
        $_MYSQL = new conexion();
        $_SQL = "SELECT * FROM datos_galeria WHERE id_galeria = {$this -> _id_galeria} AND lang = '{$this -> _lang}'";
        $_MYSQL -> ejecutar_sentencia($_SQL);
        $this -> _obj_datos_galeria = $_MYSQL -> fetchObject();
    }
}
