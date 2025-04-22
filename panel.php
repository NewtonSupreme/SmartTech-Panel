<?php
// Función para obtener el saludo según la hora de Venezuela
function obtenerSaludo() {
    // Establecer la zona horaria de Venezuela
    date_default_timezone_set('America/Caracas');
    // Obtener la hora actual en formato 24 horas
    $hora = date('H');
    
    // Retornar un saludo diferente según la hora del día
    return match(true) {
        $hora >= 5 && $hora < 12 => '🌞 Buenos días',    // Mañana: 5:00 am - 11:59 am
        $hora >= 12 && $hora < 19 => '🌤️ Buenas tardes', // Tarde: 12:00 pm - 6:59 pm
        default => '🌙 Buenas noches'                    // Noche: 7:00 pm - 4:59 am
    };
}

// Determinar la sección actual a partir del parámetro GET 'section'
// Si no existe, usar 'inventario' como valor por defecto
$currentSection = $_GET['section'] ?? 'inventario';
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SmartTech - Panel de Control</title>
    <!-- Incluir Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Incluir Font Awesome para iconos -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        /* Variables CSS personalizadas */
        :root {
            --primary: #2A2A72;       /* Color primario azul oscuro */
            --secondary: #009FFD;     /* Color secundario azul claro */
            --gradient: linear-gradient(45deg, var(--primary), var(--secondary)); /* Degradado */
            --shadow: 0 4px 6px rgba(0, 0, 0, 0.1); /* Sombra predeterminada */
        }
        
        /* Estilos generales del cuerpo */
        body {
            background-color: #f8f9fa; /* Color de fondo claro */
            min-height: 100vh;         /* Altura mínima de toda la ventana */
        }
        
        /* Estilos para la barra lateral */
        .sidebar {
            width: 280px;              /* Ancho fijo */
            background: var(--primary); /* Color de fondo */
            color: white;              /* Texto blanco */
            position: fixed;           /* Posición fija */
            height: 100vh;             /* Altura completa */
            transition: all 0.3s;      /* Transición suave */
            z-index: 1000;             /* Capa superior */
        }
        
        /* Estilos para el contenido principal */
        .main-content {
            margin-left: 280px;        /* Margen para la barra lateral */
            transition: all 0.3s;      /* Transición suave */
        }
        
        /* Estilos para las tarjetas de estadísticas */
        .stat-card {
            background: white;         /* Fondo blanco */
            border-radius: 15px;       /* Bordes redondeados */
            box-shadow: var(--shadow); /* Sombra */
            transition: transform 0.3s; /* Efecto hover */
        }
        
        /* Efecto hover para tarjetas */
        .stat-card:hover {
            transform: translateY(-5px); /* Levantar ligeramente */
        }
        
        /* Estilos para tablas responsivas */
        .table-responsive {
            background: white;         /* Fondo blanco */
            border-radius: 15px;       /* Bordes redondeados */
            box-shadow: var(--shadow); /* Sombra */
        }
        
        /* Efecto hover para filas de tabla */
        .table-hover tbody tr:hover {
            background-color: rgba(var(--primary), 0.05); /* Color sutil */
        }
        
        /* Estilos para botones de acción */
        .action-btn {
            width: 40px;               /* Tamaño fijo */
            height: 40px;
            display: flex;
            align-items: center;       /* Centrado vertical */
            justify-content: center;   /* Centrado horizontal */
        }
        
        /* Contenedor de gráficos */
        .chart-container {
            background: white;         /* Fondo blanco */
            border-radius: 15px;       /* Bordes redondeados */
            box-shadow: var(--shadow); /* Sombra */
            padding: 20px;            /* Espaciado interno */
            margin-bottom: 20px;       /* Margen inferior */
        }
        
        /* Media queries para diseño responsivo */
        @media (max-width: 768px) {
            .sidebar {
                margin-left: -280px;   /* Ocultar barra lateral */
            }
            .sidebar.active {
                margin-left: 0;        /* Mostrar barra lateral */
            }
            .main-content {
                margin-left: 0;        /* Eliminar margen */
            }
        }
    </style>
