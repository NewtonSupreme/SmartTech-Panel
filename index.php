<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SmartTech - Innovación Tecnológica</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600;700&family=Orbitron:wght@500;700&display=swap" rel="stylesheet">
    <!-- Custom CSS -->
    <style>
        :root {
            --primary-color: #3a86ff;
            --secondary-color: #8338ec;
            --dark-color: #212529;
            --light-color: #f8f9fa;
            --gradient: linear-gradient(135deg, var(--primary-color), var(--secondary-color));
        }
        
        body {
            font-family: 'Poppins', sans-serif;
            background-color: #f5f7fa;
            color: var(--dark-color);
        }
        
        .navbar-brand {
            font-family: 'Orbitron', sans-serif;
            font-weight: 700;
            font-size: 1.8rem;
            background: var(--gradient);
            -webkit-background-clip: text;
            background-clip: text;
            color: transparent;
        }
        
        .hero-section {
            background: url('https://images.unsplash.com/photo-1518770660439-4636190af475?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1470&q=80') no-repeat center center;
            background-size: cover;
            height: 80vh;
            position: relative;
            display: flex;
            align-items: center;
            justify-content: center;
            text-align: center;
            color: white;
            margin-bottom: 4rem;
        }
        
        .hero-section::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.6);
        }
        
        .hero-content {
            position: relative;
            z-index: 1;
        }
        
        .hero-title {
            font-family: 'Orbitron', sans-serif;
            font-size: 3.5rem;
            font-weight: 700;
            margin-bottom: 1.5rem;
            text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.5);
        }
        
        .hero-subtitle {
            font-size: 1.5rem;
            margin-bottom: 2rem;
            max-width: 800px;
        }
        
        .btn-gradient {
            background: var(--gradient);
            border: none;
            color: white;
            padding: 12px 30px;
            border-radius: 50px;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 1px;
            transition: all 0.3s ease;
        }
        
        .btn-gradient:hover {
            transform: translateY(-3px);
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.2);
            color: white;
        }
        
        .section-title {
            font-family: 'Orbitron', sans-serif;
            font-weight: 700;
            margin-bottom: 3rem;
            position: relative;
            display: inline-block;
        }
        
        .section-title::after {
            content: '';
            position: absolute;
            bottom: -10px;
            left: 0;
            width: 50%;
            height: 4px;
            background: var(--gradient);
            border-radius: 2px;
        }
        
        .mission-vision-card {
            border: none;
            border-radius: 15px;
            overflow: hidden;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
            transition: all 0.3s ease;
            height: 100%;
        }
        
        .mission-vision-card:hover {
            transform: translateY(-10px);
            box-shadow: 0 15px 35px rgba(0, 0, 0, 0.15);
        }
        
        .card-icon {
            font-size: 3rem;
            margin-bottom: 1.5rem;
            background: var(--gradient);
            -webkit-background-clip: text;
            background-clip: text;
            color: transparent;
        }
        
        .contact-card {
            background: white;
            border-radius: 15px;
            padding: 2rem;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
            transition: all 0.3s ease;
        }
        
        .contact-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 15px 35px rgba(0, 0, 0, 0.15);
        }
        
        .contact-icon {
            font-size: 1.5rem;
            color: var(--primary-color);
            margin-right: 10px;
        }
        
        .tech-showcase {
            background-color: var(--dark-color);
            color: white;
            padding: 5rem 0;
            position: relative;
            overflow: hidden;
        }
        
        .tech-showcase::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: url('https://i1.adis.ws/i/canon/rf-135mm-f1.8l-is-usm_0f4a6908-16x9_95b8b15a1f0b4d528a2a042cadb2734c?$media-collection-full-dt$') no-repeat center center;
            background-size: cover;
            opacity: 0.2;
        }
        
        .tech-item {
            text-align: center;
            padding: 2rem;
            position: relative;
            z-index: 1;
        }
        
        .tech-icon {
            font-size: 3rem;
            margin-bottom: 1.5rem;
            color: var(--primary-color);
        }
        
        footer {
            background-color: var(--dark-color);
            color: white;
            padding: 3rem 0 1rem;
        }
        
        .footer-links a {
            color: #adb5bd;
            text-decoration: none;
            transition: color 0.3s ease;
        }
        
        .footer-links a:hover {
            color: white;
        }
        
        .social-icons a {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            width: 40px;
            height: 40px;
            border-radius: 50%;
            background: rgba(255, 255, 255, 0.1);
            color: white;
            margin-right: 10px;
            transition: all 0.3s ease;
        }
        
        .social-icons a:hover {
            background: var(--primary-color);
            transform: translateY(-3px);
        }
        
        .creator {
            border-top: 1px solid rgba(255, 255, 255, 0.1);
            padding-top: 1.5rem;
            margin-top: 2rem;
            text-align: center;
            font-size: 0.9rem;
            color: #adb5bd;
        }
        
        @media (max-width: 768px) {
            .hero-title {
                font-size: 2.5rem;
            }
            
            .hero-subtitle {
                font-size: 1.2rem;
            }
        }
    </style>
