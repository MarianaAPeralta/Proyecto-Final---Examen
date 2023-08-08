<?php
if(isset($_REQUEST['Id_User'])){
	include "conexionExa.php";
	
	$Id_User=$_REQUEST['Id_User'];
	
	
	$Query = "select NameUser, estado from usuarios where Id_User = '$Id_User'";
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