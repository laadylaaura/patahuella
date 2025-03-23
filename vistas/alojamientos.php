<?php
session_start();
include 'inc/header.php';

// Array de ejemplo para obtener la lista de alojamientos
$alojamientos = [
    [
        'id' => 1,
        'imagen' => '../assets/img/alojamiento1.jpg',
        'nombre' => 'Alojamiento Ejemplo 1',
        'descripcion' => 'Este alojamiento ofrece una experiencia única ideal para ti y tu mascota, con servicios pensados para la comodidad de ambos.',
        'direccion' => 'Calle Falsa 123, Ciudad',
        'horario' => 'Check-in: 14:00 - Check-out: 12:00',
        'web' => 'https://alojamiento-ejemplo.com',
        'servicios' => 'Servicio de limpieza, terraza, zona pet friendly'
    ],
    [
        'id' => 2,
        'imagen' => '../assets/img/alojamiento2.jpg',
        'nombre' => 'Alojamiento Ejemplo 2',
        'descripcion' => 'Este alojamiento ofrece una experiencia única ideal para ti y tu mascota, con servicios pensados para la comodidad de ambos.',
        'direccion' => 'Calle Falsa 123, Ciudad',
        'horario' => 'Check-in: 14:00 - Check-out: 12:00',
        'web' => 'https://alojamiento-ejemplo.com',
        'servicios' => 'Servicio de limpieza, terraza, zona pet friendly'
    ],
    [
        'id' => 3,
        'imagen' => '../assets/img/alojamiento3.jpg',
        'nombre' => 'Alojamiento Ejemplo 3',
        'descripcion' => 'Este alojamiento ofrece una experiencia única ideal para ti y tu mascota, con servicios pensados para la comodidad de ambos.',
        'direccion' => 'Calle Falsa 123, Ciudad',
        'horario' => 'Check-in: 14:00 - Check-out: 12:00',
        'web' => 'https://alojamiento-ejemplo.com',
        'servicios' => 'Servicio de limpieza, terraza, zona pet friendly'
    ],
];
?>
<link href="../assets/css/bootstrap.min.css" rel="stylesheet">
<link href="../assets/css/index.css" rel="stylesheet">

<div class="container mt-5 mb-5">
    <h1 class="h1-Alo text-center text-white mb-4">Alojamientos Pet Friendly</h1>
    <div class="row justify-content-center">
        <div class="col-lg-6 col-md-8 col-sm-10" id="alojamientos-acordeon">
            <?php foreach ($alojamientos as $alojamiento): ?>
                <div class="card shadow mb-4 bg-light">
                    <div class="row g-0">
                        <div class="col-md-4">
                            <img src="<?php echo htmlspecialchars($alojamiento['imagen']); ?>" 
                                class="img-fluid rounded-start h-100" 
                                alt="<?php echo htmlspecialchars($alojamiento['nombre']); ?>"
                                style="object-fit: cover;">
                        </div>
                        <div class="col-md-8">
                            <div class="card-body text-center">
                                <h5 class="card-title"><?php echo htmlspecialchars($alojamiento['nombre']); ?></h5>
                                <button class="btn btn2 mt-2" type="button" data-bs-toggle="collapse" 
                                        data-bs-target="#alojamiento-<?php echo $alojamiento['id']; ?>" 
                                        aria-expanded="false" aria-controls="alojamiento-<?php echo $alojamiento['id']; ?>">
                                    Ver más
                                </button>
                                <div class="collapse mt-3" id="alojamiento-<?php echo $alojamiento['id']; ?>" data-bs-parent="#alojamientos-acordeon">
                                    <p class="card-text"><?php echo htmlspecialchars($alojamiento['descripcion']); ?></p>
                                    <p><strong>Dirección:</strong> <?php echo htmlspecialchars($alojamiento['direccion']); ?></p>
                                    <p><strong>Horario:</strong> <?php echo htmlspecialchars($alojamiento['horario']); ?></p>
                                    <p><strong>Servicios:</strong> <?php echo htmlspecialchars($alojamiento['servicios']); ?></p>
                                    <a href="<?php echo htmlspecialchars($alojamiento['web']); ?>" target="_blank" 
                                       class="btn btn-primary">Visitar web</a>
                                    <a href="<?php echo $ruta; ?>usuario/agregarFavorito?tipo=alojamiento&amp;id=<?php echo urlencode($alojamiento['id']); ?>" 
                                       class="btn btn2 ms-2">Agregar a Favoritos</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</div>

<?php include '../vistas/resenasAlojamientos.php'; ?>
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