<?php

function conectarBD() {
    $servidor = "localhost";
    $usuario = "root";
    $password = "";
    $basedatos = "patayhuella";

    $conexion = new mysqli($servidor, $usuario, $password, $basedatos);
    if ($conexion->connect_error) {
        die("Conexión fallida: " . $conexion->connect_error);
    }
    return $conexion;
}

// Datos simulados para restaurantes más visitados
// $restaurantesPopulares = [
//     [
//         'id' => 1,
//         'nombre' => 'La Terraza Canina',
//         'descripcion' => 'Restaurante con amplia terraza donde tu mascota puede disfrutar mientras comes.',
//         'direccion' => 'Calle Valencia 234, Barcelona',
//         'imagen' => '../assets/imagenesNegocio/restaurante1.jpg',
//         'visitas' => 1280,
//         'rating' => 4.7
//     ],
//     [
//         'id' => 2,
//         'nombre' => 'El Rincón Perruno',
//         'descripcion' => 'Cafetería especializada en desayunos y brunches con área especial para mascotas.',
//         'direccion' => 'Rambla Catalunya 45, Barcelona',
//         'imagen' => '../assets/imagenesNegocio/restaurante2.jpg',
//         'visitas' => 950,
//         'rating' => 4.5
//     ],
//     [
//         'id' => 3,
//         'nombre' => 'Pata y Mesa',
//         'descripcion' => 'Restaurante mediterráneo con menú especial para perros y gatos.',
//         'direccion' => 'Passeig de Gràcia 78, Barcelona',
//         'imagen' => '../assets/imagenesNegocio/restaurante3.jpg',
//         'visitas' => 820,
//         'rating' => 4.3
//     ]
// ];

// Datos simulados para alojamientos más visitados
// $alojamientosPopulares = [
//     [
//         'id' => 1,
//         'nombre' => 'Hotel Patas Arriba',
//         'descripcion' => 'Hotel boutique que ofrece camas especiales para mascotas y servicio de paseo.',
//         'direccion' => 'Carrer de Mallorca 456, Barcelona',
//         'imagen' => '../assets/imagenesNegocio/alojamiento1.jpg',
//         'visitas' => 840,
//         'rating' => 4.8
//     ],
//     [
//         'id' => 2,
//         'nombre' => 'Apartamentos Can Guau',
//         'descripcion' => 'Apartamentos equipados con todo lo necesario para ti y tu mascota.',
//         'direccion' => 'Avinguda Diagonal 123, Barcelona',
//         'imagen' => '../assets/imagenesNegocio/alojamiento2.jpg',
//         'visitas' => 760,
//         'rating' => 4.6
//     ],
//     [
//         'id' => 3,
//         'nombre' => 'Hostal Animal Friendly',
//         'descripcion' => 'Alojamiento económico con zonas comunes para mascotas y jardín.',
//         'direccion' => 'Carrer d\'Aragó 789, Barcelona',
//         'imagen' => '../assets/imagenesNegocio/alojamiento3.jpg',
//         'visitas' => 650,
//         'rating' => 4.4
//     ]
// ];

// Datos simulados para reseñas mejor valoradas
// $mejoresResenas = [
//     [
//         'id' => 1,
//         'usuario' => 'Laura Martínez',
//         'lugar' => 'Hotel Patas Arriba',
//         'tipo' => 'alojamiento',
//         'comentario' => '¡Increíble experiencia! Mi perro Toby fue tratado como un rey. Las camas para mascotas son muy cómodas y el servicio de paseo es excelente.',
//         'calificacion' => 5.0,
//         'fecha' => '2023-03-15'
//     ],
//     [
//         'id' => 2,
//         'usuario' => 'Marcos Rodríguez',
//         'lugar' => 'La Terraza Canina',
//         'tipo' => 'restaurante',
//         'comentario' => 'Comida exquisita y un espacio perfecto para mi bulldog francés. El personal muy atento con los animales.',
//         'calificacion' => 4.9,
//         'fecha' => '2023-04-02'
//     ],
//     [
//         'id' => 3,
//         'usuario' => 'Sara López',
//         'lugar' => 'Apartamentos Can Guau',
//         'tipo' => 'alojamiento',
//         'comentario' => 'Los apartamentos están perfectamente equipados para mascotas. Tienen comederos, juguetes e incluso una pequeña cama. ¡Volveremos!',
//         'calificacion' => 4.9,
//         'fecha' => '2023-02-28'
//     ]
// ];