</head>
<body>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark sticky-top" style="background-color: #343a40;"> <!-- Color de fondo oscuro -->  
    <div class="container">  
        <a class="navbar-brand" href="index.php">SmartTech</a>  
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">  
            <span class="navbar-toggler-icon"></span>  
        </button>  
        <div class="collapse navbar-collapse" id="navbarNav">  
            <ul class="navbar-nav ms-auto">  
                <li class="nav-item">  
                    <a class="nav-link active" href="index.php">Inicio</a>  
                </li>  
                <li class="nav-item">  
                    <a class="nav-link" href="productos.php">Productos</a>  
                </li>  
                <li class="nav-item">  
                    <a class="nav-link" href="panel.php">Panel</a>  
                </li>  
                <li class="nav-item">  
                    <a class="nav-link" href="#contacto">Contacto</a>  
                </li>  
            </ul>  
        </div>  
    </div>  
</nav>  

    <!-- Hero Section -->
    <section class="hero-section">
        <div class="hero-content container">
            <h1 class="hero-title">Innovación Tecnológica para el Futuro</h1>
            <p class="hero-subtitle">En nuestra tienda, ofrecemos teléfonos, tablets y accesorios innovadores que transforman tu experiencia con la tecnología. Descubre un mundo de posibilidades con nuestros productos de última generación y servicios excepcionales.</p>
            <a href="#contacto" class="btn btn-gradient btn-lg">Contáctanos</a>
        </div>
    </section>

    <!-- Mission & Vision Section -->
    <section class="container my-5 py-5">
        <h2 class="text-center section-title">Nuestra Empresa</h2>
        <div class="row g-4">
            <div class="col-md-6">
                <div class="mission-vision-card p-5">
                    <div class="card-icon">
                        <i class="fas fa-bullseye"></i>
                    </div>
                    <h3>Misión</h3>
                    <p>Ofrecer una amplia gama de teléfonos, tablets y accesorios que mejoren la experiencia tecnológica de nuestros clientes, a través de productos innovadores y de alta calidad.</p>
                </div>
            </div>
            <div class="col-md-6">
                <div class="mission-vision-card p-5">
                    <div class="card-icon">
                        <i class="fas fa-eye"></i>
                    </div>
                    <h3>Visión</h3>
                    <p>Ser líderes en la venta de teléfonos, tablets y accesorios de última generación, reconocidos por nuestra capacidad de ofrecer productos innovadores, de calidad excepcional y un compromiso con la satisfacción del cliente, transformando la manera en que las personas disfrutan de su tecnología.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Tech Showcase -->
    <section class="tech-showcase">
        <div class="container">
            <h2 class="text-center section-title">Nuestras Especialidades</h2>
            <div class="row g-4">
                <div class="col-md-4">
                    <div class="tech-item">
                        <div class="tech-icon">
                            <i class="fas fa-robot"></i>
                        </div>
                        <h3>Teléfonos Inteligentes</h3>
                        <p>Ofrecemos teléfonos con tecnología de punta, diseñados para brindarte funciones avanzadas y una experiencia de usuario única.</p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="tech-item">
                        <div class="tech-icon">
                            <i class="fas fa-home"></i>
                        </div>
                        <h3>Tablets</h3>
                        <p>Convierte tu forma de trabajar y jugar con nuestras tablets potentes y versátiles, ideales para cualquier ocasión.</p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="tech-item">
                        <div class="tech-icon">
                            <i class="fas fa-mobile-alt"></i>
                        </div>
                        <h3>Accesorios</h3>
                        <p>Encuentra una amplia gama de accesorios, desde fundas hasta cargadores, que complementan y mejoran tu experiencia con nuestros dispositivos.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

