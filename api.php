<?php

header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET, POST, PUT, PATCH, DELETE, OPTIONS');

header('Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept');


$dbh = new PDO('mysql:host=localhost;dbname=vue_crud', 'sawhtut', 'sawhtut');

$path = $_SERVER['PATH_INFO'] ?? '/';
$method = $_SERVER['REQUEST_METHOD'];



switch ($method) {
    case 'GET':
        if ($path == '/books') {
            // Fetch all books from the database
            $stmt = $dbh->query("SELECT * FROM books");
            $books = $stmt->fetchAll(PDO::FETCH_ASSOC);
            echo json_encode($books);
        }
        break;

    case 'POST':
        if ($path == '/books') {
            // Insert a new book into the database
            $data = json_decode(file_get_contents('php://input'), true);
            $stmt = $dbh->prepare("INSERT INTO books (title, author) VALUES (?, ?)");
            $stmt->execute([$data['title'], $data['author']]);
            $bookId = $dbh->lastInsertId();
            $book = ['id' => $bookId, 'title' => $data['title'], 'author' => $data['author']];
            echo json_encode($book);
        }
        break;

    case 'PUT':
        

            // Update a specific book in the database
            $data = json_decode(file_get_contents('php://input'), true);
            $stmt = $dbh->prepare("UPDATE books SET title = ?, author = ? WHERE id = ?");
            $stmt->execute([$data['title'], $data['author'], $data['id']]);
            echo json_encode(['success' => true]);
        
        break;

    case 'DELETE':
      
      $id = $_GET['id'];
        $sql = "DELETE FROM books WHERE id = :id";
    $stmt = $dbh->prepare($sql);
    $stmt->bindParam(':id', $id, PDO::PARAM_INT);
    $stmt->execute();
            
        
        break;
}
?>
