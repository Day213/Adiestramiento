<?php session_start(); ?>
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

<?php
include '../conexion.php';

$id_gestion = htmlspecialchars($_GET["id"]);
$sql = "SELECT * FROM gestion WHERE id = $id_gestion";
$respuesta = $conexion->query($sql);
$fila = $respuesta->fetch_assoc();
?>

<body class="flex flex-col justify-center items-center bg-gray-100 min-h-screen">
  <?php include "../header.php"; ?>
  <div class="mb-8 encabezado">
    <h1 class="font-bold text-blue-700 text-3xl text-center uppercase">RESPONDER A:
      <?php echo $fila['nombre_solicitante'] ?></h1>
  </div>

  <form action="./procesarRespuesta.php" method="GET" class="bg-white shadow-md mb-4 px-8 pt-6 pb-8 rounded w-[50vw]">

    <div class="mb-4">
      <input type="hidden" name='id' value="<?php echo $fila['id'] ?>">
      <label for="correo" class="block mb-2 font-bold text-gray-700 text-slate-400 text-sm">Correo</label>
      <input type="text" class="bg-slate-200 shadow px-3 py-2 border rounded focus:shadow-outline focus:outline-none w-full text-gray-700 text-slate-400 leading-tight appearance-none" id="correo" name="correo" value="<?php echo $fila['correo']; ?>" />
    </div>
    <div class="mb-4">
      <label for="asunto" class="block mb-2 font-bold text-gray-700 text-sm">asunto</label>
      <input type="text" id="asunto" name="asunto" required
        class="shadow px-3 py-2 border rounded focus:shadow-outline focus:outline-none w-full text-gray-700 uppercase leading-tight appearance-none"
        value="RESPUESTA PARA <?php echo $fila['nombre_solicitante'] ?> sobre el <?php echo $fila['tipo_solicitud'] ?> de: <?php echo $fila['tema_solicitante'] ?>" />
    </div>

    <div class="mb-4">
      <label for="cuerpo" class="block mb-2 font-bold text-gray-700 text-sm">cuerpo</label>
      <textarea type="text" id="cuerpo" name="cuerpo" required
        class="shadow px-3 py-2 border rounded focus:shadow-outline focus:outline-none w-full text-gray-700 leading-tight appearance-none"></textarea>
    </div>

    <div class="flex flex-col justify-center items-center gap-4">
      <button type="submit"
        class="bg-green-600 hover:bg-green-700 px-6 py-2 rounded focus:shadow-outline focus:outline-none w-full font-bold text-white uppercase transition duration-150">Responder solicitud</button>

      <a href="./ListarFormulario.php" class="w-full">
        <button
          type="button"
          class="hover:bg-blue-700 px-6 py-2 border border-slate-600 rounded focus:shadow-outline focus:outline-none w-full font-bold text-slate-600 hover:text-white uppercase transition duration-150">Volver a la lista</button>
      </a>
    </div>
  </form>
  </div>
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