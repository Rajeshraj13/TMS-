<?php
require_once "../connection.php";


if(isset($_GET['id']) && !empty($_GET['id'])) {
    $id = intval($_GET['id']);

    $sql = "SELECT file_path FROM uploaded_files WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $stmt->store_result();

    if($stmt->num_rows > 0) {
        $stmt->bind_result($filePath);
        $stmt->fetch();
        $stmt->close();

        header("Content-Type: application/octet-stream");
        header("Content-Disposition: attachment; filename=" . basename($filePath));
        readfile($filePath); // Output file contents
        exit();
    }
}

// If file ID is invalid or not provided, redirect to homepage or show an error message
header("Location: index.php"); // Redirect to homepage
exit();
?>