<!-- Contact Section -->
<section id="contacto" class="container my-5 py-5">
    <h2 class="text-center section-title">Contáctanos</h2>
    <div class="row">
        <div class="col-lg-6 mb-4">
            <div class="contact-card h-100">
                <h3 class="mb-4">Información de Contacto</h3>
                <div class="mb-3">
                    <p><i class="fas fa-map-marker-alt contact-icon"></i> Caracas, Venezuela</p>
                </div>
                <div class="mb-3">
                    <p><i class="fas fa-phone contact-icon"></i> +58 414-227 97 08</p>
                </div>
                <div class="mb-3">
                    <p><i class="fas fa-envelope contact-icon"></i> info@smarttech.com</p>
                </div>
                <div class="mb-3">
                    <p><i class="fas fa-clock contact-icon"></i> Lunes a Viernes: 9:00 AM - 6:00 PM</p>
                </div>
                <div class="social-icons mt-4" style="background-color: #212529;">
                    <a href="#"><i class="fab fa-facebook-f"></i></a>
                    <a href="#"><i class="fab fa-twitter"></i></a>
                    <a href="#"><i class="fab fa-instagram"></i></a>
                    <a href="#"><i class="fab fa-linkedin-in"></i></a>
                </div>
            </div>
        </div>
        <div class="col-lg-6">
            <div class="contact-card h-100">
                <h3 class="mb-4">Envía un Mensaje</h3>
                <form id="contactForm">
                    <div class="mb-3">
                        <input type="text" class="form-control" id="nombre" name="nombre" placeholder="Nombre completo" required>
                    </div>
                    <div class="mb-3">
                        <input type="email" class="form-control" id="email" name="email" placeholder="Correo electrónico" required>
                    </div>
                    <div class="mb-3">
                        <input type="tel" class="form-control" id="telefono" name="telefono" placeholder="Teléfono">
                    </div>
                    <div class="mb-3">
                        <textarea class="form-control" id="mensaje" name="mensaje" rows="5" placeholder="Tu mensaje" required></textarea>
                    </div>
                    <button type="submit" class="btn btn-gradient w-100">Enviar Mensaje</button>
                </form>
            </div>
        </div>
    </div>
</section>

