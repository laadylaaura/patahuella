</div> <!-- Cierre del div content-wrapper -->
    <!-- Contenido del footer -->
    <footer class="bg-black text-white py-4 mt-5">
    <div class="container">
        <div class="row gy-4">
            <!-- Logo y descripción -->
            <div class="col-12 col-md-4">
                <h5>Pata y Huella</h5>
                <p class="text-white-50">Tu guía pet friendly para encontrar los mejores lugares donde disfrutar con tu mascota.</p>
                <div class="social-icons">
                    <a href="https://facebook.com/patayhuella" target="_blank" class="text-white me-2"><i class="fab fa-facebook-f"></i></a>
                    <a href="https://twitter.com/patayhuella" target="_blank" class="text-white me-2"><i class="fab fa-twitter"></i></a>
                    <a href="https://instagram.com/patayhuella" target="_blank" class="text-white me-2"><i class="fab fa-instagram"></i></a>
                </div>
            </div>
            
            <!-- Enlaces rápidos -->
            <div class="col-6 col-md-2">
                <h6 class="mb-3">Enlaces rápidos</h6>
                <ul class="list-unstyled">
                    <li><a href="<?php echo $ruta; ?>" class="text-white-50 text-decoration-none">Inicio</a></li>
                    <li><a href="<?php echo $ruta; ?>vistas/alojamientos.php" class="text-white-50 text-decoration-none">Alojamientos</a></li>
                    <li><a href="<?php echo $ruta; ?>vistas/restaurantes.php" class="text-white-50 text-decoration-none">Restaurantes</a></li>
                    <?php if ($usuarioLogueado): ?>
                        <li><a href="<?php echo $ruta; ?>usuario/perfil" class="text-white-50 text-decoration-none">Mi perfil</a></li>
                    <?php else: ?>
                        <li><a href="<?php echo $ruta; ?>inicio/sesionLogin" class="text-white-50 text-decoration-none">Iniciar sesión</a></li>
                    <?php endif; ?>
                </ul>
            </div>
            
            <!-- Información legal -->
            <div class="col-6 col-md-2">
                <h6 class="mb-3">Legal</h6>
                <ul class="list-unstyled">
                    <li><a href="#" class="text-white-50">Términos de uso</a></li>
                    <li><a href="#" class="text-white-50">Política de privacidad</a></li>
                </ul>
            </div>
            
            <!-- Contacto -->
            <div class="col-12 col-md-4">
                <h6 class="mb-3"><a href="<?php echo $ruta; ?>vistas/contacto.php" class="text-white text-decoration-none">Contacto</a></h6>
                <p class="text-white-50 mb-1"><i class="fas fa-envelope me-2"></i> <a href="mailto:info@patayhuella.com" class="text-white-50">info@patayhuella.com</a></p>
                <p class="text-white-50 mb-1"><i class="fas fa-phone me-2"></i> <a href="tel:+34123456789" class="text-white-50">+34 123 456 789</a></p>
                <p class="text-white-50"><i class="fas fa-map-marker-alt me-2"></i> <a href="https://maps.google.com/?q=Calle+Principal+123+Barcelona" target="_blank" class="text-white-50">Calle Principal, 123, Barcelona</a></p>
            </div>
        </div>
        
    
        
        <!-- Copyright -->
        <div class="row">
            <div class="col-md-6 text-center text-md-start">
                <p class="mb-0">&copy; 2025 Pata y Huella. Todos los derechos reservados.</p>
            </div>
        </div>
    </div>
</footer>

<!-- Scripts de Bootstrap -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>