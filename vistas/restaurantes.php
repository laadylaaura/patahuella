<?php
require_once '../controladores/negocioControlador.php';

// Configuración de paginación
$restaurantes_por_pagina = 6;
$pagina_actual = isset($_GET['pagina']) ? (int)$_GET['pagina'] : 1;
$inicio = ($pagina_actual - 1) * $restaurantes_por_pagina;

// Instanciar el controlador
$controlador = new NegocioControlador();

// Obtener los restaurantes desde la base de datos
$data = $controlador->listarPorTipo("restaurante");

// Verificar si hay errores
if (isset($data["error"])) {
    echo "<p>Error: " . $data["error"] . "</p>";
    exit;
}

// Obtener los restaurantes
$restaurantes = $data["negocios"] ?? [];
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
    
    <div class="row justify-content-center">
        <div class="col-lg-6 col-md-8 col-sm-10" id="restaurantes-acordeon">
            <?php foreach ($restaurantes_pagina as $restaurante): ?>
                <div class="card shadow mb-4 bg-light">
                    <div class="row g-0">
                        <div class="col-md-4">
                            <!-- Mostrar la primera imagen del restaurante -->
                            <?php if (!empty($restaurante['imagenes'])): ?>
                                <img src="<?php echo htmlspecialchars('../assets/imagenesNegocio/' . $restaurante['imagenes'][0]['ruta_imagen']); ?>" 
                                    class="img-fluid rounded-start h-100" 
                                    alt="<?php echo htmlspecialchars($restaurante['nombre']); ?>"
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
                                <h5 class="card-title"><?php echo htmlspecialchars($restaurante['nombre']); ?></h5>
                                <p class="card-text"><?php echo htmlspecialchars($restaurante['descripcion']); ?></p>
                                <p><strong>Dirección:</strong> <?php echo htmlspecialchars($restaurante['direccion']); ?></p>
                                <p><strong>Teléfono:</strong> <?php echo htmlspecialchars($restaurante['telefono']); ?></p>
                                <a href="<?php echo htmlspecialchars($restaurante['url']); ?>" target="_blank" 
                                   class="btn btn-primary">Visitar web</a>
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

<?php include '../vistas/inc/footer.php'; ?>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

