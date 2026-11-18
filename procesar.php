<?php
// Configuración de la base de datos
$servername = "localhost";
$username   = "root";
$password   = "";
$dbname     = "contactos";

// Crear conexión
$conn = new mysqli($servername, $username, $password, $dbname);

// Verificar conexión
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

// Procesar cuando el formulario se envía por POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nombre   = $_POST['nombre'];
    $correo   = $_POST['correo'];
    $telefono = $_POST['telefono'];
    $consulta = $_POST['consulta'];

    // Prepara la consulta SQL usando sentencias preparadas para mayor seguridad
    $stmt = $conn->prepare("INSERT INTO contactos (nombre, correo, telefono, consulta) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("ssss", $nombre, $correo, $telefono, $consulta);

    if ($stmt->execute()) {
        echo "<script>alert('¡Mensaje enviado con éxito!'); window.location.href='index.html';</script>";
    } else {
        echo "Error al guardar los datos: " . $stmt->error;
    }

    $stmt->close();
}

$conn->close();
?>