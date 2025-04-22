<?php
require 'conexion.php';

$conexion = new Conexion();
$pdo = $conexion->getPDO();

// Obtener productos ordenados por fecha de registro (más nuevos primero)
$stmt = $pdo->query("SELECT * FROM productos ORDER BY fecha_registro DESC");
$productos = $stmt->fetchAll();

// Obtener categorías únicas para el filtro
$categorias = array_unique(array_column($productos, 'categoria'));
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Productos SmartTech</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        :root {
            ---primary-color: #3a86ff;
            --secondary-color: #8338ec;
            ---gradient: linear-gradient(135deg, var(---primary-color), var(--secondary-color));
            --primary: #2A2A72;
            --secondary: #009FFD;
            --gradient: linear-gradient(45deg, var(---primary), var(--secondary));
            --dark-color: #212529;
        }

        .navbar-brand {
            font-family: 'Orbitron', sans-serif;
            font-weight: 700;
            font-size: 1.8rem;
            background: var(---gradient);
            -webkit-background-clip: text;
            background-clip: text;
            color: transparent;
        }
        
        
        body {
            font-family: 'Poppins', sans-serif;
            background-color: #f5f7fa;
            color: var(--dark-color);
        }

        .hero-section {
            background: var(--gradient);
            height: 300px;
            color: black;
        }
        
        .product-card {
            transition: all 0.3s;
            border: none;
            border-radius: 15px;
            overflow: hidden;
            box-shadow: 0 5px 15px rgba(0,0,0,0.1);
            height: 100%;
        }
        
        .product-card:hover {
            transform: translateY(-10px);
            box-shadow: 0 15px 30px rgba(0,0,0,0.2);
        }
        
        .product-icon {
            font-size: 3rem;
            margin-bottom: 15px;
            color: var(--primary);
        }
        
        .category-badge {
            position: absolute;
            top: 15px;
            right: 15px;
        }
        
        .price-tag {
            font-size: 1.25rem;
            font-weight: 600;
            color: var(--primary);
        }
        
        .stock-badge {
            font-size: 0.85rem;
        }
        
        .in-stock {
            color: #28a745;
        }
        
        .low-stock {
            color: #dc3545;
        }
        
        .filter-container {
            background: white;
            border-radius: 10px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.05);
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

        .creator {
            border-top: 1px solid rgba(255, 255, 255, 0.1);
            padding-top: 1.5rem;
            margin-top: 2rem;
            text-align: center;
            font-size: 0.9rem;
            color: #adb5bd;
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
                    <a class="nav-link" href="index.php">Inicio</a>  
                </li>  
                <li class="nav-item">  
                    <a class="nav-link active" href="productos.php">Productos</a>  
                </li>  
                <li class="nav-item">  
                    <a class="nav-link" href="panel.php">Panel</a>  
                </li>    
            </ul>  
        </div>  
    </div>  
</nav>  

    <!-- Hero Section -->
    <section class="hero-section d-flex align-items-center">
        <div class="container text-center">
            <h1 class="display-5 fw-bold mb-3">Nuestros Productos</h1>
            <p class="lead">Tecnología de última generación para ti</p>
        </div>
    </section>

    <!-- Filtros -->
    <div class="container my-5">
        <div class="filter-container p-4">
            <div class="row g-3">
                <div class="col-md-6">
                    <input type="text" id="searchInput" class="form-control" placeholder="Buscar productos...">
                </div>
                <div class="col-md-6">
                    <select class="form-select" id="categoryFilter">
                        <option value="">Todas las categorías</option>
                        <?php foreach($categorias as $cat): ?>
                            <option value="<?= htmlspecialchars($cat) ?>"><?= htmlspecialchars($cat) ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
            </div>
        </div>
    </div>

    <!-- Listado de Productos -->
    <div class="container mb-5">
        <div class="row row-cols-1 row-cols-md-2 row-cols-lg-3 g-4">
            <?php if(count($productos) > 0): ?>
                <?php foreach($productos as $producto): ?>
                    <div class="col">
                        <div class="card product-card h-100">
                            <div class="card-body text-center p-4">
                                <!-- Icono según categoría -->
                                <?php 
                                $icono = match($producto['categoria']) {
                                    'Teléfonos' => 'fa-mobile-screen',
                                    'Tablets' => 'fa-tablet-screen-button',
                                    'Relojes' => 'fa-clock',
                                    'Accesorios' => 'fa-headphones',
                                    default => 'fa-box'
                                };
                                ?>
                                <i class="fas <?= $icono ?> product-icon"></i>
                                
                                <span class="badge bg-primary category-badge"><?= htmlspecialchars($producto['categoria']) ?></span>
                                
                                <h5 class="card-title"><?= htmlspecialchars($producto['nombre']) ?></h5>
                                
                                <div class="d-flex justify-content-between align-items-center my-3">
                                    <span class="price-tag">$<?= number_format($producto['precio'], 2) ?></span>
                                    <span class="stock-badge <?= $producto['cantidad'] > 10 ? 'in-stock' : 'low-stock' ?>">
                                        <i class="fas <?= $producto['cantidad'] > 10 ? 'fa-check-circle' : 'fa-exclamation-triangle' ?> me-1"></i>
                                        <?= $producto['cantidad'] > 10 ? 'Disponible' : 'Últimas unidades' ?>
                                    </span>
                                </div>
                                
                                <p class="text-muted small mb-0">
                                    <i class="far fa-calendar-alt me-1"></i>
                                    Agregado el <?= date('d/m/Y', strtotime($producto['fecha_registro'])) ?>
                                </p>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php else: ?>
                <div class="col-12 text-center py-5">
                    <div class="alert alert-info">
                        <i class="fas fa-info-circle me-2"></i>
                        No hay productos disponibles actualmente
                    </div>
                </div>
            <?php endif; ?>
        </div>
    </div>

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

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // Filtrado de productos
        document.addEventListener('DOMContentLoaded', function() {
            const searchInput = document.getElementById('searchInput');
            const categoryFilter = document.getElementById('categoryFilter');
            const productCards = document.querySelectorAll('.col');
            
            function filterProducts() {
                const searchTerm = searchInput.value.toLowerCase();
                const selectedCategory = categoryFilter.value.toLowerCase();
                
                productCards.forEach(card => {
                    const title = card.querySelector('.card-title').textContent.toLowerCase();
                    const category = card.querySelector('.badge').textContent.toLowerCase();
                    const matchesSearch = title.includes(searchTerm);
                    const matchesCategory = selectedCategory === '' || category === selectedCategory;
                    
                    card.style.display = (matchesSearch && matchesCategory) ? 'block' : 'none';
                });
            }
            
            searchInput.addEventListener('input', filterProducts);
            categoryFilter.addEventListener('change', filterProducts);
        });
    </script>
</body>
</html>