// Código para cuando la base de datos esté disponible
function obtenerRestaurantesPopulares($conexion) {
    $sql = "SELECT n.*, i.ruta_imagen, AVG(r.puntuacion) as rating, COUNT(r.id_resena) as visitas
            FROM Negocios n
            LEFT JOIN ImagenesNegocios i ON n.id_negocio = i.id_negocio AND i.num_imagen = 1
            LEFT JOIN Resenas r ON n.id_negocio = r.id_negocio
            WHERE n.tipo_negocio = 'restaurante' AND n.activo = 1
            GROUP BY n.id_negocio
            ORDER BY visitas DESC
            LIMIT 3";
    $resultado = $conexion->query($sql);
    $restaurantes = [];
    if ($resultado->num_rows > 0) {
        while($fila = $resultado->fetch_assoc()) {
            $ruta_imagen = isset($fila['ruta_imagen']) && !empty($fila['ruta_imagen']) 
                ? './assets/imagenesNegocio/' . $fila['ruta_imagen']
                : './assets/imagenesNegocio/default.jpg';
                
            $restaurantes[] = [
                'id' => $fila['id_negocio'],
                'nombre' => $fila['nombre'],
                'descripcion' => $fila['descripcion'],
                'url' => $fila['url'],
                'direccion' => $fila['direccion'],
                'imagen' => $ruta_imagen,
                'visitas' => $fila['visitas'] ?? 0,
                'rating' => $fila['rating'] ?? 0
            ];
        }
    }
    return $restaurantes;
}

function obtenerAlojamientosPopulares($conexion) {
    $sql = "SELECT n.*, i.ruta_imagen, AVG(r.puntuacion) as rating, COUNT(r.id_resena) as visitas
            FROM Negocios n
            LEFT JOIN ImagenesNegocios i ON n.id_negocio = i.id_negocio AND i.num_imagen = 1
            LEFT JOIN Resenas r ON n.id_negocio = r.id_negocio
            WHERE n.tipo_negocio = 'hotel' AND n.activo = 1
            GROUP BY n.id_negocio
            ORDER BY visitas DESC
            LIMIT 3";
    $resultado = $conexion->query($sql);
    $alojamientos = [];
    if ($resultado->num_rows > 0) {
        while($fila = $resultado->fetch_assoc()) {
            $ruta_imagen = isset($fila['ruta_imagen']) && !empty($fila['ruta_imagen']) 
                ? './assets/imagenesNegocio/' . $fila['ruta_imagen']
                : './assets/imagenesNegocio/default.jpg';
                
            $alojamientos[] = [
                'id' => $fila['id_negocio'],
                'nombre' => $fila['nombre'],
                'descripcion' => $fila['descripcion'],
                'direccion' => $fila['direccion'],
                'url' => $fila['url'],
                'imagen' => $ruta_imagen,
                'visitas' => $fila['visitas'] ?? 0,
                'rating' => $fila['rating'] ?? 0
            ];
        }
    }
    return $alojamientos;
}

function obtenerMejoresResenas($conexion) {
    $sql = "SELECT r.*, n.nombre as lugar, n.tipo_negocio as tipo, u.nombre as usuario
            FROM Resenas r
            JOIN Negocios n ON r.id_negocio = n.id_negocio
            JOIN Usuarios u ON r.id_usuario = u.id_usuario
            WHERE n.activo = 1
            ORDER BY r.puntuacion DESC, r.fecha_publicacion DESC
            LIMIT 3";
    $resultado = $conexion->query($sql);
    $resenas = [];
    if ($resultado->num_rows > 0) {
        while($fila = $resultado->fetch_assoc()) {
            $resenas[] = [
                'id' => $fila['id_resena'],
                'usuario' => $fila['usuario'],
                'lugar' => $fila['lugar'],
                'tipo' => $fila['tipo'],
                'comentario' => $fila['comentario'],
                'calificacion' => $fila['puntuacion'],
                'fecha' => $fila['fecha_publicacion']
            ];
        }
    }
    return $resenas;
}

// Obtener datos cuando la BD esté disponible
$conexion = conectarBD();
$restaurantesPopulares = obtenerRestaurantesPopulares($conexion);
$alojamientosPopulares = obtenerAlojamientosPopulares($conexion);
$mejoresResenas = obtenerMejoresResenas($conexion);
$conexion->close();

?>

