<html>
    <head>
<style>
    #tabla th, tr, td{
        border: 1px solid black;
    }
</style>
    </head>
<body>
<?php
$conexion = mysqli_connect("sql113.infinityfree.com", "if0_40528729", "BDJqeOOwjW7A", "if0_40528729_interactivo");
if(!$conexion) {
    echo "Error: No se pudo conectar a MySQL. " . mysqli_connect_error();
    exit;
}
$resultado = mysqli_query($conexion, "SELECT * FROM visita");
if (!$resultado) {
    echo "Error en la consulta: " . mysqli_error($conexion);
    mysqli_close($conexion);
    exit;
}
?>
<table id="tabla">
    <tr>
        <th>Id</th>
        <th>Nombre</th>
        <th>Comentario</th>
    </tr>
    <?php
    while ($fila = $resultado->fetch_assoc()) {
        echo "<tr>";
        echo "<td>" . htmlspecialchars($fila['id']) . "</td>";
        echo "<td>" . htmlspecialchars($fila['nombre']) . "</td>";
        echo "<td>" . nl2br(htmlspecialchars($fila['comentario'])) . "</td>";
        echo "</tr>";
    }
    mysqli_free_result($resultado);
    mysqli_close($conexion);
    ?>
</table>
</body>
</html>