<?php
include "../connection.php"; // Include your database connection file

if(isset($_GET['id'])) {
    $file_id = $_GET['id']; // Assuming the parameter is named 'id' in your URL

    // Fetch file information from database
    $sql = "SELECT file_name, file_path FROM uploaded_files WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $file_id);
    $stmt->execute();
    $result = $stmt->get_result();

    if($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $file_path = $row['file_path'];
        $file_name = $row['file_name'];

        // Check if the file exists
        if (file_exists($file_path)) {
            // Set headers for download
            header("Content-Type: application/pdf");
            header("Content-Disposition: attachment; filename=\"" . $file_name . "\"");
            header("Content-Length: " . filesize($file_path));

            // Clear output buffer
            ob_clean();
            flush();

            // Read the file and output it directly
            readfile($file_path);
            exit();
        } else {
            echo "File not found on the server.";
        }
    } else {
        echo "File information not found in the database.";
    }
} else {
    echo "Invalid file ID.";
}
?>
