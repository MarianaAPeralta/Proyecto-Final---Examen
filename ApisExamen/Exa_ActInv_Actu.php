<?php
// API para Actulaizar el inventario de un producto
if (isset($_REQUEST['Id_Prod']) && isset($_REQUEST['Cantidad']))
{
	include 'conexionExa.php';
    // Obtiene los datos de la consulta
    
    $Id_Prod = $_REQUEST['Id_Prod'];
    $Cantidad = $_REQUEST['Cantidad'];

    // Verificar si el producto existe en la tabla Productos_inventario
    $sql = "SELECT * FROM Productos_inventario WHERE Id_Prod = $Id_Prod";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        // Si el producto existe, actualizar el inventario
        $sql = "UPDATE productos_inventario SET Cantidad = Cantidad + $Cantidad WHERE Id_Prod = $Id_Prod";
        if ($conn->query($sql) === TRUE) {
            // Éxito al actualizar el inventario
			$Id_Fact = $conn->insert_id;
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

// Cerrar la conexión a la base de datos
$conn->close();

?>