<div class="container mt-5">
    <!-- Restaurantes más visitados -->
    <section class="mb-5">
        <h2 class="text-center mb-4 text-white ">Restaurantes más populares</h2>
        <div class="row">
            <?php foreach ($restaurantesPopulares as $restaurante): ?>
                <div class="col-md-4 mb-4">
                    <div class="card h-100 bg-white">
                        <img src="<?php echo htmlspecialchars($restaurante['imagen']); ?>" class="card-img-top" alt="<?php echo htmlspecialchars($restaurante['nombre']); ?>">
                        <div class="card-body">
                            <h5 class="card-title"><?php echo htmlspecialchars($restaurante['nombre']); ?></h5>
                            <p class="card-text"><?php echo htmlspecialchars($restaurante['descripcion']); ?></p>
                            <p><strong>Dirección:</strong> <?php echo htmlspecialchars($restaurante['direccion']); ?></p>
                            <div class="d-flex justify-content-between align-items-center">
                                <span class="badge bg-primary"><?php echo number_format($restaurante['visitas']); ?> visitas</span>
                                <span class="badge bg-warning text-dark"><?php echo number_format($restaurante['rating'], 1); ?> ★</span>
                            </div>
                        </div>
                        <div class="card-footer">
                            <?php if (isset($restaurante['url']) && !empty($restaurante['url'])): ?>
                                <a href="<?php echo htmlspecialchars($restaurante['url']); ?>" target="_blank" class="btn btn-primary">Visitar web</a>
                            <?php else: ?>
                                <a href="<?php echo $ruta; ?>vistas/error404.php" class="btn btn-warning">Sitio no disponible</a>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </section>

    <!-- Alojamientos más visitados -->
    <section class="mb-5">
        <h2 class="text-center mb-4 text-white ">Alojamientos más populares</h2>
        <div class="row">
            <?php foreach ($alojamientosPopulares as $alojamiento): ?>
                <div class="col-md-4 mb-4">
                    <div class="card h-100 bg-blue">
                        <img src="<?php echo htmlspecialchars($alojamiento['imagen']); ?>" class="card-img-top" alt="<?php echo htmlspecialchars($alojamiento['nombre']); ?>">
                        <div class="card-body">
                            <h5 class="card-title"><?php echo htmlspecialchars($alojamiento['nombre']); ?></h5>
                            <p class="card-text"><?php echo htmlspecialchars($alojamiento['descripcion']); ?></p>
                            <p><strong>Dirección:</strong> <?php echo htmlspecialchars($alojamiento['direccion']); ?></p>
                            <div class="d-flex justify-content-between align-items-center">
                                <span class="badge bg-primary"><?php echo number_format($alojamiento['visitas']); ?> visitas</span>
                                <span class="badge bg-warning text-dark"><?php echo number_format($alojamiento['rating'], 1); ?> ★</span>
                            </div>
                        </div>
                        <div class="card-footer">
                            <?php if (isset($alojamiento['url']) && !empty($alojamiento['url'])): ?>
                                <a href="<?php echo htmlspecialchars($alojamiento['url']); ?>" target="_blank" class="btn btn-primary">Visitar web</a>
                            <?php else: ?>
                                <a href="<?php echo $ruta; ?>vistas/error404.php" class="btn btn-warning">Sitio no disponible</a>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </section>

    <!-- Reseñas mejor valoradas -->
    <!-- <section class="mb-5">
        <h2 class="text-center mb-4 text-white text-decoration-underline">Últimas reseñas destacadas</h2>
        <div class="row">
            <?php foreach ($mejoresResenas as $resena): ?>
                <div class="col-md-4 mb-4">
                    <div class="card h-100 bg-white">
                        <div class="card-header">
                            <h5 class="card-title"><?php echo htmlspecialchars($resena['lugar']); ?></h5>
                            <small class="text-muted"><?php echo ucfirst(htmlspecialchars($resena['tipo'])); ?></small>
                        </div>
                        <div class="card-body">
                            <div class="mb-2">
                                <span class="badge bg-warning text-dark"><?php echo number_format($resena['calificacion'], 1); ?> ★</span>
                                <small class="text-muted"><?php echo date('d/m/Y', strtotime($resena['fecha'])); ?></small>
                            </div>
                            <p class="card-text">"<?php echo htmlspecialchars($resena['comentario']); ?>"</p>
                            <footer class="blockquote-footer">
                                <?php echo htmlspecialchars($resena['usuario']); ?>
                            </footer>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </section> -->
</div>

