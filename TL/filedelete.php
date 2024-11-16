<?php
require_once "../connection.php";

if(isset($_GET['id']) && !empty($_GET['id'])) {
    // Sanitize input
    $id = intval($_GET['id']);

   
    $sql = "DELETE FROM uploaded_files WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $stmt->close();
    header("Location: task_file.php");
    exit();
}

header("Location: index.php"); // Redirect to homepage
exit();
?>
