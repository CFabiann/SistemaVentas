<?php
class Conexion{
    static public function conectar(){

       
        $link = new PDO("mysql:host=localhost;port=3307;dbname=sistemaventas", "root", "");

        $link->exec("set names utf8");

        return $link;

    }
}
?>