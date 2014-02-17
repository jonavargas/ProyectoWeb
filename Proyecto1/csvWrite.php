<?php
if($_POST['formSubmit'] == "Submit")
{
	date_default_timezone_set("America/Costa_Rica");
	$name_csv = date("d").date("m").date("Y");					
	$varName = "";
	$varLastName1 = "";
	$varLastName2 = "";
	$varEmail = "";
	$varPhone = "";
	$varID = "";

	$varName = $_POST['formName'];
	$varLastName1 = $_POST['formLastName1'];
	$varLastName2 = $_POST['formLastName2'];
	$varEmail = $_POST['formEmail'];
	$varPhone = $_POST['formPhone'];
	$varID = $_POST['formID'];

	$file = fopen($name_csv.".csv","a");  
	fwrite($file,$varName . ";" . $varLastName1 . ";" . $varLastName2 . ";" . $varEmail . ";" . $varPhone . ";" . $varID . "\n");
	fclose($file);		
	header("Location: successful.html");
	exit;
}
?>
