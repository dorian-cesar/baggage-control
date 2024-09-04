<?php
include __DIR__.'/conexion.php';

$rut = $_POST['rut'];
$nombre = $_POST['nombre'];
$origen = $_POST['origen'];
$destino = $_POST['destino'];
$asiento = $_POST['asiento'];
$servicio = $_POST['servicio'];
$equipaje = $_POST['equipaje'];
$fechaHora = date('Y-m-d H:i:s');

// Iniciamos la salida HTML para los tickets
echo "<h3>Tickets de Equipaje</h3>";

// Generamos y registramos un ticket por cada pieza de equipaje
for ($i = 1; $i <= $equipaje; $i++) {
    // Generamos un código de equipaje único por pieza
    $codigoEquipaje = $servicio . '-' . $rut . '-' . $i;

    // Insertamos el ticket en la base de datos
    $sql = "INSERT INTO registros (rut, nombre, origen, destino, asiento, servicio, equipaje, codigo_equipaje, fecha_hora) 
            VALUES ('$rut', '$nombre', '$origen', '$destino', '$asiento', '$servicio', '$equipaje', '$codigoEquipaje', '$fechaHora')";

    if ($conn->query($sql) === TRUE) {
        // Mostramos la información del ticket
        echo "<div class='ticket'>";
        echo "Nombre: $nombre<br>";
        echo "RUT: $rut<br>";
        echo "Origen: $origen<br>";
        echo "Destino: $destino<br>";
        echo "Número de Asiento: $asiento<br>";
        echo "Número de Servicio o Patente: $servicio<br>";
        echo "Pieza de Equipaje: $i de $equipaje<br>";
        echo "Código de Equipaje: $codigoEquipaje<br>";
        echo "<br>";
        echo "<img src='https://api.qrserver.com/v1/create-qr-code/?size=150x150&data=$codigoEquipaje' alt='QR Code' /><br><br>";
        echo "<hr>";
        echo "</div>";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

// Cerramos la conexión a la base de datos
$conn->close();
?>
