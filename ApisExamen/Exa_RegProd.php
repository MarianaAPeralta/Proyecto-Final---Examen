<?php

// API para registrar un producto y actualizar el inventario
if (isset($_REQUEST['Id_Prod']) && isset($_REQUEST['Nombre']) && isset($_REQUEST['Marca']) && isset($_REQUEST['Presentacion']) && isset($_REQUEST['Precio']))
{
	include'conexionExa.php';
    // Obtiene los datos del requisito en la URL
    $Id_Prod = $_REQUEST['Id_Prod'];
	$Nombre = $_REQUEST['Nombre'];
    $Marca = $_REQUEST['Marca'];
    $Presentacion = $_REQUEST['Presentacion'];
    $Precio = $_REQUEST['Precio'];

    // Inserta el producto en la tabla Registro_productos
    $sql = "INSERT INTO registro_productos (Id_Prod, Nombre, Marca, Presentacion, Precio)
            VALUES ($Id_Prod, '$Nombre', '$Marca', '$Presentacion', $Precio)";
    if ($conn->query($sql) === TRUE) {
        //$Id_Prod = $conn->insert_id;

        // Inserta el producto en la tabla Productos_inventario con cantidad 0
        $sql = "INSERT INTO productos_inventario (Id_Prod, Cantidad)
                VALUES ($Id_Prod, 0)";
        if ($conn->query($sql) === TRUE) {
            // Si la conn y el query se ejecuta con exito se registra el producto y actualizar el inventario
            echo "Producto registrado y inventario actualizado.";
        } else {
            // Error si no pasa el query y no actualizar el inventario
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    } else {
        // Error al registrar el producto
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

?>