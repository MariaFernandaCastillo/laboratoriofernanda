<?php 
// maria fernanda castillo
// establece una conexion con un server  el cual realiza el proceso de indemnizacion y llema la libreria.
date_default_timezone_set("America/El_Salvador");
require_once("nusoap/lib/nusoap.php");
$server=new nusoap_server;
$server->configureWSDL('server','urn:server');
$server->wsdl->schemaTargetNamespace='urn:server';
// se definen el tipo de variable que se usara y el nombre con el que sera reconocida.
$server->register('iva',
		 array('codigo'=>'xsd:string','nombre'=>'xsd:string','precio'=>'xsd:float'),
		 array('return'=>'xsd:string'),
		 'urn:server',
		 'urn:server#datoServer',
		 'rpc',
		 'encoded',
		 'Funcion de IVA');

//crea la funcion con sus respectivas variables la cual realizara el calculo del precio del producto que se obtendra de la variable que viene por el metodo post y se multiplicara por el 1.13
function iva($codigo,$nombre,$precio){
	$iva = $precio*0.13;
	$total= $precio+$iva;
	//lo que dara como resultado final de los calculos que se realizaran y la informacon que se envio por el metodo post.
	return "<b>Codigo:</b> $codigo<br> <b>Nombre producto:</b> $nombre <br><b>Precio:</b> $precio <br> <b>Cantidad Iva:</b> $iva <br> <b>Total a pagar es:</b> $total <br>";
}

$HTTP_RAW_POST_DATA=isset($HTTP_RAW_POST_DATA) ? $HTTP_RAW_POST_DATA:"";
$server->service($HTTP_RAW_POST_DATA);
?>
