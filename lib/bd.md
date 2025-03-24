use patayhuella;
INSERT INTO negocios (
   id_negocio,
   nombre,
   tipo_negocio,
   ciudad,
   direccion,
   telefono,
   descripcion,
   url,
   fecha_registro,
   activo
) VALUES (
   NULL,
   'Artéteca Pizzeria Napolitana',
   'restaurante',
   'Barcelona',
   'C/ de Lepant, 255, 08013 Barcelona Spain',
   '+34 931 69 37 42',
   'Pizzería napolitana auténtica con pizzas de masa ligera y ingredientes de alta calidad. Ofrece opciones vegetarianas y veganas. Ambiente acogedor y servicio profesional.',
   'https://artetecapizzeria.com/',
   '2025-03-11',
   1
);


Lo mismo para las 4


INSERT INTO ImagenesNegocios (
   id_negocio,
   ruta_imagen,
   descripcion,
   num_imagen
) VALUES (
   1,
   'artecaPizzeria1.jpg', -- URL de la imagen
   'Vista de una pizza auténtica en Artéteca', -- Descripción opcional
   1 -- Primera imagen
);


// prueba insercion hotel:

INSERT INTO `Negocios`(`id_negocio`, `nombre`, `tipo_negocio`, `ciudad`, `direccion`, `telefono`, `descripcion`, `url`, `fecha_registro`, `activo`) 
VALUES 
(NULL, 'INNSiDE by Meliá Barcelona Apolo', 'hotel', 'Barcelona', 'Avenida del Paralelo 57-59, 08004 Barcelona España', '910 75 38 01', 'Inmerso en la Avenida del Paral·lel de Barcelona, nuestro hotel es la parada ideal para sentir el ambiente más cultural y artístico de la Ciudad Condal. Un hotel moderno y multifuncional desde donde visitar Las Ramblas, el puerto y la Fira, trabajar de manera diferente o crear los mejores eventos de Barcelona. Sube a nuestra terraza al aire libre con encanto y disfruta de las noches de verano. Vive un hotel urbano y dog-friendly en pleno centro de Barcelona, con una decoración vanguardista y repleto de espacios versátiles que se adaptan a tu forma de viajar. Dispondrás de un gimnasio 24h abierto, una terraza interior al aire libre para saborear lo que más te apetezca y habitaciones realmente cómodas, insonorizadas al completo y con tecnología Chromecast para hacerlo todo aún más fácil. Un mundo de atenciones de lo más sostenibles para sacarte una sonrisa. Conoce INNSiDE Barcelona Apolo. Sin duda, querrás quedarte.', 'https://www.melia.com/es/hoteles/espana/barcelona/innside-barcelona-apolo?ectrans=1&utm_campaign=businessadvantage_ficha&utm_medium=textlink&utm_source=tripadvisor&utm_content=0804&refid=83715d85-550a-4171-ba9a-4b3bca7ff947', CURRENT_DATE(), 1)

//Pruba insercion reseña
INSERT INTO `Resenas` (`id_resena`, `id_usuario`, `id_negocio`, `puntuacion`, `comentario`, `fecha_publicacion`) 
VALUES (NULL, '2', '2', '4', 'Excelente servicio, la comida estaba deliciosa y el personal muy amable. Definitivamente regresaré.', '2025-03-16')