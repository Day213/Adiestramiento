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

<body class="flex flex-col justify-center items-center bg-gray-100 h-screen">
  <?php
  include "../conexion.php";

  function verificarContrasena($contrasena, $repetir_contrasena)
  {
    if ($contrasena != $repetir_contrasena) {
      echo "<span class='text-red-500'>La contraseña no coincide, vuelve a intentarlo.</span>";
    }
  }

  if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nombres = htmlspecialchars($_POST['nombres']);
    $apellidos = htmlspecialchars($_POST['apellidos']);
    $cedula = htmlspecialchars($_POST['cedula']);
    $telefono = htmlspecialchars($_POST['telefono']);
    $contrasena = htmlspecialchars($_POST['contrasena']);
    $repetir_contrasena = htmlspecialchars($_POST['repetir_contrasena']);

    $passEncripted = hash('sha256', $contrasena);

    if ($contrasena === $repetir_contrasena) {
      $sql = "INSERT INTO `usuario` (`id`, `nombres`, `apellidos`, `cedula`, `telefono`, `contrasena`) VALUES (NULL, '$nombres', '$apellidos', '$cedula', '$telefono', '$passEncripted')";
      $conexion->query($sql);
    }
  }
  ?>


  <header class="flex mb-8 px-4 py-4 w-full">
    <img src="../logo.png" alt="Logo Institución" class="top-10 left-5 absolute mr-4 h-16" />

  </header>
  <div class="mb-8 encabezado">
    <h1 class="font-bold text-blue-700 text-3xl text-center">Crear Usuario</h1>
    <?php
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
      verificarContrasena($contrasena, $repetir_contrasena);
    }
    ?>
  </div>
  <form class="bg-white shadow p-4 rounded-md" action="" method="post">
    <div class="flex gap-4">
      <div class="mb-4">
        <label for=" nombres" class="block mb-2 font-bold text-gray-700 text-sm">Nombres</label>
        <input type="text" id="nombres" name="nombres" required
          class="shadow px-3 py-2 border rounded focus:shadow-outline focus:outline-none w-full text-gray-700 leading-tight appearance-none" />
      </div>
      <div class="mb-4">
        <label for="apellidos" class="block mb-2 font-bold text-gray-700 text-sm">apellidos</label>
        <input type="text" id="apellidos" name="apellidos" required
          class="shadow px-3 py-2 border rounded focus:shadow-outline focus:outline-none w-full text-gray-700 leading-tight appearance-none" />
      </div>
    </div>
    <div class="flex gap-4">
      <div class="mb-4">
        <label for="cedula" class="block mb-2 font-bold text-gray-700 text-sm">cedula</label>
        <input type="number" id="cedula" name="cedula" required
          class="shadow px-3 py-2 border rounded focus:shadow-outline focus:outline-none w-full text-gray-700 leading-tight appearance-none" />
      </div>
      <div class="mb-4">
        <label for="telefono" class="block mb-2 font-bold text-gray-700 text-sm">Teléfono:</label>
        <input type="text" name="telefono" maxlength="11" placeholder="Ej: 0412-1234567"
          title="Formato: 04XX-XXXXXXX (ej: 0412-1234567)" required
          class="shadow px-3 py-2 border rounded focus:shadow-outline focus:outline-none w-full text-gray-700 leading-tight appearance-none" />
      </div>
    </div>
    <div class="mb-4">
      <label for="correo" class="block mb-2 font-bold text-gray-700 text-sm">correo</label>
      <input type="text" id="correo" name="correo" required
        class="shadow px-3 py-2 border rounded focus:shadow-outline focus:outline-none w-full text-gray-700 leading-tight appearance-none" />
    </div>
    <div class="mb-4">
      <label for="contrasena" class="block mb-2 font-bold text-gray-700 text-sm">Contraseña</label>
      <input type="password" id="contrasena" name="contrasena" required
        class="shadow px-3 py-2 border rounded focus:shadow-outline focus:outline-none w-full text-gray-700 leading-tight appearance-none" />
    </div>
    <div class="mb-4">
      <label for="repetir_contrasena" class="block mb-2 font-bold text-gray-700 text-sm"> Repetir Contraseña</label>
      <input type="password" id="repetir_contrasena" name="repetir_contrasena" required
        class="shadow px-3 py-2 border rounded focus:shadow-outline focus:outline-none w-full text-gray-700 leading-tight appearance-none" />
    </div>
    <div class="mt-4 w-full">
      <button type="submit"
        class="bg-blue-600 hover:bg-blue-700 px-6 py-2 rounded focus:shadow-outline focus:outline-none w-full font-bold text-white transition duration-150">Crear Usuario</button>
    </div>
  </form>
  </div>
</body>

</html>

</html>

</html>
</html>