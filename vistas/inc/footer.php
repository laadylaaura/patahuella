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
                    <a href="#" class="text-white me-2"><i class="fab fa-facebook-f"></i></a>
                    <a href="#" class="text-white me-2"><i class="fab fa-twitter"></i></a>
                    <a href="#" class="text-white me-2"><i class="fab fa-instagram"></i></a>
                </div>
            </div>
            
            <!-- Enlaces rápidos -->
            <div class="col-6 col-md-2">
                <h6 class="mb-3">Explorar</h6>
                <ul class="list-unstyled">
                    <li><a href="../index.php" class="text-white-50">Inicio</a></li>
                    <li><a href="restaurantes.php" class="text-white-50">Restaurantes</a></li>
                    <li><a href="alojamientos.php" class="text-white-50">Alojamientos</a></li>
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
                <p class="text-white-50 mb-1"><i class="fas fa-phone me-2"></i> +34 123 456 789</p>
                <p class="text-white-50"><i class="fas fa-map-marker-alt me-2"></i> Calle Principal, 123, Barcelona</p>
            </div>
        </div>
        
        <!-- Línea separadora -->
        <hr class="my-4 bg-secondary">
        
        <!-- Copyright -->
        <div class="row">
            <div class="col-md-6 text-center text-md-start">
                <p class="mb-0">&copy; 2025 Pata y Huella. Todos los derechos reservados.</p>
            </div>
            <div class="col-md-6 text-center text-md-end mt-3 mt-md-0">
                <p class="mb-0">Diseñado <i class="fas fa-heart text-danger"></i> para mascotas y sus dueños</p>
            </div>
        </div>
    </div>
</footer>

<!-- Scripts de Bootstrap -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>