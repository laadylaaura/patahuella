<?php
session_start();
require_once '../controladores/negocioControlador.php';

// Configuración de paginación
$alojamientos_por_pagina = 6;
$pagina_actual = isset($_GET['pagina']) ? (int)$_GET['pagina'] : 1;
$inicio = ($pagina_actual - 1) * $alojamientos_por_pagina;

// Instanciar el controlador
$controlador = new NegocioControlador();

// Obtener los alojamientos desde la base de datos
$data = $controlador->listarPorTipo("hotel");

// Verificar si hay errores
if (isset($data["error"])) {
    echo "<p>Error: " . $data["error"] . "</p>";
    exit;
}

// Obtener los alojamientos
$alojamientos = $data["negocios"] ?? [];
$total_alojamientos = count($alojamientos);
$total_paginas = ceil($total_alojamientos / $alojamientos_por_pagina);

// Obtener solo los alojamientos para la página actual
$alojamientos_pagina = array_slice($alojamientos, $inicio, $alojamientos_por_pagina);

include 'inc/header.php';
?>
<link href="../assets/css/bootstrap.min.css" rel="stylesheet">
<link href="../assets/css/index.css" rel="stylesheet">

<div class="container mt-5 mb-5">
    <h1 class="h1-Alo text-center text-white mb-4">Alojamientos Pet Friendly</h1>
    <div class="row justify-content-center">
        <div class="col-lg-6 col-md-8 col-sm-10" id="alojamientos-acordeon">
            <?php foreach ($alojamientos_pagina as $alojamiento): ?>
                <div class="card shadow mb-4 bg-light">
                    <div class="row g-0">
                        <div class="col-md-4">
                            <!-- Mostrar la primera imagen del alojamiento -->
                            <?php if (!empty($alojamiento['imagenes'])): ?>
                                <img src="<?php echo htmlspecialchars('../assets/imagenesNegocio/' . $alojamiento['imagenes'][0]['ruta_imagen']); ?>" 
                                    class="img-fluid rounded-start h-100" 
                                    alt="<?php echo htmlspecialchars($alojamiento['nombre']); ?>"
                                    style="object-fit: cover;">
                            <?php else: ?>
                                <img src="../assets/imagenesNegocio/default.jpg" 
                                    class="img-fluid rounded-start h-100" 
                                    alt="Imagen no disponible"
                                    style="object-fit: cover;">
                            <?php endif; ?>
                        </div>
                        <div class="col-md-8">
                            <div class="card-body text-center">
                                <h5 class="card-title"><?php echo htmlspecialchars($alojamiento['nombre']); ?></h5>
                                <button class="btn btn2 mt-2" type="button" data-bs-toggle="collapse" 
                                        data-bs-target="#alojamiento-<?php echo $alojamiento['id_negocio']; ?>" 
                                        aria-expanded="false" aria-controls="alojamiento-<?php echo $alojamiento['id_negocio']; ?>">
                                    Ver más
                                </button>
                                <div class="collapse mt-3" id="alojamiento-<?php echo $alojamiento['id_negocio']; ?>" data-bs-parent="#alojamientos-acordeon">
                                    <p class="card-text"><?php echo htmlspecialchars($alojamiento['descripcion']); ?></p>
                                    <p><strong>Dirección:</strong> <?php echo htmlspecialchars($alojamiento['direccion']); ?></p>
                                    <p><strong>Horario:</strong> <?php echo htmlspecialchars($alojamiento['horario']); ?></p>
                                    <p><strong>Servicios:</strong> <?php echo htmlspecialchars($alojamiento['servicios']); ?></p>
                                    <a href="<?php echo htmlspecialchars($alojamiento['web']); ?>" target="_blank" 
                                       class="btn btn-primary">Visitar web</a>
                                    <a href="<?php echo $ruta; ?>usuario/agregarFavorito?tipo=alojamiento&amp;id=<?php echo urlencode($alojamiento['id_negocio']); ?>" 
                                       class="btn btn2 ms-2">Agregar a Favoritos</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
    
    <!-- Paginación numérica -->
    <?php if ($total_paginas > 1): ?>
        <nav aria-label="Paginación de alojamientos" class="mt-4">
            <ul class="pagination justify-content-center">
                <li class="page-item <?php echo ($pagina_actual <= 1) ? 'disabled' : ''; ?>">
                    <a class="page-link" href="?pagina=<?php echo $pagina_actual - 1; ?>" aria-label="Anterior">
                        <span aria-hidden="true">&laquo;</span>
                    </a>
                </li>
                <?php for ($i = 1; $i <= $total_paginas; $i++): ?>
                    <li class="page-item <?php echo ($pagina_actual == $i) ? 'active' : ''; ?>">
                        <a class="page-link" href="?pagina=<?php echo $i; ?>"><?php echo $i; ?></a>
                    </li>
                <?php endfor; ?>
                <li class="page-item <?php echo ($pagina_actual >= $total_paginas) ? 'disabled' : ''; ?>">
                    <a class="page-link" href="?pagina=<?php echo $pagina_actual + 1; ?>" aria-label="Siguiente">
                        <span aria-hidden="true">&raquo;</span>
                    </a>
                </li>
            </ul>
        </nav>
    <?php endif; ?>
</div>

<!-- <?php include '../vistas/resenasAlojamientos.php'; ?> -->
<?php include 'inc/footer.php'; ?>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

<!-- Script para cambiar el texto del botón y manejar el colapso -->
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Obtener todos los elementos collapse
    const collapseElements = document.querySelectorAll('.collapse');
    
    // Para cada collapse, configurar los listeners
    collapseElements.forEach(function(collapse) {
        // Obtener el ID del collapse
        const collapseId = collapse.id;
        
        // Buscar el botón que controla este collapse
        const button = document.querySelector(`[data-bs-target="#${collapseId}"]`);
        
        if (button) {
            // Eliminar el listener nativo de Bootstrap 
            button.removeAttribute('data-bs-toggle');
            
            // Crear una instancia de collapse de Bootstrap
            const bsCollapse = new bootstrap.Collapse(collapse, {
                toggle: false // No alternar automáticamente al instanciar
            });
            
            // Añadir nuestro propio listener
            button.addEventListener('click', function() {
                if (collapse.classList.contains('show')) {
                    // Si está abierto, cerrarlo
                    bsCollapse.hide();
                } else {
                    // Si está cerrado, abrirlo
                    bsCollapse.show();
                }
            });
            
            // Actualizar el texto del botón cuando el estado cambia
            collapse.addEventListener('show.bs.collapse', function() {
                button.textContent = 'Ver menos';
            });
            
            collapse.addEventListener('hide.bs.collapse', function() {
                button.textContent = 'Ver más';
            });
        }
    });
});
</script>