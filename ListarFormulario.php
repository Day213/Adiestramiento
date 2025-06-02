<?php session_start();
if (isset($_SESSION['user_id'])) {
} else {
    header('location:../adiestramiento/login/');
}
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestión de Solicitudes</title>
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
    <link href="/src/styles.css" rel="stylesheet">
    <script type="text/javascript">
        function confirmar() {
            return confirm("¿estas seguro de eliminar esta solicitud?")
        }
    </script>

</head>


<body class="bg-gray-100 min-h-screen">
    <?php include "./conexion.php" ?>
    <header class="flex mb-8 px-4 py-4 w-full">
        <div class="flex justify-between items-center w-full">
            <img src="logo.png" alt="Logo Institución" class="mr-4 h-16" />
            <a href="./login/cerrarSesion.php">
                <button class="bg-red-500 p-2 rounded-md font-bold text-white">Cerrar sesión</button>
            </a>
        </div>


    </header>
    <?php
    if (!isset($conexion) || !$conexion) {
        die("Error de conexión a la base de datos.");
    }
    ?>


    <?php
    $sql = "SELECT * FROM gestion";
    $resultado = mysqli_query($conexion, $sql);



    $registro_por_pagina = 10;

    $pagina_actual = isset($_GET['pagina']) ? (int)$_GET['pagina'] : 1;
    if ($pagina_actual < 1) {
        $pagina_actual = 1;
    }




    $sql_total = "SELECT COUNT(*) AS total FROM gestion";
    $resultado_total = $conexion->query($sql_total);
    $fila_total = $resultado_total->fetch_assoc();
    $total_registros = $fila_total['total'];


    $total_paginas = ceil($total_registros / $registro_por_pagina);


    if ($pagina_actual > $total_paginas && $total_paginas > 0) {
        $pagina_actual = $total_paginas;
    } elseif ($total_paginas == 0) {
        $pagina_actual = 1;
    }


    $offset = ($pagina_actual - 1) * $registro_por_pagina;


    $sql_registros = "SELECT * FROM gestion LIMIT $offset, $registro_por_pagina"; // Reemplaza 'tu_tabla'
    $resultado_registros = $conexion->query($sql_registros);


    if (!$resultado) {
        die("Error en la consulta: " . mysqli_error($conexion));
    }
    ?>
    <h1 class="bg-opacity-80 mx-8 my-8 px-6 py-4 font-extrabold text-cyan-700 text-4xl text-center tracking-wide">GESTIÓN
        DE SOLICITUDES <?php echo $resultado->num_rows ?></h1>

    <div class="mx-auto max-w-5xl overflow-x-auto">
        <table class="bg-white shadow-md rounded-lg min-w-full overflow-hidden">
            <thead class="bg-slate-400 text-white">
                <tr>
                    <th class="px-4 py-3 text-center">Tipo de solicitud</th>
                    <th class="px-4 py-3 text-center">Nombre del solicitante</th>
                    <th class="px-4 py-3 text-center">Cantidad de asistentes</th>
                    <th class="px-4 py-3 text-center">Fecha aproximada</th>
                    <th class="px-4 py-3 text-center">Tema de la solicitud</th>
                    <th class="px-4 py-3 text-center">Teléfono</th>
                    <th class="px-4 py-3 text-center">correo</th>
                    <th class="px-4 py-3 text-center">Acciones</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($fila = mysqli_fetch_assoc($resultado_registros)) { ?>
                    <tr class="hover:bg-blue-50 border-b">
                        <td class="px-4 py-2"><?php echo $fila['tipo_solicitud']; ?></td>
                        <td class="px-4 py-2"><?php echo $fila['nombre_solicitante']; ?></td>
                        <td class="px-4 py-2"><?php echo $fila['cantidad_asistente']; ?></td>
                        <td class="px-4 py-2"><?php echo $fila['fecha_aproximada']; ?></td>
                        <td class="px-4 py-2"><?php echo $fila['tema_solicitante']; ?></td>
                        <td class="px-4 py-2"><?php echo $fila['telefono']; ?></td>
                        <td class="px-4 py-2"><?php echo $fila['correo']; ?></td>
                        <td class="px-4 py-2">
                            <a href="eliminar.php?id=<?php echo $fila['id']; ?>" class="font-semibold text-red-600 hover:underline"
                                onclick="return confirmar();">Eliminar</a>
                        </td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
        <?php include "./paginacion.php" ?>
    </div>
</body>

</html>