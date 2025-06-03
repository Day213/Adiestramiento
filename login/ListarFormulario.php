<?php
session_start();
if (isset($_SESSION['user_id'])) {
} else {
    header('location: /adiestramiento/login/');
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
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script type="text/javascript">
        function confirmar() {
            return confirm("¿estas seguro de eliminar esta solicitud?")
        }
    </script>
    <style>
        /* Tooltip container */
        .tooltip {
            position: relative;
            display: inline-block;
        }

        /* Tooltip text */
        .tooltip .tooltiptext {
            visibility: hidden;
            width: 120px;
            background-color: #555;
            color: #fff;
            text-align: center;
            padding: 5px 0;
            border-radius: 6px;

            /* Position the tooltip text */
            position: absolute;
            z-index: 1;
            bottom: 125%;
            left: 50%;
            margin-left: -60px;

            /* Fade in tooltip */
            opacity: 0;
            transition: opacity 0.3s;
        }

        /* Tooltip arrow */
        .tooltip .tooltiptext::after {
            content: "";
            position: absolute;
            top: 100%;
            left: 50%;
            margin-left: -5px;
            border-width: 5px;
            border-style: solid;
            border-color: #555 transparent transparent transparent;
        }

        /* Show the tooltip text when you mouse over the tooltip container */
        .tooltip:hover .tooltiptext {
            visibility: visible;
            opacity: 1;
        }

        /* Estilos básicos del contenedor */
        .tabs-container {
            margin: 50px auto;
            border: 1px solid #ccc;
            border-radius: 8px;
            overflow: hidden;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            font-family: sans-serif;
        }

        /* Estilos de los botones de las pestañas */
        .tab-buttons {
            display: flex;
            /* Para que los botones se coloquen uno al lado del otro */
            border-bottom: 1px solid #ccc;
            background-color: #f4f4f4;
        }

        .tab-button {
            padding: 15px 20px;
            border: none;
            background-color: transparent;
            cursor: pointer;
            font-size: 16px;
            color: #555;
            transition: background-color 0.3s, color 0.3s;
            flex-grow: 1;
            /* Para que los botones ocupen el espacio disponible equitativamente */
            text-align: center;
        }

        .tab-button:hover {
            background-color: #e2e2e2;
        }

        .tab-button.active {
            background-color: #fff;
            color: #333;
            border-bottom: 3px solid #007bff;
            /* Indicador de pestaña activa */
            font-weight: bold;
        }

        /* Estilos del contenido de las pestañas */
        .tab-content {
            padding: 20px;
            background-color: #fff;
        }

        .tab-pane {
            display: none;
            /* Por defecto, todos los paneles están ocultos */
        }

        .tab-pane.active {
            display: block;
            /* Solo el panel activo se muestra */
        }

        .tab-pane h3 {
            color: #007bff;
            margin-top: 0;
        }
    </style>
</head>


<body class="flex flex-col justify-center items-center bg-gray-100 min-h-screen">
    <?php
    include "../conexion.php";
    include "../header.php";
    ?>

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


    $sql_registros = "SELECT * FROM gestion LIMIT $offset, $registro_por_pagina";
    $resultado_registros = $conexion->query($sql_registros);


    if (!$resultado) {
        die("Error en la consulta: " . mysqli_error($conexion));
    }
    ?>

    <?php if (isset($_GET['exito']) && $_GET['exito'] == '1'): ?>
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                Swal.fire({
                    icon: 'success',
                    title: 'Respuesta enviada',
                    text: 'Su respuesta ha sido enviada exitosamente',
                    background: '#f5f5f5',
                    color: '#00000',
                    showConfirmButton: false,
                    timer: 5000,
                    timerProgressBar: true,
                    customClass: {
                        popup: 'rounded-xl shadow-lg'
                    }
                });
            });
        </script>
    <?php endif; ?>



    <h1 class="bg-opacity-80 mx-8 mt-24 px-6 py-4 font-extrabold text-cyan-700 text-4xl text-center tracking-wide">GESTIÓN
        DE SOLICITUDES <?php echo $resultado->num_rows ?></h1>

    <div class="mx-auto max-w-[1200px] overflow-x-auto">
        <div class="tabs-container">
            <div class="tab-buttons">
                <button class="tab-button active" data-tab="tab1">Solicitudes pendientes</button>
                <button class="tab-button" data-tab="tab2">Solicitudes respondidas</button>
            </div>

            <div class="flex justify-center w-full tab-content">
                <div id="tab1" class="tab-pane active">
                    <table class="bg-white shadow-md rounded-lg overflow-hidden">
                        <thead class="bg-slate-400 text-white">
                            <tr>
                                <th class="px-4 py-3 text-center">Solicitud</th>
                                <th class="px-4 py-3 text-center">Solicitante</th>
                                <th class="px-4 py-3 text-center text-nowrap">N° asistentes</th>
                                <th class="px-4 py-3 text-center">Fecha </th>
                                <th class="px-4 py-3 text-center">Tema </th>
                                <th class="px-4 py-3 text-center">Telefono</th>
                                <th class="px-4 py-3 text-center">Correo</th>
                                <th class="px-4 py-3 text-center">Acciones</th>
                                <th class="px-4 py-3 text-center">Respuesta</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php while ($fila = mysqli_fetch_assoc($resultado_registros)) { ?>
                                <tr class="hover:bg-blue-50 border-b">
                                    <td class="px-4 py-2"><?php echo $fila['tipo_solicitud']; ?></td>
                                    <td class="px-4 py-2">
                                        <div class="text-nowrap tooltip"><?php echo mb_strimwidth($fila['nombre_solicitante'], 0, 15, "..."); ?>
                                            <span class="tooltiptext"><?php echo $fila['nombre_solicitante'] ?></span>
                                        </div>
                                    </td>
                                    <td class="px-4 py-2 font-bold text-slate-600 text-center"><?php echo $fila['cantidad_asistente']; ?>
                                    </td>
                                    <td class="px-4 py-2 font-bold text-blue-600 text-nowrap"><?php echo $fila['fecha_aproximada']; ?></td>
                                    <td class="px-4 py-2">
                                        <div class="text-nowrap tooltip"><?php echo mb_strimwidth($fila['tema_solicitante'], 0, 15, "..."); ?>
                                            <span class="tooltiptext"><?php echo $fila['tema_solicitante'] ?></span>
                                        </div>
                                    </td>
                                    <td class="px-4 py-2"><?php echo $fila['telefono']; ?></td>
                                    <td class="px-4 py-2"><?php echo $fila['correo']; ?></td>

                                    <td class="flex justify-center items-center px-4 py-2 text-center">
                                        <a href="eliminar.php?id=<?php echo $fila['id']; ?>"
                                            class="font-semibold text-slate-500 hover:text-red-500 text-center hover:underline" onclick="return confirmar();">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-trash-icon lucide-trash">
                                                <path d="M3 6h18" />
                                                <path d="M19 6v14c0 1-1 2-2 2H7c-1 0-2-1-2-2V6" />
                                                <path d="M8 6V4c0-1 1-2 2-2h4c1 0 2 1 2 2v2" />
                                            </svg>
                                        </a>
                                    </td>
                                    <td class="px-4 py-2">
                                        <a href="./respuesta.php?id=<?php echo $fila['id']; ?>"
                                            class="flex justify-center font-semibold text-slate-500 hover:text-green-500 hover:underline">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-mail-icon lucide-mail">
                                                <path d="m22 7-8.991 5.727a2 2 0 0 1-2.009 0L2 7" />
                                                <rect x="2" y="4" width="20" height="16" rx="2" />
                                            </svg>
                                        </a>
                                    </td>

                                </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                    <?php include "./paginacion.php" ?>
                </div>
                <div id="tab2" class="tab-pane">
                    <h3>Contenido de la Pestaña 2</h3>
                    <p>Aquí encontrarás la información relacionada con la segunda pestaña. Es un buen lugar para organizar
                        secciones temáticas.</p>
                </div>
                <div id="tab3" class="tab-pane">
                    <h3>Contenido de la Pestaña 3</h3>
                    <p>El contenido de la tercera pestaña. Las pestañas son excelentes para formularios, galerías de productos, o
                        secciones de preguntas frecuentes.</p>
                </div>
            </div>
        </div>

        <script>
            document.addEventListener('DOMContentLoaded', function() {
                const tabButtons = document.querySelectorAll('.tab-button');
                const tabPanes = document.querySelectorAll('.tab-pane');

                tabButtons.forEach(button => {
                    button.addEventListener('click', () => {
                        // 1. Quitar la clase 'active' de todos los botones y paneles
                        tabButtons.forEach(btn => btn.classList.remove('active'));
                        tabPanes.forEach(pane => pane.classList.remove('active'));

                        // 2. Agregar la clase 'active' al botón clicado
                        button.classList.add('active');

                        // 3. Obtener el ID del contenido de la pestaña a mostrar
                        const targetTabId = button.dataset.tab; // Obtiene "tab1", "tab2", etc.
                        const targetTabPane = document.getElementById(targetTabId);

                        // 4. Mostrar el contenido de la pestaña correspondiente
                        if (targetTabPane) {
                            targetTabPane.classList.add('active');
                        }
                    });
                });

                // Opcional: Si quieres que la primera pestaña esté activa por defecto al cargar la página
                // Simula un clic en el primer botón de pestaña
                if (tabButtons.length > 0) {
                    tabButtons[0].click();
                }
            });
        </script>
    </div>
</body>

</html>>
</body>

</html>

</html>

</html>

</html>

</html>

</html>

</html>

</html>

</html>

</html>

</html>

</html>

</html>

</html>

</html>

</html>

</html>

</html>

</html>

</html>

</html>

</html>

</html>

</html>

</html>

</html>

</html>

</html>

</html>

</html>

</html>

</html>

</html>

</html>

</html>

</html>

</html>

</html>

</html>

</html>

</html>

</html>

</html>

</html>

</html>

</html>

</html>

</html>

</html>

</html>

</html>

</html>

</html>

</html>

</html>

</html>

</html>

</html>

</html>

</html>

</html>

</html>

</html>

</html>

</html>

</html>

</html>

</html>

</html>

</html>

</html>

</html>

</html>

</html>

</html>

</html>