<?php 
// maria fernanda castillo
// establece una conexion con un server  el cual realiza el proceso de indemnizacion y llema la libreria.
date_default_timezone_set("America/El_Salvador");
require_once("nusoap/lib/nusoap.php");
$server=new nusoap_server;
$server->configureWSDL('server','urn:server');
$server->wsdl->schemaTargetNamespace='urn:server';
// se definen el tipo de variable que se usara y el nombre con el que sera reconocida.
$server->register('datos',
		 array('empleado'=>'xsd:string','sueldo'=>'xsd:float','anios'=>'xsd:float','cargo'=>'xsd:string','giro'
		 	=>'xsd:string'),
		 array('return'=>'xsd:string'),
		 'urn:server',
		 'urn:server#datosServer',
		 'rpc',
		 'encoded',
		 'Funcion Indemnizacion por renuncia involuntaria');
//se crea una funcion con los parametros siguientes, define que es el proceso que la funcion realizara en este caso calculara la indemnizacion dependiendo de la cantidad de años y la quicena el resultado se almacenara en la variable total.

function datos($empleado,$sueldo,$anios,$cargo,$giro){
	$quincena=$sueldo/2;
	if ($quincena>600) {
		$quincena=600;
		$total=$anios*$quincena;
	}else{
		$total=$anios*$quincena;

	}
	//lo que mostrara de resultado de lo que el usuario digito previamiento y que fue enviado mediante el metodo post :
	
	return "<b>Nombre del Empleado:</b>$empleado<br> <b>El Sueldo es:</b> $sueldo<br> <b>La Indemnizacion es de:</b> $total<br> <b>El Cargo Dentro la Empresa es:</b> $cargo<br> <b>El Giro es:</b> $giro" ;

}
$HTTP_RAW_POST_DATA=isset($HTTP_RAW_POST_DATA) ? $HTTP_RAW_POST_DATA:"";
$server->service($HTTP_RAW_POST_DATA);
?>