<?php

// API para registrar un usuario
if (isset($_REQUEST['Id_User']) && isset($_REQUEST['NameUser']) && isset($_REQUEST['Contraseña']) && isset($_REQUEST['estado']))
{
	include 'conexionExa.php';
    // Obtiene los datos de la consulta
    
    $Id_User = $_REQUEST['Id_User'];
    $NameUser = $_REQUEST['NameUser'];
    $Contraseña = $_REQUEST['Contraseña'];
	$estado = $_REQUEST['estado'];

    // Inserta el producto en la tabla usuario
    $sql = "INSERT INTO usuarios (Id_User, NameUser, Contraseña, estado) VALUES (?, ?, ?, ?)";
	$stmt = $conn->prepare($sql);
	$stmt->bind_param("ssss", $Id_User, $NameUser, $Contraseña, $estado);
	$stmt->execute();
	$stmt->close();
}

// Cerrar la conexión a la base de datos
$conn->close();

?>