<?php 
include "../conexion.php";
$Query="Select*from edificios";
$Consulta=mysqli_query($Conexion,$Query);
$arreglo= array();
while($recibido= mysqli_fetch_assoc($Consulta))
{
array_push($arreglo, $recibido);
}
print json_encode($arreglo,JSON_FORCE_OBJECT);
mysqli_close($Conexion);

?>