<?php
session_start();
include "../connection.php";
$row = [];

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    $sql = "SELECT * FROM `add_user` WHERE `id`='$id'";
    $result = mysqli_query($conn, $sql);
    if ($result && mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
    } else {
        echo "User not found.";
        exit;
    }
}


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $_POST['id'];
  //  $assignment = $_POST['assignment'];
  $task=$_POST['task'];
  $sql = "UPDATE `add_user` SET  `task`='$task' WHERE `id`='$id'";
  //  $sql = "UPDATE `add_user` SET  `assignment`='$assignment' WHERE `id`='$id'";
    $result = mysqli_query($conn, $sql);

    if ($result) {
        echo "<script>alert('Information updated successfully');</script>";
        header("Location: view.php");
        exit;
    } else {
        echo "Error updating information: " . mysqli_error($conn);
    }
}
?>



<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>User Dashboard</title>
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <!-- <link -->
        <!-- href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" -->
        <!-- rel="stylesheet"> -->
    <link href="css/sb-admin-2.min.css" rel="stylesheet">
    <!-- <link href="vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet"> -->
    <!-- <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css"> -->
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
                <a class="nav-link" href="index_user.php">
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
                        $sql = " SELECT * FROM `reg-information`" ;
                        $query = mysqli_query($conn, $sql);
                        if ($query) {
                        $result = mysqli_fetch_assoc($query);
                        if ($result) {
                        $userName = $result['name'];
                        } else {
                        $userName = 'Guest'; 
                        echo "No rows found.";
                        }
                        } else {
                        
                        $userName = 'Guest'; 
                        echo "Database query failed: " . mysqli_error($conn);
                        }
                        ?>

                            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <span class="mr-2 d-none d-lg-inline text-gray-600 small">
                                    <?php echo htmlspecialchars($userName); ?>
                                </span>
                                <img class="img-profile rounded-circle" src="img/undraw_profile.svg">
                            </a>

                            <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in"
                                aria-labelledby="userDropdown">
                                <a class="dropdown-item" href="#">
                                    <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>Profile </a>
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
                                            <h3 class="mb-5">Employee Edit Form</h3>
                                            <!-- Form Start -->
                                            <form action="edit.php" method="POST">
                                                <div class="row">
                                                    <div class="col-md-6 mb-4">
                                                        <div data-mdb-input-init class="form-outline">
                                                            <input type="text" class="form-control"
                                                                id="exampleInputName" name="name"
                                                                value="<?php echo isset($row['name']) ? $row['name'] : ''; ?>"
                                                                required>
                                                            <label class="form-label"
                                                                for="exampleInputName">Name</label>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div data-mdb-input-init class="form-outline mb-4">
                                                    <input type="email" class="form-control" id="exampleInputEmail"
                                                        name="email"
                                                        value="<?php echo isset($row['email']) ? $row['email'] : ''; ?>"
                                                        required>
                                                    <label class="form-label" for="exampleInputEmail">Email</label>
                                                </div>

                                                <div class="form-floating mb-4">
                                                    <textarea class="form-control" placeholder="Leave a comment here"
                                                        name="assignment" id="floatingTextarea2" style="height: 100px"
                                                        ><?php echo isset($row['assignment']) ? $row['assignment'] : ''; ?></textarea>
                                                    <label for="floatingTextarea2">Task</label>
                                                </div>


                                                <div class="mb-3">
                                                    <label for="exampleInputName" class="form-label">Task Status</label>
                                                    <input type="text" class="form-control" id="exampleInputName"
                                                        name="task"
                                                        value="<?php echo isset($row['task']) ? $row['task'] : ''; ?>"
                                                        required>
                                                </div>


                                                <div class="d-flex justify-content-end pt-3">

                                                    <input type="hidden" name="id"
                                                        value="<?php echo isset($row['id']) ? $row['id'] : ''; ?>">
                                                    <button type="button" class="btn btn-light btn-lg"
                                                        onclick="window.location.href='view.php'">Reset all</button>
                                                    <button type="submit" class="btn btn-warning btn-lg ms-2">Submit
                                                        form</button>
                                                </div>
                                            </form>
                                            <!-- Form End -->
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Scroll to Top Button-->
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
                        <a class="btn btn-primary" href="login.html">Logout</a>
                    </div>
                </div>
            </div>
        </div>

        <!-- Bootstrap core JavaScript-->
        <!-- <script src="vendor/jquery/jquery.min.js"></script> -->
        <!-- <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script> -->
        <!-- <script src="vendor/jquery-easing/jquery.easing.min.js"></script> -->
        <!-- <script src="js/sb-admin-2.min.js"></script> -->
        <script src="vendor/datatables/jquery.dataTables.min.js"></script>
        <script src="vendor/datatables/dataTables.bootstrap4.min.js"></script>
        <script src="js/demo/datatables-demo.js"></script>
</body>

</html>