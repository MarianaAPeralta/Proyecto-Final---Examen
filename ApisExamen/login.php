<?php

if(isset($_REQUEST['NameUser']) && isset($_REQUEST['Contraseña'])){
include "conexionExa.php";

$NameUser=$_REQUEST['NameUser'];
$Contraseña=$_REQUEST['Contraseña'];

$Query="Select * from usuarios where NameUser='$NameUser' and Contraseña='$Contraseña'";
$Consulta=mysqli_query($conn,$Query);
$arreglo= array();
while($recibido = mysqli_fetch_assoc($Consulta)){
array_push($arreglo, $recibido);
}
print json_encode($arreglo,JSON_FORCE_OBJECT);
mysqli_close($conn);
}

?>