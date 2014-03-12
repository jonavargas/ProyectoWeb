<!DOCTYPE HTML>
<html>

<head>
	<meta name="viewport" content="width=width-device, initial-scale=1.0">
	<link rel="stylesheet" type="text/css" href="css/bootstrap.css">
	<link rel="stylesheet" type="text/css" href="css/style.css">
	<script type="text/javascript" src="js/lib/jquery-1.11.0.js"></script>
</head>

<body class="body2">
    <h1></h>
    <div class="Container">
		<header>
			<div class="divTitle">
				<h2>Registered Successfully!!!</h2>	
			</div>
	 	</header>
	</div>
</body>

</html>

<?php
if($_POST['submit'] == "Submit")					//Código que empieza a funcionar después de que el botón "Submit" es presionado.
{
	date_default_timezone_set("America/Costa_Rica");	//Especifica la zona horaria de "América Central/Costa Rica".
	$name_csv = date("d").date("m").date("Y");			//Asigna la fecha actual a la variable "$name_csv".		
	$name = "";											//Declaración de variables.
	$lastName = "";
	$email = "";
	$phone = "";
    $id = "";

	$name = $_POST['name'];								//A cada variable se le asigna un valor del formulario mediante el método POST.
	$lastName = $_POST['lastName'];
	$email = $_POST['email'];
	$phone = $_POST['phone'];
	$id = $_POST['id'];

	$file = fopen($name_csv.".csv","a");  				//Se asigna la función de abrir un archivo csv a la variable "$file".
	fwrite($file,$name . ";" . $lastName . ";" . $email . ";" . $phone . ";" . $id . "\n");		//Función encargada de crear un archivo csv con las variables que contienen la información ingresada por el usuario.
	fclose($file);										//Función que se encarga de cerrar el archivo csv.
	header("refresh:2; url=index.php");					//Se encarga de mantener esta página 2 segundos, y luego vuelve a cargar la página del formulario.
	exit;
}
?>