<?php 


if(isset($_REQUEST['usuario']) && isset($_REQUEST['clave']))
{
include "conexion.php";

$Usuario=$_REQUEST['usuario'];
$Clave=$_REQUEST['clave'];

$Query="Select*from usuarios where Usuario='$Usuario'	and Clave='$Clave'";
$Consulta=mysqli_query($Conexion,$Query);
$arreglo= array();
while($recibido= mysqli_fetch_assoc($Consulta))
{
array_push($arreglo, $recibido);
}
print json_encode($arreglo,JSON_FORCE_OBJECT);
mysqli_close($Conexion);
}
?>