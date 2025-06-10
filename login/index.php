<?php
session_start();
if (isset($_SESSION['user_id'])) {
  header('location: /adiestramiento/login/ListarFormulario.php');
}
?>

<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Gestión de Solicitud</title>

  <link href="../src/styles.css" rel="stylesheet" />

  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>

<body
  class="flex flex-col justify-center items-center bg-gray-100 min-h-screen">

  <?php include "../header.php" ?>
  <!-- <header class="flex mb-8 px-4 py-4 w-full">
    <img
      src="../logo.png"
      alt="Logo Institución"
      class="top-10 left-5 absolute h-16" />
  </header> --><?php if (isset($_GET['error']) && $_GET['error'] == '1'): ?>
    <script>
      document.addEventListener('DOMContentLoaded', function() {
        Swal.fire({
          icon: "error",
          title: ' error: al inicial sesión',
          text: 'la cedula o la contraseña es incorrecta.',
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
  <div class="mb-8 encabezado">
    <h1 class="font-bold text-blue-700 text-3xl text-center uppercase">
      iniciar sesión
    </h1>
  </div>

  <div class="mb-6 w-full max-w-md">
    <form
      action="./procesarLogin.php"
      method="post"
      class="bg-white shadow-md mb-4 px-8 pt-6 pb-8 rounded">
      <div class="mb-4">
        <label for="cedula" class="block mb-2 font-bold text-gray-700 text-sm">Cedula</label>
        <input
          type="number"
          id="cedula"
          name="cedula"
          required
          class="shadow px-3 py-2 border rounded focus:shadow-outline focus:outline-none w-full text-gray-700 leading-tight appearance-none" />
      </div>

      <div class="mb-4">
        <label
          for="contrasena"
          class="block mb-2 font-bold text-gray-700 text-sm">Contraseña</label>
        <input
          type="password"
          id="contrasena"
          name="contrasena"
          required
          class="shadow px-3 py-2 border rounded focus:shadow-outline focus:outline-none w-full text-gray-700 leading-tight appearance-none" />
      </div>

      <div class="w-full">
        <div>
          <button
            type="submit"
            class="bg-blue-600 hover:bg-blue-700 px-6 py-2 border-none rounded focus:shadow-outline focus:outline-none w-full font-bold text-white uppercase transition duration-150">
            Ingresar
          </button>
        </div>
      </div>
      <div class="flex justify-between mt-4 text-blue-700">
        <!-- <a href="./crearUsuario.php"> Crear Nuevo Usuario</a>
        <a href="./olvide.php"> ¿Olvidé mi Contraseña?</a> -->
      </div>
    </form>
  </div>
</body>

</html>