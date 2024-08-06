<?php

//VARIABLE DEL LINK PARA LAS REDIRECCIONES
$links = "https://".$_SERVER['HTTP_HOST']."/";

//ACTIVAR O INACTIVAR LA VISUALIZACIÓN DE ERRORES EN PHP
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1) ;
error_reporting(E_ALL); 

/* Incluye el archivo de la conexion */
//$action = false;
require_once($_SERVER['DOCUMENT_ROOT'] . "/prueba_tecnica/lib/conex.php");
$db = new MySQL();


$NumeroVariables = count($_POST);
$NombreVariables = array_keys($_POST); // obtiene los nombres de las varibles
$ValoresVariables = array_values($_POST); // obtiene los valores de las varibles
for ($i = 0; $i < $NumeroVariables; $i++) { // crea las variables y les asigna el valor
  ${$NombreVariables[$i]} = $ValoresVariables[$i];
}

/* Ingluye los archivos de utilidades necesarias como el Enc, el buscar texto*/
require_once($_SERVER['DOCUMENT_ROOT'] . "/prueba_tecnica/controllers/controlador_empleado.php");
$empleados = new empleados();