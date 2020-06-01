<?php 
//maria fernanda castillo
//se realiza la conexion de web service con el archivo que se va conectar para realizar proceso y se incluye la libreria de nusoap. tambien se verifica que la variable que viene por el metodo post existe y muestra en pantalla el fomulario.
if(isset($_POST["empleado"])){
	date_default_timezone_set("America/El_Salvador");
	require_once("nusoap/lib/nusoap.php");
	$wsdl="http://localhost/laboratorio/ws1.php?wsdl";
	$client=new nusoap_client($wsdl,"wsdl");
	//se crea una variable de error que lo presentara si la conexion al web service presenta algun error
	$err=$client->getError();
	if($err){
		echo "Error de conexion - $err";
		exit(0);
	}
	//se crean un array con todos los parametros que va resivir el programa por el metodo post.
	$parametros=array("empleado"=>$_POST["empleado"],"sueldo"=>$_POST["sueldo"],"anios"=>$_POST["anios"],"cargo"=>$_POST["cargo"],"giro"=>$_POST["giro"]);
	$result=$client->call("datos",$parametros);
	//genera un error si los datos no son correctos o si presenta algun error
	echo $client->getError();
	print_r($result);
}else{
	//a continuacion se creara un formulario con un boton que al presionarlo realice el calculo y se utilizara el metodo post para enviar los datos
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Formulario indemnizacion</title>
	<link rel="stylesheet" href="boton.css">
	<style>
		body{font-family: Arial; background-color: pink; box-sizing: border-box;}

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
	<form method="post">
		<h2>Formulario de Indemnizacion</h2>
		<b>Ingrese su nombre:</b> <input type="text" class="field" name="empleado"><br><br>
		<b>Ingrese su sueldo:</b> <input type="number" class="field" name="sueldo" step="0.01"><br><br>
		<b>Ingrese los años trabajados:</b> <input type="number" class="field" name="anios"><br><br>
		<b>Cargo:</b> <input type="text" class="field" name="cargo"><br><br>
		<b>Giro de la empresa:</b> <input type="text" class="field" name="giro"><br><br>
		<p class="center-content"> 
		<input type="submit" class="btn btn-green"value="Enviar">
		</p>
	</form>

</body>
</html>
<?php 
}
?>