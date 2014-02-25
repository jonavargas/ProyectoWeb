<?php
include('phpmailer/class.phpmailer.php');   //Se hacen los includes de las clases "class.phpMailer.php" y "class.smtp.php" respectivamente.
include('phpmailer/class.smtp.php');

function getXML(){
    global $argv;                           //Declaración de variables.
    $_SERVER['argv'];
    $xml = $argv[1];

    $ext = split("[/\\.]", $xml);           //Extrae la extensión del archivo ingresado por parámetro.
    $val = count($ext)-1;                   //Obtiene la extensión del archivo pero sin el punto.
    $ext = $ext[$val];
    if($ext != "xml"){                      //Validación que se encarga de verificar como fue ingresado el nombre de archivo.
        $xml .= '.xml';                     //y de ser necesario le concatena la extensión completa ".xml".
    }
    $xml = strtolower($xml);                //Convierte a minúscula el archivo XML que se ingresa por parámetro.
    
    if(!file_exists($xml)){                 //Valida que el archivo xml exista.
        echo " Did not find any file XML!!!";
        die;
    }
    return $xml;
}

function connectDB(){                       //Función encargada de conectarse a la Base de Datos.       
    $Server = "";                           //Declaración de variables.
    $User = "";
    $Password = "";
    $DB = "";
    $return = "";

    $fileXML = getXML();                    //Se crea una instancia de la función "getXML()".

    $file = simplexml_load_file($fileXML);  //Se encarga de leer el archivo "xml" y esté es asignado a una variable.
    foreach($file->Connect as $item){       //Recorre el "xml" y extrae los datos necesarios para la conexión
        $Server = $item->Server;            //con la base de datos y los asigna a sus respectivas variables.
        $User = $item->User;
        $Password = $item->Password;
        $DB = $item->DB;
    }
    if (!($cnx = mysqli_connect($Server, $User, $Password, $DB))) {  //Valida si los valores son correctos y 
        echo "Error connecting to database.";                        //realiza la conexión a la base de datos. 
        exit();
    }
    return $cnx;
}

date_default_timezone_set("America/Costa_Rica");        //Especifica la zona horaria de "América Central/Costa Rica".
$name_csv = date("d").date("m").date("Y");              //Asigna la fecha actual a una variable.

if(!file_exists($name_csv . ".csv")){                   //Valida que el archivo csv exista para continuar con el insert en la base de datos.
    echo " Did not find any file to insert into database!!!";
    die;
}

$registersMade = 0;                                       //Contador de registros ingresados por día.
$csv = fopen($name_csv . ".csv", "r");                  //Abre el archivo "csv" y lo asigna a la variable "$csv".
while (($data = fgetcsv($csv, 1000, ";")) !== FALSE) {  //Almacena los datos de una línea completa del "csv" en el array "data".
    $num = count($data);                                //Contador de campos del array "data".
    $registersMade++;                                     //Aumento del contador.
    $insert = "INSERT INTO students (Name,LastName,Email,Phone,ID) VALUES ("; //Se almacena en la variable "$insert" los nombres de los campos de la tabla de la base de datos.
    
    for ($i = 0; $i < $num; $i++) {                     //Se colocan los campos de la cadena, si aún no es el último campo, le agrega la coma (,) para separar los datos.
        if ($i == ($num - 1))
            $insert = $insert . "'" . $data[$i] . "'";
        else
            $insert = $insert . "'" . $data[$i] . "',";
    }
    
    $insert = $insert . ");\n";                         //Se termina de crear el insert, el cual esta almacenado en la variable "$insert".        
    $link = connectDB();                                //Se almacena en la variable "$link" la función de conexión a la base de datos.
    $result = mysqli_query($link, $insert);             //Se ejecuta la cadena del insert formada.
    echo $insert;                                       //Muestra los datos que se insertaran en la base de datos.
    mysqli_close($link);                                //Finaliza la conexión con la base de datos.    
}
echo "\n Was successfully inserted the " . $registersMade ." registers in the database!!! \n";
fclose($csv);

$From = "";                                             //Declaración de variables.
$Password = "";
$Server = "";
$To = "";
$return = "";

$mail = new PHPMailer();                                //Se crea una instancia de la clase “PHPMailer()”.
$fileXML = getXML();                                    //Se crea una instancia de la función "getXML()".
$mail->IsSMTP();                                        //Instancia de la función "IsSMTP()".

$file = simplexml_load_file($fileXML);                  //Se encarga de leer el archivo "xml" y esté es asignado a una variable.
foreach($file->Email as $item){                         //Recorre el "xml" y extrae los datos necesarios para el envió del email, y se almacena en sus respectivas variables.
    $From = $item->From;                
    $Password = $item->Password;
    $Server = $item->Server;
    $To = $item->To;
}

$mail->SMTPAuth = true;                                 //Se hace la autenticación del SMTP.
$mail->SMTPSecure = "ssl"; 

$mail->Host = $Server;                                  //Asignación de la variable "$Server" que contiene el servidor de SMTP para Gmail.
$mail->Port = 465;                                      //Se indica el número de puerto que utilizara.
$mail->Username = $From;                                //Asignación de la variable "$From" que contiene la dirección de Gmail que enviara el mensaje.
$mail->Password = $Password;                            //Asignación de la variable "$Password" que contiene el Password de la cuenta de Gmail que enviara el correo.
$mail->From = $From;                                    
$mail->FromName = "Jonathan Vargas Alvarado";           //Nombre de la persona que envia el correo.
$mail->Subject = "New Registers!!!";                    //Se especifica el "asunto" del correo.
$mail->MsgHTML("The number of registers entered today was: " . $registersMade); //Esté es el cuerpo del mensaje.
$mail->AddAddress($To, "Jonathan Vargas Alvarado");     //Asignación de la variable "$To" que contiene la dirección de destino del mensaje.
//$mail->IsHTML(true); 

if(!$mail->Send()) {                                    //Validación que se encarga de verificar si el email se entregó correctamente o no.
echo "Error: " . $mail->ErrorInfo; 
} else { 
echo "\n The message was successfully sent to the email: " . $To; 
}

?>