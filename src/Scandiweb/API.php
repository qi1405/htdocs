<?php

namespace Scandiweb;
use PDO;

class API
{
    private $database;

    public function __construct(Database $database)
    {
        $this->database = $database;
    }

    public function handleRequest()
    {
        $method = $_SERVER['REQUEST_METHOD'];

        switch ($method) {
            case 'POST':
                $this->handlePost();
                break;
            case "GET":
                // Check if an ID is provided in the query parameters
            if (isset($_GET['id'])) {
                $productId = $_GET['id'];
                $this->getProductById($productId);
            } else {
                $this->readAllProducts();
            }
            break;
            case 'DELETE':
                // Check if an ID or multiple IDs are provided in the query parameters
                if (isset($_GET['id'])) {
                    // Single product deletion
                    $productId = $_GET['id'];
                    $this->deleteProductById($productId);
                } elseif (isset($_GET['ids'])) {
                    // Multiple product deletion
                    $productIds = $_GET['ids'];
                    $this->deleteProductsByIds($productIds);
                } else {
                    http_response_code(400); // Bad Request
                    echo json_encode(['error' => 'Missing product ID(s)']);
                }
                break;
            // Add other methods (GET, DELETE, etc.) as needed
            default:
                http_response_code(405); // Method Not Allowed
                echo json_encode(['error' => 'Method not allowed']);
        }
    }


    // Handle POST request to create a product
    private function handlePost()
{
    // Assume JSON format for simplicity, adjust as needed
    $data = json_decode(file_get_contents('php://input'), true);

    // Check if the required fields are present
    if (isset($data['sku']) && isset($data['name']) && isset($data['price']) && isset($data['type'])) {
        $type = $data['type'];

        // Determine the class name based on the 'type'
        $className = 'Scandiweb\\' . ucfirst($type);

        // Check if the class exists
        if (class_exists($className)) {
            // Create an instance of the product class dynamically
            $product = new $className();

            // Set data for the product
            $product->setData($data);

            // Save the product to the database
            $product->saveToDatabase();

            // Return the created product
            echo json_encode(['success' => 'Product created', 'data' => $data]);
        } else {
            http_response_code(400); // Bad Request
            echo json_encode(['error' => 'Invalid product type']);
        }
    } else {
        http_response_code(400); // Bad Request
        echo json_encode(['error' => 'Missing required fields']);
    }
}

    // Get all products from the database
    public function readAllProducts()
    {
        $host = 'localhost';
        $username = 'root';
        $password = '1405991473029Qi_';
        $databaseName = 'product_management';

        // Assume you have a Database class with a getConnection method
        $database = new Database($host, $username, $password, $databaseName);
        $connection = $database->getConnection();

        // Assuming a table named 'products'
        $stmt = $connection->prepare('SELECT * FROM products');
        $stmt->execute();

        // Fetch all products from the database
        $products = $stmt->fetchAll(PDO::FETCH_ASSOC);

        // Return the products as JSON
        echo json_encode(['success' => 'Products retrieved', 'data' => $products]);
    }

    // Get product by ID from the database
    public function getProductById($productId)
    {
        $host = 'localhost';
        $username = 'root';
        $password = '1405991473029Qi_';
        $databaseName = 'product_management';

        // Assume you have a Database class with a getConnection method
        $database = new Database($host, $username, $password, $databaseName);
        $connection = $database->getConnection();

        // Assuming a table named 'products'
        $stmt = $connection->prepare('SELECT * FROM products WHERE id = ?');
        $stmt->execute([$productId]);

        // Fetch the product from the database
        $product = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($product) {
            // Return the product as JSON
            echo json_encode(['success' => 'Product retrieved', 'data' => $product]);
        } else {
            http_response_code(404); // Not Found
            echo json_encode(['error' => 'Product not found']);
        }
    }

    // Delete a product by ID from the database
    public function deleteProductById($productId)
    {
        $host = 'localhost';
        $username = 'root';
        $password = '1405991473029Qi_';
        $databaseName = 'product_management';

        // Assume you have a Database class with a getConnection method
        $database = new Database($host, $username, $password, $databaseName);
        $connection = $database->getConnection();

        // Assuming a table named 'products'
        $stmt = $connection->prepare('DELETE FROM products WHERE id = ?');
        $stmt->execute([$productId]);

        $rowCount = $stmt->rowCount();

        if ($rowCount > 0) {
            echo json_encode(['success' => 'Product deleted']);
        } else {
            http_response_code(404); // Not Found
            echo json_encode(['error' => 'Product not found']);
        }
    }

    // Delete products by IDs from the database
    public function deleteProductsByIds($productIds)
    {
        $host = 'localhost';
        $username = 'root';
        $password = '1405991473029Qi_';
        $databaseName = 'product_management';

        // Assume you have a Database class with a getConnection method
        $database = new Database($host, $username, $password, $databaseName);
        $connection = $database->getConnection();

        // Assuming a table named 'products'
        $placeholders = implode(',', array_fill(0, count($productIds), '?'));

        $stmt = $connection->prepare("DELETE FROM products WHERE id IN ($placeholders)");
        $stmt->execute($productIds);

        $rowCount = $stmt->rowCount();

        if ($rowCount > 0) {
            echo json_encode(['success' => 'Products deleted']);
        } else {
            http_response_code(404); // Not Found
            echo json_encode(['error' => 'Products not found']);
        }
    }
}

?>