<!-- Añadir SweetAlert CDN en el head -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">

    <!-- Footer -->
    <footer>
        <div class="container">
            <div class="row">
                <div class="col-md-4 mb-4">
                    <h5 class="mb-4">SmartTech</h5>
                    <p>Líderes en innovación tecnológica, creando soluciones inteligentes para un futuro mejor.</p>
                </div>
                <div class="col-md-2 mb-4">
                    <h5 class="mb-4">Enlaces</h5>
                    <ul class="list-unstyled footer-links">
                        <li class="mb-2"><a href="index.php">Inicio</a></li>
                        <li class="mb-2"><a href="productos.php">Productos</a></li>
                        <li class="mb-2"><a href="panel.php">Panel</a></li>
                        <li class="mb-2"><a href="#contacto">Contacto</a></li>
                    </ul>
                </div>
                <div class="col-md-3 mb-4">
                    <h5 class="mb-4">Legal</h5>
                    <ul class="list-unstyled footer-links">
                        <li class="mb-2"><a href="#">Términos y condiciones</a></li>
                        <li class="mb-2"><a href="#">Política de privacidad</a></li>
                        <li class="mb-2"><a href="#">Cookies</a></li>
                    </ul>
                </div>
                <div class="col-md-3 mb-4">
                    <h5 class="mb-4">Suscríbete</h5>
                    <p>Recibe las últimas noticias y ofertas de SmartTech.</p>
                    <div class="input-group mb-3">
                        <input type="email" class="form-control" placeholder="Tu correo">
                        <button class="btn btn-primary" type="button">Enviar</button>
                    </div>
                </div>
            </div>
            <div class="creator">
                <p>Esta página ha sido realizada por Leandro Marquez</p>
            </div>
        </div>
    </footer>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <!-- Custom JS -->
 <!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<!-- SweetAlert JS -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<!-- Custom JS -->
<script>
    // Smooth scrolling for anchor links
    document.querySelectorAll('a[href^="#"]').forEach(anchor => {
        anchor.addEventListener('click', function (e) {
            e.preventDefault();
            
            document.querySelector(this.getAttribute('href')).scrollIntoView({
                behavior: 'smooth'
            });
        });
    });
    
    // Navbar background change on scroll
    window.addEventListener('scroll', function() {
        const navbar = document.querySelector('.navbar');
        if (window.scrollY > 50) {
            navbar.classList.add('bg-dark', 'shadow');
            navbar.classList.remove('navbar-dark');
        } else {
            navbar.classList.remove('bg-dark', 'shadow');
            navbar.classList.add('navbar-dark');
        }
    });

    // Formulario de contacto
    document.getElementById('contactForm').addEventListener('submit', function(e) {
        e.preventDefault();
        
        // Obtener los valores del formulario
        const nombre = document.getElementById('nombre').value;
        const email = document.getElementById('email').value;
        const telefono = document.getElementById('telefono').value;
        const mensaje = document.getElementById('mensaje').value;
        
        // Validación básica
        if (!nombre || !email || !mensaje) {
            Swal.fire({
                icon: 'error',
                title: 'Error',
                text: 'Por favor complete todos los campos requeridos',
                confirmButtonColor: '#3a86ff'
            });
            return;
        }
        
        // Simular envío del formulario (en un caso real aquí harías una petición AJAX)
        // Mostrar mensaje de éxito
        Swal.fire({
            icon: 'success',
            title: '¡Mensaje enviado!',
            text: 'Gracias por contactarnos, ' + nombre + '. Nos pondremos en contacto contigo pronto.',
            confirmButtonColor: '#3a86ff'
        }).then(() => {
            // Limpiar el formulario después de enviar
            document.getElementById('contactForm').reset();
        });
        
        // En un caso real, aquí iría la petición AJAX al servidor
        /*
        fetch('contacto.php', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
            },
            body: JSON.stringify({
                nombre: nombre,
                email: email,
                telefono: telefono,
                mensaje: mensaje
            })
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                Swal.fire({
                    icon: 'success',
                    title: '¡Mensaje enviado!',
                    text: 'Gracias por contactarnos, ' + nombre + '. Nos pondremos en contacto contigo pronto.',
                    confirmButtonColor: '#3a86ff'
                }).then(() => {
                    document.getElementById('contactForm').reset();
                });
            } else {
                Swal.fire({
                    icon: 'error',
                    title: 'Error',
                    text: 'Hubo un problema al enviar tu mensaje. Por favor intenta nuevamente.',
                    confirmButtonColor: '#3a86ff'
                });
            }
        })
        .catch(error => {
            Swal.fire({
                icon: 'error',
                title: 'Error',
                text: 'Hubo un problema al enviar tu mensaje. Por favor intenta nuevamente.',
                confirmButtonColor: '#3a86ff'
            });
        });
        */
    });
</script>