</head>
<body>
<!-- Barra lateral de navegación -->  
<nav class="sidebar">  
    <div class="px-3 py-4">  
        <h3 class="text-center mb-4">  
            <i class="fa-solid fa-robot"></i><br>  
            <a href="index.php" class="text-white">SmartTech</a>  
        </h3>  
        <ul class="nav flex-column">  
            <li class="nav-item">  
                <!-- Enlace a Inicio - resaltado si es la sección activa -->  
                <a class="nav-link text-white <?= $currentSection === 'inicio' ? 'active' : '' ?>"   
                   href="index.php">  
                    <i class="fa-solid fa-home me-2"></i> Inicio  
                </a>  
            </li>  
            <li class="nav-item">  
                <!-- Enlace a Productos - resaltado si es la sección activa -->  
                <a class="nav-link text-white <?= $currentSection === 'productos' ? 'active' : '' ?>"   
                   href="productos.php">  
                    <i class="fa-solid fa-box me-2"></i> Productos  
                </a>  
            </li>  
            <li class="nav-item">  
                <!-- Enlace a Panel - resaltado si es la sección activa -->  
                <a class="nav-link text-white <?= $currentSection === 'panel' ? 'active' : '' ?>"   
                   href="panel.php">  
                    <i class="fa-solid fa-cog me-2"></i> Panel  
                </a>  
            </li>  
        </ul>  
    </div>  
