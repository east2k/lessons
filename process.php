<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbName = "studentrecord";

$conn = new mysqli($servername, $username, $password, $dbName);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$action = $_POST['action'];

if ($action == 'create') {
    // Create (Insert) operation
    $username = $_POST['username'];
    $email = $_POST['email'];

    $sql = "INSERT INTO users (username, email) VALUES ('$username', '$email')";

    if ($conn->query($sql) === TRUE) {
        echo "Record created successfully";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
} elseif ($action == 'update') {
    // Update operation
    $newUsername = $_POST['newUsername'];
    $idToUpdate = $_POST['id'];

    $sql = "UPDATE users SET username='$newUsername' WHERE id=$idToUpdate";

    if ($conn->query($sql) === TRUE) {
        echo "Record updated successfully";
    } else {
        echo "Error updating record: " . $conn->error;
    }
} elseif ($action == 'delete') {
    // Delete operation
    $idToDelete = $_POST['idToDelete'];

    $sql = "DELETE FROM users WHERE id=$idToDelete";

    if ($conn->query($sql) === TRUE) {
        echo "Record deleted successfully";
    } else {
        echo "Error deleting record: " . $conn->error;
    }
}

$conn->close();
