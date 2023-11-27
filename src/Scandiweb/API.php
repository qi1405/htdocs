<?php

namespace Scandiweb;

class API
{
    private $database;

    public function __construct(Database $database)
    {
        $this->database = $database;
    }

    public function handleRequest()
    {
        // Check the request method
        $method = $_SERVER['REQUEST_METHOD'];

        switch ($method) {
            case 'POST':
                $this->handlePost();
                break;
            case 'GET':
                $this->handleGet();
                break;
            case 'DELETE':
                $this->handleDelete();
                break;
            default:
                // Handle other request methods if needed
                http_response_code(405); // Method Not Allowed
                break;
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

            // Create an instance of the appropriate class based on the 'type' field
            switch ($type) {
                case 'Electronics':
                    $product = new Electronics();
                    break;
                case 'Book':
                    $product = new Book();
                    break;
                case 'Furniture':
                    $product = new Furniture();
                    break;
                default:
                    http_response_code(400); // Bad Request
                    echo json_encode(['error' => 'Invalid product type']);
                    return;
            }

            // Set data for the product and save it to the database
            $product->setData($data);
            $this->saveProduct($product);

            // Return the created product
            echo json_encode(['success' => 'Product created', 'data' => $data]);
        } else {
            http_response_code(400); // Bad Request
            echo json_encode(['error' => 'Missing required fields']);
        }
    }

    // Handle GET request to read all products
    private function handleGet()
    {
        // Retrieve all products from the database
        $products = $this->getAllProducts();

        // Return the list of products
        echo json_encode(['data' => $products]);
    }

    // Handle DELETE request to delete a product by ID
    private function handleDelete()
    {
        // Assume the ID is passed as a query parameter, adjust as needed
        $productId = isset($_GET['id']) ? $_GET['id'] : null;

        if ($productId !== null) {
            // Delete the product from the database
            $success = $this->deleteProduct($productId);

            if ($success) {
                echo json_encode(['success' => 'Product deleted']);
            } else {
                http_response_code(404); // Not Found
                echo json_encode(['error' => 'Product not found']);
            }
        } else {
            http_response_code(400); // Bad Request
            echo json_encode(['error' => 'Missing product ID']);
        }
    }

    // Save a product to the database
    private function saveProduct(Product $product)
    {
        // Implement the logic to save the product to the database
        // For demonstration purposes, we'll just execute a sample query
        $sql = "INSERT INTO products (sku, name, price, type) VALUES (:sku, :name, :price, :type)";
        $stmt = $this->database->getConnection()->prepare($sql);
        $stmt->bindParam(':sku', $product->getSKU());
        $stmt->bindParam(':name', $product->getName());
        $stmt->bindParam(':price', $product->getPrice());
        $stmt->bindParam(':type', $product->getType());
        $stmt->execute();
    }

    // Get all products from the database
    private function getAllProducts()
    {
        // Implement the logic to retrieve all products from the database
        // For demonstration purposes, we'll just execute a sample query
        $sql = "SELECT * FROM products";
        $stmt = $this->database->getConnection()->query($sql);
        return $stmt->fetchAll(\PDO::FETCH_ASSOC);
    }

    // Delete a product by ID from the database
    private function deleteProduct($productId)
    {
        // Implement the logic to delete the product from the database
        // For demonstration purposes, we'll just execute a sample query
        $sql = "DELETE FROM products WHERE id = :id";
        $stmt = $this->database->getConnection()->prepare($sql);
        $stmt->bindParam(':id', $productId);
        $stmt->execute();

        // Check if any rows were affected
        return $stmt->rowCount() > 0;
    }
}

?>