<?php 
// Configuración de paginación
$restaurantes_por_pagina = 6;
$pagina_actual = isset($_GET['pagina']) ? (int)$_GET['pagina'] : 1;
$inicio = ($pagina_actual - 1) * $restaurantes_por_pagina;

// Array de restaurantes de ejemplo (reemplázalo con tu consulta a la base de datos)
$restaurantes = [
    [
        'id' => 1,
        'imagen' => '../assets/img/restaurante1.jpg',
        'nombre' => 'Restaurante Ejemplo',
        'descripcion' => 'Este restaurante ofrece una experiencia gastronómica única ideal para ti y tu mascota, con servicios pensados para la comodidad de ambos.',
        'direccion' => 'Calle Falsa 123, Ciudad',
        'horario' => 'Lunes a Domingo: 12:00 - 23:00',
        'web' => 'https://restaurante-ejemplo.com',
        'servicios' => 'Zona pet friendly, menú especial para mascotas'
    ],
    [
        'id' => 2,
        'imagen' => '../assets/img/restaurante2.jpg',
        'nombre' => 'Restaurante Otra Opción',
        'descripcion' => 'Un lugar acogedor donde disfrutar de una comida deliciosa en compañía de tu mascota.',
        'direccion' => 'Avenida Siempre Viva 742, Ciudad',
        'horario' => 'Martes a Domingo: 10:00 - 22:00',
        'web' => 'https://restaurante-otraopcion.com',
        'servicios' => 'Espacios al aire libre, bebederos para mascotas'
    ],
    // Agrega más restaurantes aquí para probar la paginación
    // ...
];

// Simulando más restaurantes para probar la paginación
for ($i = 3; $i <= 15; $i++) {
    $restaurantes[] = [
        'id' => $i,
        'imagen' => '../assets/img/restaurante'.($i % 3 + 1).'.jpg',
        'nombre' => 'Restaurante '.$i,
        'descripcion' => 'Descripción del restaurante '.$i,
        'direccion' => 'Dirección '.$i,
        'horario' => 'Horario '.$i,
        'web' => 'https://restaurante'.$i.'.com',
        'servicios' => 'Servicios '.$i
    ];
}

// Cálculo para paginación
$total_restaurantes = count($restaurantes);
$total_paginas = ceil($total_restaurantes / $restaurantes_por_pagina);

// Obtener solo los restaurantes para la página actual
$restaurantes_pagina = array_slice($restaurantes, $inicio, $restaurantes_por_pagina);

include '../vistas/inc/header.php';
?>
<link href="../assets/css/bootstrap.min.css" rel="stylesheet">
<link href="../assets/css/index.css" rel="stylesheet">

<div class="container mt-5 mb-5">
    <h1 class="h1-Res text-center text-white mb-4">Restaurantes Pet Friendly</h1>
    
    <!-- Cambiado a una columna más estrecha -->
    <div class="row justify-content-center">
        <div class="col-lg-6 col-md-8 col-sm-10" id="restaurantes-acordeon">
            <?php foreach ($restaurantes_pagina as $restaurante): ?>
                <div class="card shadow mb-4 bg-light">
                    <div class="row g-0">
                        <div class="col-md-4">
                            <img src="<?php echo htmlspecialchars($restaurante['imagen']); ?>" 
                                class="img-fluid rounded-start h-100" 
                                alt="<?php echo htmlspecialchars($restaurante['nombre']); ?>"
                                style="object-fit: cover;">
                        </div>
                        <div class="col-md-8">
                            <div class="card-body text-center">
                                <h5 class="card-title"><?php echo htmlspecialchars($restaurante['nombre']); ?></h5>
                                <button class="btn btn2 mt-2" type="button" data-bs-toggle="collapse" 
                                        data-bs-target="#restaurante-<?php echo $restaurante['id']; ?>" 
                                        aria-expanded="false" aria-controls="restaurante-<?php echo $restaurante['id']; ?>">
                                    Ver más
                                </button>
                                <div class="collapse mt-3" id="restaurante-<?php echo $restaurante['id']; ?>" data-bs-parent="#restaurantes-acordeon">
                                    <p class="card-text"><?php echo htmlspecialchars($restaurante['descripcion']); ?></p>
                                    <p><strong>Dirección:</strong> <?php echo htmlspecialchars($restaurante['direccion']); ?></p>
                                    <p><strong>Horario:</strong> <?php echo htmlspecialchars($restaurante['horario']); ?></p>
                                    <p><strong>Servicios:</strong> <?php echo htmlspecialchars($restaurante['servicios']); ?></p>
                                    <a href="<?php echo htmlspecialchars($restaurante['web']); ?>" target="_blank" 
                                       class="btn btn-primary">Visitar web</a>
                                    <a href="agregar_favorito.php?tipo=restaurante&amp;nombre=<?php echo urlencode($restaurante['nombre']); ?>" 
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
        <nav aria-label="Paginación de restaurantes" class="mt-4">
            <ul class="pagination justify-content-center">
                <!-- Botón "Anterior" -->
                <li class="page-item <?php echo ($pagina_actual <= 1) ? 'disabled' : ''; ?>">
                    <a class="page-link" href="?pagina=<?php echo $pagina_actual - 1; ?>" aria-label="Anterior">
                        <span aria-hidden="true">&laquo;</span>
                    </a>
                </li>
                
                <!-- Números de página -->
                <?php for ($i = 1; $i <= $total_paginas; $i++): ?>
                    <li class="page-item <?php echo ($pagina_actual == $i) ? 'active' : ''; ?>">
                        <a class="page-link" href="?pagina=<?php echo $i; ?>"><?php echo $i; ?></a>
                    </li>
                <?php endfor; ?>
                
                <!-- Botón "Siguiente" -->
                <li class="page-item <?php echo ($pagina_actual >= $total_paginas) ? 'disabled' : ''; ?>">
                    <a class="page-link" href="?pagina=<?php echo $pagina_actual + 1; ?>" aria-label="Siguiente">
                        <span aria-hidden="true">&raquo;</span>
                    </a>
                </li>
            </ul>
        </nav>
    <?php endif; ?>
</div>

<?php include '../vistas/resenasRestaurantes.php'; ?>
<?php include '../vistas/inc/footer.php'; ?>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

<!-- Añadir este script para cambiar el texto del botón -->
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

