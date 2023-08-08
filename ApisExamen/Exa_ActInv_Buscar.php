<?php
if(isset($_REQUEST['Id_Prod'])){
	include "conexionExa.php";
	
	$Id_Prod=$_REQUEST['Id_Prod'];
	
	
	$Query = "select R.Nombre, P.Cantidad from registro_productos R, productos_inventario P where R.Id_Prod = '$Id_Prod'";
	$Consulta = mysqli_query($conn,$Query);
	$arreglo= array();
	while($recibido=mysqli_fetch_assoc($Consulta))
	{
		array_push($arreglo,$recibido);
	}
	print json_encode($arreglo, JSON_FORCE_OBJECT);
	mysqli_close($conn);
}
?>