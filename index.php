<?php

if (isset($_SESSION['user_id'])) {
  header('location: ./ListarFormulario.php');
}
?>
<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Gestión de Solicitud</title>
  <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
  <link href="/src/styles.css" rel="stylesheet" />

  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>

<body class="flex flex-col justify-center items-center bg-gray-100 min-h-screen">
  <?php include "./conexion.php" ?>
  <?php include "./header.php" ?>
  <div class="mb-8 encabezado">
    <h1 class="font-bold text-blue-700 text-3xl text-center">GESTIÓN DE SOLICITUD</h1>
  </div>

  <div class="mb-6 w-full max-w-md">
    <?php if (isset($_GET['exito']) && $_GET['exito'] == '1'): ?>
      <script>
        document.addEventListener('DOMContentLoaded', function() {
          Swal.fire({
            icon: 'success',
            title: '¡Solicitud enviada!',
            text: 'Su solicitud ha sido enviada exitosamente',
            background: 'lime-700',
            color: '',
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
    <form action="./procesarSolicitud.php" method="post" class="bg-white shadow-md mb-4 px-8 pt-6 pb-8 rounded">
      <div class="mb-4">
        <label for="tipo_solicitud" class="block mb-2 font-bold text-gray-700 text-sm">Elige una opción:</label>
        <select id="tipo_solicitud" name="tipo_solicitud" required
          class="shadow px-3 py-2 border rounded focus:shadow-outline focus:outline-none w-full text-gray-700 leading-tight appearance-none">
          <option value="">-- Selecciona --</option>
          <option value="taller">Taller</option>
          <option value="curso">Curso</option>
        </select>
      </div>
      <div class="mb-4">
        <label for="nombre_solicitante" class="block mb-2 font-bold text-gray-700 text-sm">¿Quién lo solicita?</label>
        <input type="text" id="nombre_solicitante" name="nombre_solicitante" required
          class="shadow px-3 py-2 border rounded focus:shadow-outline focus:outline-none w-full text-gray-700 leading-tight appearance-none" />
      </div>
      <div class="mb-4">
        <label for="cantidad_asistente" class="block mb-2 font-bold text-gray-700 text-sm">Cantidad de
          Asistentes:</label>
        <input type="number" id="cantidad_asistente" name="cantidad_asistente" min="1" required
          class="shadow px-3 py-2 border rounded focus:shadow-outline focus:outline-none w-full text-gray-700 leading-tight appearance-none" />
      </div>
      <div class="mb-4">
        <label for="fecha_aproximada" class="block mb-2 font-bold text-gray-700 text-sm">Fecha Aproximada:</label>
        <input type="date" id="fecha_aproximada" name="fecha_aproximada" required
          class="shadow px-3 py-2 border rounded focus:shadow-outline focus:outline-none w-full text-gray-700 leading-tight appearance-none" />
      </div>
      <div class="mb-4">
        <label for="tema_solicitante" class="block mb-2 font-bold text-gray-700 text-sm">Tema</label>
        <input type="text" id="tema_solicitante" name="tema_solicitante" required
          class="shadow px-3 py-2 border rounded focus:shadow-outline focus:outline-none w-full text-gray-700 leading-tight appearance-none" />
      </div>
      <div class="mb-4">
        <label for="telefono" class="block mb-2 font-bold text-gray-700 text-sm">Teléfono:</label>
        <input type="text" name="telefono" maxlength="11" placeholder="Ej: 0412-1234567"
          title="Formato: 04XX-XXXXXXX (ej: 0412-1234567)" required
          class="shadow px-3 py-2 border rounded focus:shadow-outline focus:outline-none w-full text-gray-700 leading-tight appearance-none" />
      </div>
      <div class="mb-4">
        <label for="correo" class="block mb-2 font-bold text-gray-700 text-sm">correo</label>
        <input type="email" id="correo" name="correo" required
          class="shadow px-3 py-2 border rounded focus:shadow-outline focus:outline-none w-full text-gray-700 leading-tight appearance-none" />
      </div>

      <div class="flex justify-center items-center">
        <button type="submit"
          class="bg-blue-600 hover:bg-blue-700 px-6 py-2 rounded focus:shadow-outline focus:outline-none font-bold text-white transition duration-150">Enviar
          Solicitud</button>
      </div>
    </form>
  </div>
</body>

</html>