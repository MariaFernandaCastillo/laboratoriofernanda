<?php 
//maria fernanda castillo campos
//realiza la conexion con el otro archivo que es el ws que es necesario para realizar el calculo ademas incluye la libreria.
if(isset($_POST["codigo"])){
	date_default_timezone_set("America/El_Salvador");
	require_once("nusoap/lib/nusoap.php");
	$wsdl="http://localhost/laboratorio/ws.php?wsdl";
	$client=new nusoap_client($wsdl,"wsdl");
	//genera un error si los datos no son correctos o si presenta algun error
	$err=$client->getError();
	if($err){
		echo "Error de conexion - $err";
		exit(0);
	}
	//se establecen los parametros que deben ingresar para realizar el proceso los que obtendra por medio d eun array.
	$parametros=array("codigo"=>$_POST["codigo"],"nombre"=>$_POST["nombre"],"precio"=>$_POST["precio"]);
	//calcula el resultado con la variable result y llamamos la funcion iva, y se le enviaran los datos por medio de post en la variable parametros
	$result=$client->call("iva",$parametros);
	echo $client->getError();
	print_r($result);
}else{ 
	//a continuacion se crea un pequeño formulario para calcular rl iva donde se define el nombre de cada campo a utilizar
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
	<title>Formulario de calculo de iva:</title>
	<link rel="stylesheet" href="boton.css">
	<style type="text/css">
		body{font-family: Arial; background-color: #F6C40A; box-sizing: border-box;}

		form{
			background-color: white;
			border-radius: 3px;
			color: black;
			font-size: 0.9em;
			padding: 20px;
			margin: 0 auto;
			width: 300px;
		}

		input, textarea{
			border: 0;
			outline: none;

			width: 280px;
		}

		.field{
			border: solid 1px #ccc;
			padding: 10px;

			
		}

		.field:focus{
			border-color: #18A383;
		}

		.center-content{
			text-align: center;
		}
	</style>
</head>
<body>
	<form action="" method="post">
		<h2>Formulario de Calculo de IVA</h2>
		<p>Ingrese el codigo del producto:</p> 
		<input type="text" class="field" name="codigo"><br>
		<p>Ingrese el nombre de producto:</p> 
		<input type="text" class="field" name="nombre"><br>
		 <p>Ingrese el precio del proctudo:</p>
		 <input type="number" class="field" name="precio"><br>
		<p class="center-content">
		<input type="submit" class="btn1 btn1-red" value="Enviar"></p>
	</form>

</body>
</html>
<?php 
}
?>