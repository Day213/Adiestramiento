<?php include "../conexion.php";

if (isset($_GET['id'])) {
    $id = intval($_GET['id']);

    $sql = "DELETE FROM gestion WHERE id = $id";
    $resultado = mysqli_query($conexion, $sql);

    if ($resultado) {
        header("Location: ListarFormulario.php");
        exit;
    } else {
        echo "<p style='color: red; font-weight: bold;'>Error al eliminar el registro: " . mysqli_error($conexion) . "</p>";
    }
} else {
    echo "<p style='color: red; font-weight: bold;'>ID no válido.</p>";
}

mysqli_close($conexion);
?>

?>