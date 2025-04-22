<?php
header('Content-Type: application/json');
require 'conexion.php';

$action = $_GET['action'] ?? '';
$id = $_GET['id'] ?? null;

try {
    $pdo = new PDO("mysql:host=localhost;dbname=inventario", 'root', '');
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    switch ($action) {
        case 'get_categories':
            // Obtener categorías únicas
            $stmt = $pdo->query("SELECT DISTINCT categoria FROM productos");
            $categorias = $stmt->fetchAll(PDO::FETCH_COLUMN);
            echo json_encode($categorias);
            break;

        case 'get_product':
            // Obtener un producto específico
            $stmt = $pdo->prepare("SELECT * FROM productos WHERE id = ?");
            $stmt->execute([$id]);
            echo json_encode($stmt->fetch());
            break;

        case 'read':
            // Leer todos los productos
            $stmt = $pdo->query("SELECT * FROM productos ORDER BY fecha_registro DESC");
            echo json_encode($stmt->fetchAll());
            break;

        case 'create':
            // Crear nuevo producto
            $data = json_decode(file_get_contents('php://input'), true);
            $stmt = $pdo->prepare("INSERT INTO productos (nombre, categoria, cantidad, precio) 
                                  VALUES (?, ?, ?, ?)");
            $stmt->execute([
                $data['nombre'],
                $data['categoria'],
                $data['cantidad'],
                $data['precio']
            ]);
            echo json_encode(['success' => true, 'id' => $pdo->lastInsertId()]);
            break;

        case 'update':
            // Actualizar producto existente
            $data = json_decode(file_get_contents('php://input'), true);
            $stmt = $pdo->prepare("UPDATE productos SET 
                                nombre = ?, 
                                categoria = ?, 
                                cantidad = ?, 
                                precio = ?
                                WHERE id = ?");
            $stmt->execute([
                $data['nombre'],
                $data['categoria'],
                $data['cantidad'],
                $data['precio'],
                $id
            ]);
            echo json_encode(['success' => true]);
            break;

        case 'delete':
            // Eliminar producto
            $stmt = $pdo->prepare("DELETE FROM productos WHERE id = ?");
            $stmt->execute([$id]);
            echo json_encode(['success' => true]);
            break;

        default:
            http_response_code(400);
            echo json_encode(['success' => false, 'message' => 'Acción no válida']);
    }
} catch (PDOException $e) {
    http_response_code(500);
    echo json_encode(['success' => false, 'message' => $e->getMessage()]);
}
?>