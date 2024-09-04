<?php
include 'conexion.php';

$rut = $_POST['rut'];
$nombre = $_POST['nombre'];
$origen = $_POST['origen'];
$destino = $_POST['destino'];
$asiento = $_POST['asiento'];
$servicio = $_POST['servicio'];
$equipaje = $_POST['equipaje'];
$codigoEquipaje = $_POST['codigoEquipaje'];
$fechaHora = date('Y-m-d H:i:s');

$sql = "INSERT INTO registros (rut, nombre, origen, destino, asiento, servicio, equipaje, codigo_equipaje, fecha_hora) 
VALUES ('$rut', '$nombre', '$origen', '$destino', '$asiento', '$servicio', '$equipaje', '$codigoEquipaje', '$fechaHora')";

if ($conn->query($sql) === TRUE) {
    echo "<h3>Ticket de Equipaje</h3>";
    echo "Nombre: $nombre<br>";
    echo "RUT: $rut<br>";
    echo "Origen: $origen<br>";
    echo "Destino: $destino<br>";
    echo "Número de Asiento: $asiento<br>";
    echo "Número de Servicio o Patente: $servicio<br>";
    echo "Cantidad de Equipaje: $equipaje<br>";
    echo "Código de Equipaje: $codigoEquipaje<br>";
    echo "<br>";
    echo "<img src='https://api.qrserver.com/v1/create-qr-code/?size=150x150&data=$codigoEquipaje' alt='QR Code' />";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();
?>
