<?php

if ($resultado->num_rows > 10) {

?>



  <div class="flex justify-center items-center gap-2 py-4">
    <?php
    if ($pagina_actual > 1) {
      echo "<a class='bg-slate-300 p-2 rounded-md text-xs' href='?pagina=" . ($pagina_actual - 1) . "'>&laquo; Anterior</a>";
    }
    for ($i = 1; $i <= $total_paginas; $i++) {
      $clase_activa = ($i == $pagina_actual) ? "bg-slate-400 p-1 px-3 rounded-full text-white" : "bg-slate-200 p-1 px-3 rounded-full";
      echo "<a class='" . $clase_activa . "' href='?pagina=" . $i . "'>" . $i . "</a>";
    }
    if ($pagina_actual < $total_paginas) {
      echo "<a class='bg-slate-300 p-2 rounded-md text-xs' href='?pagina=" . ($pagina_actual + 1) . "'>Siguiente &raquo;</a>";
    }
    ?>
  </div>
  </body>

  </html>
<?php }
$conexion->close(); ?>