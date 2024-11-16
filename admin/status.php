<?php
session_start();
include "../connection.php";
$id = intval($_GET['id']);  // Change 'd_id' to 'id' to match the URL parameter in HTML part
$status = intval($_GET['status']);  // This remains the same

// SQL to update the assignment_status
$sql = "UPDATE add_user SET assignment_status = ? WHERE id = ?";

$stmt = $conn->prepare($sql);
if ($stmt === false) {
    die('Prepare failed: ' . htmlspecialchars($conn->error));
}

$stmt->bind_param("ii", $status, $id);

if ($stmt->execute()) {
    header('Location: tables.php');
    exit;
} else {
    echo "Error updating record: " . htmlspecialchars($stmt->error);
}

$stmt->close();
$conn->close();
?>
