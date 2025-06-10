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

    <link href="../src/styles.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script type="text/javascript">
        function confirmar() {
            return confirm("¿estas seguro de eliminar esta solicitud?")
        }
    </script>

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
        DE SOLICITUDES</h1>

    <div class="mx-auto max-w-[1200px] overflow-x-auto">
        <div class="tabs-container">
            <div class="tab-buttons">
                <button class="tab-button active" data-tab="tab1">Solicitudes pendientes</button>
                <button class="tab-button" data-tab="tab2">Solicitudes respondidas</button>
            </div>

            <div class="flex w-full tab-content">
                <div id="tab1" class="tab-pane active">
                    <div class="l-4">
                        <?php include "./tablas/solicitudesPendientes.php"; ?>
                    </div>
                </div>
                <div id="tab2" class="tab-pane">
                    <?php include "./tablas/solicitudesRespondidas.php"; ?>
                </div>
            </div>
        </div>

        <script>
            document.addEventListener('DOMContentLoaded', function() {
                const tabButtons = document.querySelectorAll('.tab-button');
                const tabPanes = document.querySelectorAll('.tab-pane');

                // Función para activar una pestaña por índice
                function activarTab(index) {
                    tabButtons.forEach(btn => btn.classList.remove('active'));
                    tabPanes.forEach(pane => pane.classList.remove('active'));
                    tabButtons[index].classList.add('active');
                    tabPanes[index].classList.add('active');
                }

                // // Detectar si la URL tiene el parámetro pagina_respondidas
                // const urlParams = new URLSearchParams(window.location.search);
                // if (urlParams.has('pagina_respondidas')) {
                //     activarTab(1); // Activa la segunda pestaña (índice 1)
                // } else {
                //     activarTab(0); // Activa la primera pestaña (índice 0)
                // }

                tabButtons.forEach((button, idx) => {
                    button.addEventListener('click', () => {
                        activarTab(idx);
                    });
                });
            });
        </script>
    </div>
</body>

</html>