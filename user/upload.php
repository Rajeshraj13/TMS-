<!-- <?php
session_start();
include "../connection.php";

if(isset($_SESSION['email'])) {
    $email = $_SESSION['email'];

    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_FILES["pdfFile"])) {
        $fileName = $_FILES["pdfFile"]["name"];
        $fileType = $_FILES["pdfFile"]["type"];
        $fileSize = $_FILES["pdfFile"]["size"];
        $fileTmpName = $_FILES["pdfFile"]["tmp_name"];
        $uploaderName = $_POST['uploaderName'];

        $uploadDirectory = "../user/upload/";

        if (!file_exists($uploadDirectory)) {
            mkdir($uploadDirectory, 0777, true);
        }

        $targetFilePath = $uploadDirectory . basename($fileName);

        if (move_uploaded_file($fileTmpName, $targetFilePath)) {
            $sql = "INSERT INTO uploaded_files (file_name, file_type, file_size, file_path, uploaderName) 
                    VALUES (?, ?, ?, ?, ?)";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("ssiss", $fileName, $fileType, $fileSize, $targetFilePath, $uploaderName);

            if ($stmt->execute()) {
                $_SESSION['message'] = "File uploaded successfully.";
                $_SESSION['msg_type'] = "success";
                header("Location: view.php");
                exit();
            } else {
                $_SESSION['message'] = "Error uploading file: " . $stmt->error;
                $_SESSION['msg_type'] = "danger";
            }
        } else {
            $_SESSION['message'] = "Sorry, there was an error uploading your file.";
            $_SESSION['msg_type'] = "danger";
        }
    }
} else {
    $_SESSION['message'] = "User not logged in."; 
    $_SESSION['msg_type'] = "danger";
}

$conn->close();
?> -->


<?php
session_start();
include "../connection.php";

if(isset($_SESSION['email'])) {
    $email = $_SESSION['email'];

    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_FILES["pdfFile"])) {
        $fileName = $_FILES["pdfFile"]["name"];
        $fileType = $_FILES["pdfFile"]["type"];
        $fileSize = $_FILES["pdfFile"]["size"];
        $fileTmpName = $_FILES["pdfFile"]["tmp_name"];
        $uploaderName = $_POST['uploaderName']; // Ensure this value is properly sanitized if needed

        $uploadDirectory = "../user/upload/";

        if (!file_exists($uploadDirectory)) {
            mkdir($uploadDirectory, 0777, true);
        }

        $targetFilePath = $uploadDirectory . basename($fileName);

        if (move_uploaded_file($fileTmpName, $targetFilePath)) {
            $sql = "INSERT INTO uploaded_files (file_name, file_type, file_size, file_path, uploaderName) 
                    VALUES (?, ?, ?, ?, ?)";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("ssiss", $fileName, $fileType, $fileSize, $targetFilePath, $uploaderName);

            if ($stmt->execute()) {
                $_SESSION['message'] = "File uploaded successfully.";
                $_SESSION['msg_type'] = "success";
                header("Location: view.php");
                exit();
            } else {
                $_SESSION['message'] = "Error uploading file: " . $stmt->error;
                $_SESSION['msg_type'] = "danger";
            }
        } else {
            $_SESSION['message'] = "Sorry, there was an error uploading your file.";
            $_SESSION['msg_type'] = "danger";
        }
    }
} else {
    $_SESSION['message'] = "User not logged in."; 
    $_SESSION['msg_type'] = "danger";
}

$conn->close();
?>

