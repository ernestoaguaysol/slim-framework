<?php
    class Db {
        private $host = 'localhost';
        private $usuario = 'root';
        private $password = '';
        private $base = 'misclientes';

        public function conectar()
        {
            $conexion_mysql = "mysql:host=$this->host;dbname=$this->base";
            $conexionDB = new PDO($conexion_mysql, $this->usuario, $this->password);
            $conexionDB->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            // esta linea arregla la codificacion de caracteres UTF-8 
            $conexionDB -> exec("set names utf8");

            return $conexionDB;
        }
    }
    