</nav>  

    <!-- Contenido principal -->
    <div class="main-content">
        <!-- Cabecera -->
        <header class="bg-white shadow-sm py-3 px-4">
            <div class="d-flex justify-content-between align-items-center">
                <!-- Botón para mostrar/ocultar barra lateral en móviles -->
                <button class="btn btn-primary d-lg-none" id="sidebarToggle">
                    <i class="fa-solid fa-bars"></i>
                </button>
                <h4 class="mb-0">Panel de Control</h4>
                <div class="d-flex align-items-center">
                    <!-- Mostrar saludo dinámico -->
                    <h4 class="mb-0"><?= obtenerSaludo() ?>, Administrador</h4>
                    <!-- Menú de usuario -->
                    <div class="dropdown">
                        <button class="btn btn-light rounded-circle" id="userMenu">
                            <i class="fa-solid fa-user"></i>
                        </button>
                    </div>
                </div>
            </div>
        </header>

        <!-- Contenido principal del panel -->
        <div class="container-fluid p-4">
            <!-- Sección de estadísticas -->
            <div class="row g-4 mb-4">
                <!-- Tarjeta de Productos Totales -->
                <div class="col-12 col-md-6 col-lg-3">
                    <div class="stat-card p-4">
                        <div class="d-flex align-items-center">
                            <div class="bg-primary text-white rounded-circle p-3 me-3">
                                <i class="fa-solid fa-box fa-2x"></i>
                            </div>
                            <div>
                                <h6 class="mb-0">Productos Totales</h6>
                                <h2 class="mb-0" id="totalProductos">0</h2>
                            </div>
                        </div>
                    </div>
                </div>
                
                <!-- Tarjeta de Valor de Inventario -->
                <div class="col-12 col-md-6 col-lg-3">
                    <div class="stat-card p-4">
                        <div class="d-flex align-items-center">
                            <div class="bg-success text-white rounded-circle p-3 me-3">
                                <i class="fa-solid fa-dollar-sign fa-2x"></i>
                            </div>
                            <div>
                                <h6 class="mb-0">Valor Inventario</h6>
                                <h2 class="mb-0" id="valorInventario">$0</h2>
                            </div>
                        </div>
                    </div>
                </div>
                
                <!-- Tarjeta de Precio Promedio -->
                <div class="col-12 col-md-6 col-lg-3">
                    <div class="stat-card p-4">
                        <div class="d-flex align-items-center">
                            <div class="bg-info text-white rounded-circle p-3 me-3">
                                <i class="fa-solid fa-calculator fa-2x"></i>
                            </div>
                            <div>
                                <h6 class="mb-0">Precio Promedio</h6>
                                <h2 class="mb-0" id="precioPromedio">$0</h2>
                            </div>
                        </div>
                    </div>
                </div>
                
                <!-- Tarjeta de Categorías -->
                <div class="col-12 col-md-6 col-lg-3">
                    <div class="stat-card p-4">
                        <div class="d-flex align-items-center">
                            <div class="bg-warning text-white rounded-circle p-3 me-3">
                                <i class="fa-solid fa-tags fa-2x"></i>
                            </div>
                            <div>
                                <h6 class="mb-0">Categorías</h6>
                                <h2 class="mb-0" id="totalCategorias">0</h2>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Tabla de Productos -->
            <div class="card border-0 shadow mb-4">
                <div class="card-header bg-primary text-white">
                    <div class="d-flex justify-content-between align-items-center">
                        <h5 class="mb-0">Gestión de Productos</h5>
                        <!-- Botón para agregar nuevo producto -->
                        <button class="btn btn-light" data-bs-toggle="modal" data-bs-target="#productModal">
                            <i class="fa-solid fa-plus me-2"></i> Nuevo Producto
                        </button>
                    </div>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-hover align-middle">
                            <thead class="table-light">
                                <tr>
                                    <th>Nombre</th>
                                    <th>Categoría</th>
                                    <th class="text-center">Stock</th>
                                    <th class="text-end">Precio</th>
                                    <th class="text-center">Fecha Registro</th>
                                    <th class="text-center">Acciones</th>
                                </tr>
                            </thead>
                            <tbody id="tablaProductos">
                                <!-- Los datos de los productos se cargarán dinámicamente aquí -->
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <!-- Sección de Estadísticas con Gráficos -->
            <div class="row">
                <!-- Gráfico de distribución por categorías -->
                <div class="col-md-6 mb-4">
                    <div class="chart-container">
                        <h5 class="mb-3">Distribución por Categorías</h5>
                        <canvas id="categoriasChart" height="250"></canvas>
                    </div>
                </div>
                
                <!-- Gráfico de top 10 productos más caros -->
                <div class="col-md-6 mb-4">
                    <div class="chart-container">
                        <h5 class="mb-3">Top 10 Productos Más Caros</h5>
                        <canvas id="preciosChart" height="250"></canvas>
                    </div>
                </div>
                
                <!-- Resumen de inventario -->
                <div class="col-12">
                    <div class="chart-container">
                        <h5 class="mb-3">Resumen de Inventario</h5>
                        <div class="row">
                            <!-- Valor total del inventario -->
                            <div class="col-md-3 mb-3">
                                <div class="bg-light p-3 rounded text-center">
                                    <h6 class="text-muted">Valor Total</h6>
                                    <h4 id="valorTotalEstadisticas">$0</h4>
                                </div>
                            </div>
                            
                            <!-- Precio promedio -->
                            <div class="col-md-3 mb-3">
                                <div class="bg-light p-3 rounded text-center">
                                    <h6 class="text-muted">Precio Promedio</h6>
                                    <h4 id="precioPromedioEstadisticas">$0</h4>
                                </div>
                            </div>
                            
                            <!-- Producto más caro -->
                            <div class="col-md-3 mb-3">
                                <div class="bg-light p-3 rounded text-center">
                                    <h6 class="text-muted">Producto Más Caro</h6>
                                    <h5 id="productoMasCaro">-</h5>
                                    <h6 id="precioMasCaro">$0</h6>
                                </div>
                            </div>
                            
                            <!-- Producto más barato -->
                            <div class="col-md-3 mb-3">
                                <div class="bg-light p-3 rounded text-center">
                                    <h6 class="text-muted">Producto Más Barato</h6>
                                    <h5 id="productoMasBarato">-</h5>
                                    <h6 id="precioMasBarato">$0</h6>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal para agregar/editar productos -->
    <div class="modal fade" id="productModal" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <!-- Formulario para productos -->
                <form id="productForm">
                    <div class="modal-header">
                        <h5 class="modal-title">Gestión de Producto</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>
                    <div class="modal-body">
                        <!-- Campo para nombre del producto -->
                        <div class="mb-3">
                            <label class="form-label">Nombre del Producto</label>
                            <input type="text" class="form-control" name="nombre" required>
                        </div>
                        <div class="row g-3">
                            <!-- Campo para categoría con opción de agregar nueva -->
                            <div class="col-md-6">
                                <label class="form-label">Categoría</label>
                                <div class="input-group">
                                    <select class="form-select" name="categoria" id="categoriaSelect" required>
                                        <option value="">Seleccionar...</option>
                                    </select>
                                    <button type="button" class="btn btn-outline-secondary" id="btnNuevaCategoria">
                                        <i class="fa-solid fa-plus"></i>
                                    </button>
                                </div>
                                <input type="text" class="form-control mt-2 d-none" id="nuevaCategoriaInput" 
                                       placeholder="Nueva categoría">
                            </div>
                            
                            <!-- Campo para cantidad -->
                            <div class="col-md-6">
                                <label class="form-label">Cantidad</label>
                                <input type="number" class="form-control" name="cantidad" required>
                            </div>
                            
                            <!-- Campo para precio -->
                            <div class="col-12">
                                <label class="form-label">Precio</label>
                                <div class="input-group">
                                    <span class="input-group-text">$</span>
                                    <input type="number" step="0.01" class="form-control" name="precio" required>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                        <button type="submit" class="btn btn-primary">Guardar Producto</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Scripts JavaScript -->
    <!-- Bootstrap Bundle con Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <!-- SweetAlert2 para alertas bonitas -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <!-- Chart.js para gráficos -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    
    <!-- Script principal de la aplicación -->
    <script>
        // Clase principal para gestionar productos
        class ProductManager {
            constructor() {
                this.productos = [];        // Array para almacenar productos
                this.currentProductId = null; // ID del producto actualmente en edición
                this.initEventListeners(); // Inicializar event listeners
                this.initCategoryHandlers(); // Manejadores para categorías
                this.loadData();           // Cargar datos iniciales
            }

            // Inicializar event listeners
            initEventListeners() {
                // Listener para el botón de sidebar
                document.getElementById('sidebarToggle').addEventListener('click', this.toggleSidebar);
                // Listener para el formulario de productos
                document.getElementById('productForm').addEventListener('submit', (e) => this.handleSubmit(e));
            }

            // Manejadores para la funcionalidad de categorías
            initCategoryHandlers() {
                const categoriaSelect = document.getElementById('categoriaSelect');
                const nuevaCategoriaInput = document.getElementById('nuevaCategoriaInput');
                
                // Botón para agregar nueva categoría
                document.getElementById('btnNuevaCategoria').addEventListener('click', () => {
                    categoriaSelect.classList.add('d-none');      // Ocultar select
                    nuevaCategoriaInput.classList.remove('d-none'); // Mostrar input
                    nuevaCategoriaInput.focus();                  // Enfocar el input
                });

                // Cuando el input de nueva categoría pierde el foco
                nuevaCategoriaInput.addEventListener('blur', () => {
                    if (nuevaCategoriaInput.value) {
                        categoriaSelect.classList.remove('d-none'); // Mostrar select
                        nuevaCategoriaInput.classList.add('d-none'); // Ocultar input
                        this.addNewCategory(nuevaCategoriaInput.value); // Agregar categoría
                        nuevaCategoriaInput.value = '';          // Limpiar input
                    }
                });

                // Manejar Enter en el input de nueva categoría
                nuevaCategoriaInput.addEventListener('keypress', (e) => {
                    if (e.key === 'Enter') {
                        e.preventDefault();
                        nuevaCategoriaInput.blur();              // Simular blur
                    }
                });
            }

            // Alternar visibilidad de la barra lateral
            toggleSidebar() {
                document.querySelector('.sidebar').classList.toggle('active');
                document.querySelector('.main-content').classList.toggle('active');
            }

            // Cargar datos de productos y categorías
            async loadData() {
                try {
                    // Hacer ambas peticiones en paralelo
                    const [productsResponse, categoriesResponse] = await Promise.all([
                        fetch('crud.php?action=read'),          // Obtener productos
                        fetch('crud.php?action=get_categories') // Obtener categorías
                    ]);
                    
                    // Convertir respuestas a JSON
                    this.productos = await productsResponse.json();
                    const categorias = await categoriesResponse.json();
                    
                    // Actualizar la interfaz
                    this.updateCategoriesDropdown(categorias);
                    this.updateUI();
                    this.updateStats();
                    this.loadCharts();
                } catch (error) {
                    // Manejar errores (en este caso no se hace nada)
                }
            }

            // Actualizar el dropdown de categorías
            updateCategoriesDropdown(categorias) {
                const select = document.getElementById('categoriaSelect');
                select.innerHTML = '<option value="">Seleccionar...</option>';
                // Agregar cada categoría como opción
                categorias.forEach(cat => {
                    select.innerHTML += `<option value="${cat}">${cat}</option>`;
                });
            }

            // Agregar una nueva categoría al dropdown
            addNewCategory(categoria) {
                const select = document.getElementById('categoriaSelect');
                const option = document.createElement('option');
                option.value = categoria;
                option.textContent = categoria;
                select.appendChild(option);
                option.selected = true; // Seleccionar la nueva categoría
            }

            // Editar un producto existente
            async editProduct(id) {
                try {
                    // Obtener el producto del servidor
                    const response = await fetch(`crud.php?action=get_product&id=${id}`);
                    const producto = await response.json();
                    
                    this.currentProductId = id; // Establecer ID actual
                    const form = document.getElementById('productForm');
                    
                    // Rellenar el formulario con los datos del producto
                    form.nombre.value = producto.nombre;
                    form.cantidad.value = producto.cantidad;
                    form.precio.value = producto.precio;
                    
                    // Seleccionar la categoría correcta en el dropdown
                    const categoriaSelect = document.getElementById('categoriaSelect');
                    const option = Array.from(categoriaSelect.options).find(
                        opt => opt.value === producto.categoria
                    );
                    if (option) option.selected = true;
                    
                    // Mostrar el modal
                    const modal = new bootstrap.Modal('#productModal');
                    modal.show();
                } catch (error) {
                    this.showError('Error al cargar producto');
                }
            }

            // Manejar el envío del formulario (crear/actualizar)
            async handleSubmit(e) {
                e.preventDefault();
                // Obtener datos del formulario
                const formData = new FormData(e.target);
                const productData = Object.fromEntries(formData);
                
                // Si hay una nueva categoría en el input, usarla
                if (document.getElementById('nuevaCategoriaInput').value) {
                    productData.categoria = document.getElementById('nuevaCategoriaInput').value;
                }

                // Determinar si es creación o actualización
                const action = this.currentProductId ? 'update' : 'create';
                const url = `crud.php?action=${action}${this.currentProductId ? `&id=${this.currentProductId}` : ''}`;

                try {
                    // Enviar datos al servidor
                    const response = await fetch(url, {
                        method: 'POST',
                        headers: {'Content-Type': 'application/json'},
                        body: JSON.stringify(productData)
                    });
                    
                    if (response.ok) {
                        // Mostrar mensaje de éxito
                        this.showSuccess(`Producto ${action === 'create' ? 'creado' : 'actualizado'}`);
                        // Ocultar modal
                        bootstrap.Modal.getInstance(document.getElementById('productModal')).hide();
                        // Recargar datos
                        await this.loadData();
                        // Resetear ID y formulario
                        this.currentProductId = null;
                        document.getElementById('productForm').reset();
                    }
                } catch (error) {
                    this.showError('Error al guardar');
                }
            }

            // Actualizar las estadísticas en la interfaz
            updateStats() {
                // Calcular totales
                const total = this.productos.length;
                const totalValue = this.productos.reduce((acc, p) => acc + (p.cantidad * p.precio), 0);
                const avgPrice = total > 0 ? this.productos.reduce((acc, p) => acc + parseFloat(p.precio), 0) / total : 0;
                
                // Obtener categorías únicas
                const categorias = [...new Set(this.productos.map(p => p.categoria))];
                
                // Encontrar producto más caro y más barato
                let productoMasCaro = null;
                let productoMasBarato = null;
                if (this.productos.length > 0) {
                    productoMasCaro = this.productos.reduce((max, p) => parseFloat(p.precio) > parseFloat(max.precio) ? p : max);
                    productoMasBarato = this.productos.reduce((min, p) => parseFloat(p.precio) < parseFloat(min.precio) ? p : min);
                }

                // Actualizar UI con los valores calculados
                document.getElementById('totalProductos').textContent = total;
                document.getElementById('valorInventario').textContent = `$${totalValue.toFixed(2)}`;
                document.getElementById('precioPromedio').textContent = `$${avgPrice.toFixed(2)}`;
                document.getElementById('totalCategorias').textContent = categorias.length;
                
                // Actualizar estadísticas detalladas
                document.getElementById('valorTotalEstadisticas').textContent = `$${totalValue.toFixed(2)}`;
                document.getElementById('precioPromedioEstadisticas').textContent = `$${avgPrice.toFixed(2)}`;
                
                // Actualizar info de producto más caro
                if (productoMasCaro) {
                    document.getElementById('productoMasCaro').textContent = productoMasCaro.nombre;
                    document.getElementById('precioMasCaro').textContent = `$${parseFloat(productoMasCaro.precio).toFixed(2)}`;
                }
                
                // Actualizar info de producto más barato
                if (productoMasBarato) {
                    document.getElementById('productoMasBarato').textContent = productoMasBarato.nombre;
                    document.getElementById('precioMasBarato').textContent = `$${parseFloat(productoMasBarato.precio).toFixed(2)}`;
                }
            }

            // Actualizar la tabla de productos en la interfaz
            updateUI() {
                const tbody = document.getElementById('tablaProductos');
                // Generar filas de la tabla para cada producto
                tbody.innerHTML = this.productos.map(p => `
                    <tr>
                        <td>${p.nombre}</td>
                        <td><span class="badge bg-primary">${p.categoria}</span></td>
                        <td class="text-center">${p.cantidad}</td>
                        <td class="text-end">$${parseFloat(p.precio).toFixed(2)}</td>
                        <td class="text-center">${new Date(p.fecha_registro).toLocaleDateString()}</td>
                        <td class="text-center">
                            <!-- Botón para editar -->
                            <button class="btn btn-sm btn-warning action-btn me-2" onclick="pm.editProduct(${p.id})">
                                <i class="fa-solid fa-pen"></i>
                            </button>
                            <!-- Botón para eliminar -->
                            <button class="btn btn-sm btn-danger action-btn" onclick="pm.deleteProduct(${p.id})">
                                <i class="fa-solid fa-trash"></i>
                            </button>
                        </td>
                    </tr>
                `).join('');
            }

            // Cargar y mostrar gráficos
            loadCharts() {
                // Gráfico de distribución por categorías
                const categorias = [...new Set(this.productos.map(p => p.categoria))];
                const counts = categorias.map(cat => 
                    this.productos.filter(p => p.categoria === cat).length
                );
                
                // Crear gráfico de pastel si existe el canvas
                if (document.getElementById('categoriasChart')) {
                    const categoriasCtx = document.getElementById('categoriasChart').getContext('2d');
                    new Chart(categoriasCtx, {
                        type: 'pie', // Tipo de gráfico
                        data: {
                            labels: categorias, // Etiquetas (categorías)
                            datasets: [{
                                data: counts,   // Datos (cantidad por categoría)
                                backgroundColor: [ // Colores para cada segmento
                                    '#2A2A72', '#009FFD', '#FFA400', '#7FB800', '#E84855',
                                    '#6A4C93', '#F25F5C', '#FFE066', '#247BA0', '#70C1B3'
                                ]
                            }]
                        },
                        options: {
                            plugins: {
                                legend: {
                                    position: 'right' // Posición de la leyenda
                                }
                            }
                        }
                    });
                }

                // Gráfico de top 10 productos más caros
                if (document.getElementById('preciosChart')) {
                    // Ordenar productos por precio y tomar los 10 primeros
                    const top10 = [...this.productos]
                        .sort((a, b) => parseFloat(b.precio) - parseFloat(a.precio))
                        .slice(0, 10);
                    
                    // Crear gráfico de barras
                    const preciosCtx = document.getElementById('preciosChart').getContext('2d');
                    new Chart(preciosCtx, {
                        type: 'bar', // Tipo de gráfico
                        data: {
                            labels: top10.map(p => p.nombre), // Nombres de productos
                            datasets: [{
                                label: 'Precio',            // Etiqueta del dataset
                                data: top10.map(p => parseFloat(p.precio)), // Datos (precios)
                                backgroundColor: '#009FFD'   // Color de barras
                            }]
                        },
                        options: {
                            responsive: true, // Gráfico responsivo
                            scales: {
                                y: {
                                    beginAtZero: true,      // Eje Y comienza en 0
                                    title: {
                                        display: true,
                                        text: 'Precio ($)' // Título eje Y
                                    }
                                },
                                x: {
                                    title: {
                                        display: true,
                                        text: 'Productos'  // Título eje X
                                    }
                                }
                            }
                        }
                    });
                }
            }

            // Eliminar un producto
            async deleteProduct(id) {
                // Mostrar confirmación con SweetAlert
                const confirm = await Swal.fire({
                    title: '¿Eliminar producto?',
                    text: 'Esta acción no se puede deshacer',
                    icon: 'warning',
                    showCancelButton: true
                });
                
                // Si el usuario confirma
                if (confirm.isConfirmed) {
                    try {
                        // Enviar petición de eliminación
                        const response = await fetch(`crud.php?action=delete&id=${id}`);
                        if (response.ok) {
                            this.showSuccess('Producto eliminado');
                            await this.loadData(); // Recargar datos
                        }
                    } catch (error) {
                        this.showError('Error al eliminar');
                    }
                }
            }

            // Mostrar mensaje de éxito
            showSuccess(message) {
                Swal.fire({ icon: 'success', title: 'Éxito', text: message });
            }

            // Mostrar mensaje de error
            showError(message) {
                Swal.fire({ icon: 'error', title: 'Error', text: message });
            }
        }

        // Crear instancia del administrador de productos
        const pm = new ProductManager();

        // Alternar barra lateral (event listener adicional por si acaso)
        document.getElementById('sidebarToggle').addEventListener('click', function() {
            document.querySelector('.sidebar').classList.toggle('active');
            document.querySelector('.main-content').classList.toggle('active');
        });
    </script>
</body>
</html>