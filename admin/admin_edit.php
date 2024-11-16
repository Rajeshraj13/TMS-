<?php
session_start();
include "../connection.php";


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['id'])) {
        $id = $_POST['id'];
        $Name = $_POST['Name'];
        $Email = $_POST['Email'];
        $Password = $_POST['Password'];
        $Phone = $_POST['Phone'];

        // Check if there are changes in the submitted data
        $sql_check_changes = "SELECT Name, Email, Password, Phone FROM admin_registration WHERE id=?";
        $stmt_check_changes = $conn->prepare($sql_check_changes);
        $stmt_check_changes->bind_param("i", $id);
        $stmt_check_changes->execute();
        $result_check_changes = $stmt_check_changes->get_result();
        $row_check_changes = $result_check_changes->fetch_assoc();

        // Compare current data with submitted data
        if ($row_check_changes['Name'] == $Name && 
            $row_check_changes['Email'] == $Email && 
            $row_check_changes['Password'] == $Password && 
            $row_check_changes['Phone'] == $Phone) {
            $_SESSION['error_message'] = "No changes made.";
            header("Location: admin_edit.php?id=$id");
            exit;
        }

        // Update SQL query
        $sql_update = "UPDATE admin_registration SET Name=?, Email=?, Password=?, Phone=? WHERE id=?";
        $stmt_update = $conn->prepare($sql_update);
        $stmt_update->bind_param("ssssi", $Name, $Email, $Password, $Phone, $id);
        $stmt_update->execute();

        // Check if update was successful
        if ($stmt_update->affected_rows > 0) {
            $_SESSION['success_message'] = "Information updated successfully";
            header("Location: admin_edit.php");
            exit;
        } else {
            $_SESSION['error_message'] = "Error updating information: " . $stmt_update->error;
        }

        $stmt_update->close();
    } else {
        $_SESSION['error_message'] = "ID is not set.";
    }
} elseif (isset($_GET['id'])) {
    // Fetch user data based on ID for editing
    $id = $_GET['id'];
    $sql = "SELECT * FROM admin_registration WHERE id=?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();

    // Check if user with the specified ID exists
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
    } else {
        $_SESSION['error_message'] = "User not found.";
        header("Location: index.php");
        exit;
    }

    $stmt->close();
}

$conn->close();
?>




<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Admin Dashboard</title>

    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <!-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous"> -->
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">
    <link href="css/sb-admin-2.min.css" rel="stylesheet">
    <link href="vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css"
        integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>

