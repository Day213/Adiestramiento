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
        <img src="logo%20.png" alt="Logo Institución" class="mr-4 h-16" />


    </header>
    <?php
    if (!isset($conexion) || !$conexion) {
        die("Error de conexión a la base de datos.");
    }
    ?>

    <h1 class="bg-opacity-80 mx-8 my-8 px-6 py-4 font-extrabold text-cyan-700 text-4xl text-center tracking-wide">GESTIÓN
        DE SOLICITUDES</h1>

    <?php
    $sql = "SELECT * FROM gestion";
    $resultado = mysqli_query($conexion, $sql);

    if (!$resultado) {
        die("Error en la consulta: " . mysqli_error($conexion));
    }
    ?>

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
                <?php while ($fila = mysqli_fetch_assoc($resultado)) { ?>
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
    </div>

    <?php mysqli_close($conexion); ?>

</body>



</html>