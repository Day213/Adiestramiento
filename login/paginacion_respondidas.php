<?php
// Paginación para la pestaña de respondidas
if ($total_paginas > 1) {
?>
  <div class="flex justify-center items-center gap-2 py-4">
    <?php
    if ($pagina_actual > 1) {
      echo "<a class='bg-slate-300 p-2 rounded-md text-xs' href='?pagina_respondidas=" . ($pagina_actual - 1) . "'>&laquo; Anterior</a>";
    }
    for ($i = 1; $i <= $total_paginas; $i++) {
      $clase_activa = ($i == $pagina_actual) ? "bg-slate-400 p-1 px-3 rounded-full text-white" : "bg-slate-200 p-1 px-3 rounded-full";
      echo "<a style='padding:5px 10px; border-radius:10px' class='" . $clase_activa . "' href='?pagina_respondidas=" . $i . "'>" . $i . "</a>";
    }
    if ($pagina_actual < $total_paginas) {
      echo "<a style='padding:8px 10px;' class='bg-slate-300 p-2 rounded-md text-xs' href='?pagina_respondidas=" . ($pagina_actual + 1) . "'>Siguiente &raquo;</a>";
    }
    ?>
  </div>
<?php }
?>