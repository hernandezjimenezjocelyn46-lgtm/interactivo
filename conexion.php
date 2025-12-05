<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    echo "Acceso inválido.";
    exit;
}

$nombre = trim($_POST['nombre'] ?? '');
$comentario = trim($_POST['comentario'] ?? '');

if ($nombre === '' || $comentario === '') {
    echo "Faltan datos obligatorios.";
    exit;
}

$host = 'sql113.infinityfree.com';
$user = 'if0_40528729';
$pass = 'BDJqeOOwjW7A';
$db   = 'if0_40528729_interactivo';

$conexion = mysqli_connect($host, $user, $pass, $db);
if (!$conexion) {
    echo "Error de conexión: " . mysqli_connect_error();
    exit;
}

$stmt = mysqli_prepare($conexion, "INSERT INTO visita (nombre, comentario) VALUES (?, ?)");
if (!$stmt) {
    echo "Error en preparación: " . mysqli_error($conexion);
    mysqli_close($conexion);
    exit;
}

mysqli_stmt_bind_param($stmt, 'ss', $nombre, $comentario);

if (mysqli_stmt_execute($stmt)) {
    echo "<h2>Registro exitoso</h2>";
} else {
    echo "<h2>Error: " . mysqli_error($conexion) . "</h2>";
}

mysqli_stmt_close($stmt);
mysqli_close($conexion);

echo '<hr><p><a href="enlistado.php" style="display:inline-block;padding:10px 20px;background-color:green;color:white;text-decoration:none;border-radius:5px;font-weight:bold;">Ver el Enlistado</a></p>';
?>