<body id="page-top">
    <div id="wrapper">
        <ul class="navbar-nav bg-gradient-info sidebar sidebar-dark accordion" id="accordionSidebar">
            <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.html">
                <div class="sidebar-brand-icon rotate-n-15">
                    <i class="bi bi-apple"></i>
                </div>
                <div class="sidebar-brand-text mx-3">EMS Admin</div>
            </a>
            <hr class="sidebar-divider my-0">
            <li class="nav-item">
                <a class="nav-link" href="index.php">
                    <i class="fas fa-fw fa-tachometer-alt"></i>
                    <span>Dashboard</span>
                </a>
            </li>
            <hr class="sidebar-divider">
            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTasks"
                    aria-expanded="true" aria-controls="collapseTasks">
                    <i class="fas fa-fw fa-folder"></i>
                    <span>Task</span>
                </a>
                <div id="collapseTasks" class="collapse" aria-labelledby="headingTasks" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <a class="collapse-item" href="add_task.php">Add Task</a>
                        <a class="collapse-item" href="view.php">View</a>
                    </div>
                </div>
            </li>
            <li class="nav-item active">
                <a class="nav-link" href="tables.php">
                    <i class="fas fa-fw fa-table"></i>
                    <span>Tables</span>
                </a>
            </li>
            <hr class="sidebar-divider d-none d-md-block">
            <div class="text-center d-none d-md-inline">
                <button class="rounded-circle border-0" id="sidebarToggle"></button>
            </div>
        </ul>

        <div id="content-wrapper" class="d-flex flex-column">
            <div id="content">
                <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">
                    <form class="form-inline">
                        <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
                            <i class="fa fa-bars"></i>
                        </button>
                    </form>
                    <ul class="navbar-nav ml-auto">
                        <div class="topbar-divider d-none d-sm-block"></div>
                        <li class="nav-item dropdown no-arrow">
                            <?php
                            include "../connection.php";
                            $sql = " SELECT * FROM `admin_registration`";
                            $query=mysqli_query($conn,$sql);
                            $result = mysqli_fetch_assoc($query);
                            ?>

                            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <span class="mr-2 d-none d-lg-inline text-gray-600 small">
                                    <?php echo $result['Name']; ?>
                                </span>
                                <img class="img-profile rounded-circle" src="img/undraw_profile.svg">
                            </a>
                            <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in"
                                aria-labelledby="userDropdown">
                                <a class="dropdown-item" href="#">
                                    <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Profile
                                </a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal">
                                    <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Logout
                                </a>
                            </div>
                        </li>
                    </ul>
                </nav>
                <div class="container">

                    <?php
                        if (isset($_SESSION['error_message'])) {
                        echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">';
                        echo $_SESSION['error_message'];
                        //echo '<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>';
                        echo '<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>';
                        echo '</div>';
                        unset($_SESSION['error_message']);
                        }
                        if (isset($_SESSION['success_message'])) {
                        echo '<div class="alert alert-success alert-dismissible fade show" role="alert">';
                        echo $_SESSION['success_message'];
                        echo '<a href="#" class="btn-close" data-bs-dismiss="alert" aria-label="Close" onclick="redirectOnClose()"></a>';
                        echo '</div>';
                        unset($_SESSION['success_message']);
                        }
                   ?>

                    <div class="row d-flex justify-content-center align-items-center h-100">
                        <div class="col">
                            <div class="card card-registration my-4">
                                <div class="row g-0">
                                    <div class="col-xl-6 d-none d-xl-block">
                                        <img src="https://cdn.pixabay.com/photo/2024/05/16/22/25/office-8767044_640.jpg"
                                            alt="Sample photo" class="img-fluid"
                                            style="border-top-left-radius: .25rem; border-bottom-left-radius: .25rem;" />
                                    </div>
                                    <div class="col-xl-6">
                                        <div class="card-body p-md-5 text-black">
                                            <h2 class="mb-5">Admin Edit Form</h2><br>
                    
                    
                                            <form id="editUserForm" method="POST" action="admin_edit.php"
                                                enctype="multipart/form-data">
                                                <div class="form-group">
                                                    <label for="username">Name</label>
                                                    <input type="text" class="form-control" id="username" name="Name"
                                                        value="<?php echo isset($_GET['id']) ? $row['Name'] : ''; ?>"
                                                        required>
                                                </div>

                                                <div class="form-group">
                                                    <label for="email">Email</label>
                                                    <input type="email" class="form-control" id="email" name="Email"
                                                        value="<?php echo isset($_GET['id']) ? $row['Email'] : ''; ?>"
                                                        required>
                                                </div>

                                                <div class="form-group">
                                                    <label for="password">Password</label>
                                                    <input type="text" class="form-control" id="password"
                                                        name="Password"
                                                        value="<?php echo isset($_GET['id']) ? $row['Password'] : ''; ?>"
                                                        required>
                                                </div>

                                                <div class="form-group">
                                                    <label for="phone">Phone</label>
                                                    <input type="text" class="form-control" id="phone" name="Phone"
                                                        value="<?php echo isset($_GET['id']) ? $row['Phone'] : ''; ?>"
                                                        required>
                                                </div>
                                                
                                                <input type="hidden" name="id"
                                                    value="<?php echo isset($_GET['id']) ? $_GET['id'] : ''; ?>">
                                                <button type="submit" class="btn btn-success mt-5">Update</button>
                                                <button type="button" class="btn btn-danger mt-5"
                                                    onclick="window.location.href='index.php'">Cancel</button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>


        <a class="scroll-to-top rounded" href="#page-top">
            <i class="fas fa-angle-up"></i>
        </a>

        <!-- Logout Modal-->
        <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
            aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
                        <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                    </div>
                    <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
                    <div class="modal-footer">
                        <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                        <a class="btn btn-primary" href="index1.php">Logout</a>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="vendor/jquery-easing/jquery.easing.min.js"></script>
    <script src="js/sb-admin-2.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM"
        crossorigin="anonymous"></script>
    <script src="vendor/datatables/jquery.dataTables.min.js"></script>
    <script src="vendor/datatables/dataTables.bootstrap4.min.js"></script>
    <script src="js/demo/datatables-demo.js"></script>

    <script>
        function redirectOnClose() {
            window.location.href = 'index.php';
        }
    </script>
</body>

</html>