<?php
function connectDB() //Función encargada de conectarse a la Base de Datos.
{   
    global $argv;    //Declaración de la variables.
    $_SERVER['argv'];
    $xml = $argv[1];
    $Server = "";
    $User = "";
    $Password = "";
    $DB = "";
    $return ="";
    
    $xml = strtolower($xml);             //Convierte a minúscula el archivo XML que se ingresa por parámetro.
    if($xml === strtolower("config.")){  //Validación de un posible ingreso de nombre de variable.
    $xml .= "xml";                       //Concatena la extensión "xml".
    }

    $ext = split("[/\\.]", $xml); //Extrae la extensión del archivo ingresado por parámetro.
    $val = count($ext)-1;         //Obtiene la extensión del archivo pero sin el punto.
    $ext = $ext[$val];
    if($ext != "xml"){            //Validación que se encarga de verificar como fue ingresado el nombre de archivo.
    $xml .= '.xml';               //y de ser necesario le concatena la extensión completa ".xml".
    }

    $file = simplexml_load_file($xml);  //Se carga de leer el archivo "xml" y esté es asignado a una variable.
    foreach($file->Connect as $item){   //Recorre el "xml" y extrae los datos necesarios para la conexión.
        $Server = $item->Server;        //con la base de datos y los asigna a sus respectivas variables.
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
$recordsMade = 0;                                       //Contador de registros ingresados por día.
$csv = fopen($name_csv . ".csv", "r");                  //Abre el archivo "csv" y lo asigna a la variable "$csv".
while (($data = fgetcsv($csv, 1000, ";")) !== FALSE) {  //Almacena los datos de una línea completa del "csv" en el array "data".
    $num = count($data);                                //Contador de campos del array "data".
    $recordsMade++;                                     //Aumento del contador.
    $insert = "INSERT INTO students (Name,LastName,Email,Phone,ID) VALUES ("; //Se almacena en la variable "$insert" los nombres de los campos de la tabla de la base de datos.
    
    for ($i = 0; $i < $num; $i++) { //Se colocan los campos de la cadena, si aún no es el último campo, le agrega la coma (,) para separar los datos.
        if ($i == ($num - 1))
            $insert = $insert . "'" . $data[$i] . "'";
        else
            $insert = $insert . "'" . $data[$i] . "',";
    }
    
    $insert = $insert . ");";       //Se termina de crear el insert, el cual esta almacenado en la variable "$insert".
    echo $insert;                   //Muestra los datos que se insertaran en la base de datos.
    
    $link = connectDB();            //Se almacena en la variable "$link" la función de conexión a la base de datos.
    $result = mysqli_query($link, $insert); //Se ejecuta la cadena del insert formada.
    mysqli_close($link);            //Finaliza la conexión con la base de datos.
}
fclose($csv);
?>