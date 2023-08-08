<?php

// API para registrar un producto y actualizar el inventario
if (isset($_REQUEST['Id_Prod']) && isset($_REQUEST['Nombre']) && isset($_REQUEST['Marca']) && isset($_REQUEST['Presentacion']) && isset($_REQUEST['Precio'])) {
    // Obtener los datos del formulario
	include'conexionExa.php';
    $Id_Prod = $_POST['Id_Prod'];
	$Nombre = $_POST['Nombre'];
    $Marca = $_POST['Marca'];
    $Presentacion = $_POST['Presentacion'];
    $Precio = $_POST['Precio'];
	

    // Insertar el producto en la tabla Registro_productos
    $sql = "INSERT INTO registro_productos (Id_Prod, Nombre, Marca, Presentacion, Precio)
            VALUES ($Id_Prod, '$Nombre', '$Marca', '$Presentacion', $Precio)";
    if ($conn->query($sql) === TRUE) {
        //$Id_Prod = $conn->insert_id;

        // Insertar el producto en la tabla Productos_inventario con cantidad 0
        $sql = "INSERT INTO productos_inventario (Id_Prod, Cantidad)
                VALUES ($Id_Prod, 0)";
        if ($conn->query($sql) === TRUE) {
            // Éxito al registrar el producto y actualizar el inventario
            echo "Producto registrado y inventario actualizado.";
        } else {
            // Error al actualizar el inventario
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    } else {
        // Error al registrar el producto
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

// API para actualizar el inventario
if ($_SERVER['REQUEST_METHOD'] === 'PUT') {
    // Obtener los datos del formulario
    $Id_Prod = $_GET['Id_Prod'];
    $Cantidad = $_GET['Cantidad'];
	$Id_Fact = $_GET['Id_Fact'];

    // Verificar si el producto existe en la tabla Productos_inventario
    $sql = "SELECT * FROM Productos_inventario WHERE Id_Prod = $Id_Prod";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        // El producto existe, actualizar el inventario
        $sql = "UPDATE productos_inventario SET Cantidad = Cantidad + $Cantidad WHERE Id_Prod = $Id_Prod";
        if ($conn->query($sql) === TRUE) {
            // Éxito al actualizar el inventario
			///$Id_Fact = $conn->insert_id;
				$sql = "INSERT INTO actualizacion_inventario (Id_Fact, Id_Prod, FechaCompra, Cantidad)
				VALUES ($Id_Fact, '$Id_Prod', CURDATE(), '$Cantidad')";
                if($conn->query($sql) === TRUE){
					echo "Inventario actualizado.";
				}
            //echo "Inventario actualizado.";
        } else {
            // Error al actualizar el inventario
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    } else {
        // El producto no existe en el inventario
        echo "El producto no está registrado en el inventario.";
    }
}

// API para realizar una venta de productos
if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    // Obtener los datos del formulario
    $Id_Prod = $_GET['Id_Prod'];
    $Cantidad = $_GET['Cantidad'];

    // Verificar si el producto existe en el inventario y obtener su información
    $sql = "SELECT * FROM productos_inventario INNER JOIN registro_productos ON productos_inventario.Id_Prod = registro_productos.Id_Prod WHERE productos_inventario.Id_Prod = $Id_Prod";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $Nombre = $row['Nombre'];
        $Presentacion = $row['Presentacion'];
		$Precio = $row['Precio'];
		
		echo "El nombre del producto buscado es: $Nombre";
		echo "\n";
		echo "La presentacion del producto buscado es: $Presentacion";
		echo "\n";
		echo "El precio por pieza del producto buscado es: $Precio";
		echo "\n";
		echo "\n";
		
        // Verificar si hay suficiente cantidad en el inventario
        if ($row['Cantidad'] >= $Cantidad) {
            // Calcular el total de pago
            $total_pago = $Precio * $Cantidad;

            // Actualizar el inventario restando la cantidad vendida
            $sql = "UPDATE productos_inventario SET Cantidad = Cantidad - $Cantidad WHERE Id_Prod = $Id_Prod";
            if ($conn->query($sql) === TRUE) {
				$Id_Venta = $conn->insert_id;
				$sql2 = "INSERT INTO ventas_productos (Id_Venta, Id_Prod, FechaVenta, Cantidad, Precio, Nombre)
				VALUES ($Id_Venta, $Id_Prod, CURDATE(), $Cantidad, $total_pago, '$Nombre')";
                if($conn->query($sql2) === TRUE){
					echo "Inventario actualizado.";
				}
					echo "Venta realizada. Total a pagar: $total_pago.";
				
            } else {
                // Error al actualizar el inventario
                echo "Error: " . $sql . "<br>" . $conn->error;
            }
        } else {
            // No hay suficiente cantidad en el inventario
            echo "No hay suficiente cantidad en el inventario. Cantidad disponible: " . $row['Cantidad'];
        }
    } else {
        // El producto no existe en el inventario
        echo "El producto no está registrado en el inventario.";
    }
}

// Cerrar la conexión a la base de datos
$conn->close();

?>