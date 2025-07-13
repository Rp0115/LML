<?php
// Set headers for JSON response
header('Content-Type: application/json');

// --- DATABASE CONFIGURATION ---
// IMPORTANT: Replace with your actual database credentials
$servername = "localhost";
$username = "root";
$password = "1234";
$dbname = "LML";

// Create database connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection for errors
if ($conn->connect_error) {
    // Stop execution and return an error
    http_response_code(500);
    echo json_encode(['status' => 'error', 'message' => 'Database connection failed: ' . $conn->connect_error]);
    exit();
}

// --- HANDLE REQUESTS ---
$method = $_SERVER['REQUEST_METHOD'];

if ($method === 'GET') {
    // --- HANDLE FETCHING NOTES ---
    if (!isset($_GET['id'])) {
        http_response_code(400);
        echo json_encode(['status' => 'error', 'message' => 'Note ID is required.']);
        exit();
    }
    
    $noteId = $_GET['id'];
    
    // Prepare SQL statement to prevent SQL injection
    $stmt = $conn->prepare("SELECT content FROM notes WHERE id = ?");
    $stmt->bind_param("s", $noteId);
    $stmt->execute();
    $result = $stmt->get_result();
    
    $note = $result->fetch_assoc();
    
    // Return the content or an empty string if not found
    echo json_encode(['content' => $note ? $note['content'] : '']);
    
    $stmt->close();
    
} elseif ($method === 'POST') {
    // --- HANDLE SAVING NOTES ---
    // Get the posted data (which is in JSON format)
    $data = json_decode(file_get_contents('php://input'), true);

    if (!isset($data['id']) || !isset($data['content'])) {
        http_response_code(400);
        echo json_encode(['status' => 'error', 'message' => 'Note ID and content are required.']);
        exit();
    }

    $noteId = $data['id'];
    $noteContent = $data['content'];

    // Use INSERT ... ON DUPLICATE KEY UPDATE to either create a new note or update an existing one
    $stmt = $conn->prepare("INSERT INTO notes (id, content) VALUES (?, ?) ON DUPLICATE KEY UPDATE content = VALUES(content)");
    $stmt->bind_param("ss", $noteId, $noteContent);

    if ($stmt->execute()) {
        echo json_encode(['status' => 'success', 'message' => 'Note saved successfully.']);
    } else {
        http_response_code(500);
        echo json_encode(['status' => 'error', 'message' => 'Failed to save note.']);
    }

    $stmt->close();
}

// Close the database connection
$conn->close();
?>