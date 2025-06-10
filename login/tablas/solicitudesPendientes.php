<?php

// Paginación
$registros_por_pagina = 10;
$pagina_actual = isset($_GET['pagina']) ? (int)$_GET['pagina'] : 1;
$inicio = ($pagina_actual - 1) * $registros_por_pagina;

// Contar total de registros
$total_sql = "SELECT COUNT(*) as total FROM gestion WHERE status = 1";
$total_result = $conexion->query($total_sql);
$total_fila = $total_result->fetch_assoc();
$total_registros = $total_fila['total'];
$total_paginas = ceil($total_registros / $registros_por_pagina);

// Consulta con LIMIT
$sql = "SELECT * FROM gestion WHERE status = 1 LIMIT $inicio, $registros_por_pagina";
$resultado_registros = $conexion->query($sql);



?>
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
        <td class="px-4 py-2">
          <span class="<?php echo ($fila['tipo_solicitud'] == 'taller' ? 'bg-green-700' : 'bg-green-600'); ?> p-2 rounded-md text-white text-xs uppercase" style="font-size: 10px;">
            <?php echo $fila['tipo_solicitud']; ?>
          </span>
        </td>
        <td class="px-4 py-2">
          <div class="text-nowrap tooltip">
            <?php echo mb_strimwidth($fila['nombre_solicitante'], 0, 15, "..."); ?>
            <span class="tooltiptext"><?php echo $fila['nombre_solicitante'] ?></span>
          </div>
        </td>
        <td class="px-4 py-2 font-bold text-slate-600 text-center">
          <span class="bg-slate-300 p-1 rounded-full w-5 h-5 text-xs"><?php echo $fila['cantidad_asistente']; ?></span>
        </td>
        <td class="px-4 py-2 font-bold text-blue-600 text-nowrap">
          <span class="bg-blue-600 p-2 rounded-md text-white text-xs"><?php echo $fila['fecha_aproximada']; ?></span>
        </td>
        <td class="px-4 py-2">
          <div class="text-nowrap tooltip"><?php echo mb_strimwidth($fila['tema_solicitante'], 0, 15, "..."); ?>
            <span class="tooltiptext"><?php echo $fila['tema_solicitante'] ?></span>
          </div>
        </td>
        <td class="px-4 py-2"><?php echo $fila['telefono']; ?></td>
        <td class="px-4 py-2"><?php echo $fila['correo']; ?></td>

        <td class="flex justify-center items-center px-4 py-2 text-center">
          <a href="eliminar.php?id=<?php echo $fila['id']; ?>"
            class="flex justify-center items-center"
            onclick="return confirmar();">
            <svg class="bg-slate-300 p-2 rounded-md" xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none"
              stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
              class="lucide lucide-trash-icon lucide-trash">
              <path d="M3 6h18" />
              <path d="M19 6v14c0 1-1 2-2 2H7c-1 0-2-1-2-2V6" />
              <path d="M8 6V4c0-1 1-2 2-2h4c1 0 2 1 2 2v2" />
            </svg>
          </a>
        </td>
        <td class="px-4 py-2">
          <a class="flex justify-center items-center" href="./respuesta.php?id=<?php echo $fila['id']; ?>">
            <svg class="bg-slate-300 p-2 rounded-md" xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none"
              stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
              class="lucide lucide-mail-icon lucide-mail">
              <path d="m22 7-8.991 5.727a2 2 0 0 1-2.009 0L2 7" />
              <rect x="2" y="4" width="20" height="16" rx="2" />
            </svg>
          </a>
        </td>

      </tr>
    <?php } ?>
  </tbody>
</table>

<!-- Paginación -->
<div class="flex justify-center mt-4">
  <nav class="inline-flex shadow-sm rounded-md" aria-label="Pagination">
    <?php if ($pagina_actual > 1): ?>
      <a href="?pagina=<?php echo $pagina_actual - 1; ?>"
        class="bg-white hover:bg-gray-100 p-2 border border-gray-300 text-gray-500">Anterior</a>
    <?php endif; ?>
    <?php for ($i = 1; $i <= $total_paginas; $i++): ?>
      <a href="?pagina=<?php echo $i; ?>"
        class="p-2 border rounded-md border-gray-300 <?php echo $i == $pagina_actual ? 'bg-blue-500 text-white' : 'bg-white text-gray-500 hover:bg-gray-100'; ?>"><?php echo $i; ?></a>
    <?php endfor; ?>
    <?php if ($pagina_actual < $total_paginas): ?>
      <a href="?pagina=<?php echo $pagina_actual + 1; ?>"
        class="bg-white hover:bg-gray-100 p-2 border border-gray-300 rounded-md text-gray-500">Siguiente</a>
    <?php endif; ?>
  </nav>
</div>
<div></div>
<div></div>
<div></div>