<?php
// CRITERIA 6: API allows single-page updates without reload
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: Content-Type");
header("Access-Control-Allow-Methods: GET, POST, OPTIONS");
header("Content-Type: application/json; charset=UTF-8");

if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') { http_response_code(200); exit; }

$host = "127.0.0.1";
$db_name = "product_catalogue";
$username = "root";
$password = "";

try {
    $conn = new PDO("mysql:host=$host;dbname=$db_name", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch(PDOException $e) {
    http_response_code(500);
    echo json_encode(["message" => "Database Connection Failed"]);
    exit;
}

// CRITERIA 2: Get all products
if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    $stmt = $conn->prepare("SELECT * FROM products ORDER BY created_at DESC");
    $stmt->execute();
    echo json_encode($stmt->fetchAll(PDO::FETCH_ASSOC));
}

// CRITERIA 1: Add new product
elseif ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $data = json_decode(file_get_contents("php://input"));

    // Validation
    if (empty($data->name) || empty($data->price)) {
        http_response_code(400);
        echo json_encode(["message" => "Please fill in all fields."]);
        exit;
    }

    try {
        $sql = "INSERT INTO products (name, price) VALUES (:name, :price)";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':name', $data->name);
        $stmt->bindParam(':price', $data->price);
        $stmt->execute();

        echo json_encode([
            "message" => "Product added successfully!",
            "product" => [
                "id" => $conn->lastInsertId(),
                "name" => $data->name,
                "price" => $data->price
            ]
        ]);
    } catch (PDOException $e) {
        // CRITERIA 4: Specific error for duplicates
        if ($e->getCode() == 23000) { 
            http_response_code(409); // 409 Conflict
            echo json_encode(["message" => "Duplicate Error: A product with this name already exists."]);
        } else {
            http_response_code(500);
            echo json_encode(["message" => "Server Error: " . $e->getMessage()]);
        }
    }
}
?>