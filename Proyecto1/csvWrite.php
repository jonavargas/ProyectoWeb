<?php
if($_POST['formSubmit'] == "Submit")
{
	date_default_timezone_set("America/Costa_Rica");
	$name_csv = date("d").date("m").date("Y");					
	$varName = "";
	$varLastName = "";
	$varEmail = "";
	$varPhone = "";
	$varID = "";

	$varName = $_POST['formName'];
	$varLastName = $_POST['formLastName'];
	$varEmail = $_POST['formEmail'];
	$varPhone = $_POST['formPhone'];
	$varID = $_POST['formID'];

	$file = fopen($name_csv.".csv","a");  
	fwrite($file,$varName . ";" . $varLastName . ";" . $varEmail . ";" . $varPhone . ";" . $varID . "\n");
	fclose($file);		
	header("Location: successful.html");
	exit;
}
?>
