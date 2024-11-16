
<?php
session_start();

include "../connection.php";
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
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">
    <link href="css/sb-admin-2.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css"
        integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link href="vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

</head>

<style>

    .table-scroll {
        max-height: 550px;
        /* Adjust max-height as needed */
        overflow-y: auto;
    }
    
</style>

<body id="page-top">
    <div id="wrapper">
        <ul class="navbar-nav bg-gradient-info sidebar sidebar-dark accordion" id="accordionSidebar">

            <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.php">
                <div class="sidebar-brand-icon rotate-n-15">
                    <i class="bi bi-apple"></i>
                </div>
                <div class="sidebar-brand-text mx-3">EMS Admin</div>
            </a>

            <hr class="sidebar-divider my-0">

            <li class="nav-item">
                <a class="nav-link" href="index.php">
                    <i class="fas fa-fw fa-tachometer-alt"></i>
                    <span>Dashboard</span></a>
            </li>

            <hr class="sidebar-divider">

            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapsePages"
                    aria-expanded="true" aria-controls="collapsePages">
                    <i class="fas fa-fw fa-folder"></i>
                    <span>Task</span>
                </a>
                <div id="collapsePages" class="collapse" aria-labelledby="headingPages" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <a class="collapse-item" href="add_task.php">Add Task</a>
                        <a class="collapse-item" href="view.php">View</a>
                    </div>
                </div>
            </li>

            <li class="nav-item active">
                <a class="nav-link" href="tables.php">
                    <i class="fas fa-fw fa-table"></i>
                    <span>Tables</span></a>
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
                                if (isset($_SESSION['Email'])) {
                                $Email = $_SESSION['Email'];
                                
                                $sql = "SELECT Name FROM admin_registration WHERE Email = ?";
                                $stmt = mysqli_prepare($conn, $sql);
                                
                                if ($stmt) {
                                mysqli_stmt_bind_param($stmt, "s", $Email);
                                
                                // Execute the query
                                mysqli_stmt_execute($stmt);
                                
                                // Get the result
                                $result = mysqli_stmt_get_result($stmt);
                                
                                // Fetch the associative array
                                if ($row = mysqli_fetch_assoc($result)) {
                                $Name = $row['Name'];
                                } else {
                                $Name = 'Guest';
                                }
                                mysqli_stmt_close($stmt);
                                } else {
                                $Name = 'Guest';
                                echo "Database query failed: " . mysqli_error($conn);
                                }
                                } else {
                                $Name = 'Guest';
                                } 
                            ?>                              


                            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <span class="mr-2 d-none d-lg-inline text-gray-600 small">
                                    <?php echo htmlspecialchars($Name); ?>
                                </span>
                              <img class="img-profile rounded-circle" src="images/people.jpeg">
                            </a>

                            <!-- Dropdown - User Information -->
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


                <div id="attendance-sheet" data-spy="scroll" data-target="#navbar-example" data-offset="100">
                    <div class="container-fluid">
                    <?php
                        if (isset($_GET["msg"])) {
                        $msg = $_GET["msg"];

                        $msg = "File Deleted Sucessfully"; // Example message

                        echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">';
                        echo $msg;
                        echo '<button type="button" class="close" data-dismiss="alert" aria-label="Close">';
                        echo '<span aria-hidden="true">&times;</span>';
                        echo '</button>';
                        echo '</div>';
                        }
                    ?>

                        <h1 class="h3 mb-2 text-gray-800">Employee Task Information</h1>
                        <div class="card shadow mb-4">
                            <div class="card-header py-3">
                                <h6 class="m-0 font-weight-bold text-primary">Data Information</h6>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <div class="table-scroll">
                                        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                            <thead>
                                                <tr>
                                                    <th>ID</th>
                                                    <th>Name</th>
                                                    <th>Email</th>
                                                    <!-- <th>Phone</th> -->
                                                    <th>Task</th>
                                                    <th>Action</th>
                                                    <th>Status</th>
                                                    <th>Task Status</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                $sql = "SELECT * FROM add_user";
                                                $result = $conn->query($sql);
                                                if ($result->num_rows > 0) {
                                                while ($row = $result->fetch_assoc()) {
                                                echo "<tr>";
                                                echo "<th>" . $row['id'] . "</th>";
                                                echo "<td>" . $row['name'] . "</td>";
                                                echo "<td>" . $row['email'] . "</td>";
                                                // echo "<td>" . $row['Phone'] . "</td>";
                                                echo "<td>" . $row['assignment'] . "</td>";

                                                echo "<td>
                                                <a href='edit.php?id=" . $row['id'] . "'><i class='fa-regular fa-pen-to-square me-3'></i></a>
                                                <a href='delete.php?id=" . $row['id'] . "' onclick='return confirm(\"Are you sure you want to delete this record?\");'><i class='fa-solid fa-trash'></i></a>
                                                </td>";

                                                echo "<td>";
                                                if ($row['assignment_status'] == 1) {
                                                echo '<a href="status.php?id=' . $row['id'] . '&status=0" class="btn btn-success">Complete</a>';
                                                } else {
                                                echo '<a href="status.php?id=' . $row['id'] . '&status=1" class="btn btn-danger">Pending</a>';
                                                }
                                                echo "</td>";

                                                echo "<td>" . $row['task'] . "</td>";
                                                echo "</tr>";
                                                }
                                                } else {
                                                echo "<tr><td colspan='8'>No records found</td></tr>";
                                                }
                                                $conn->close();
                                             ?>
                                            </tbody>
                                        </table>
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
                        <div class="modal-body">Select "Logout" below if you are ready to end your current session.
                        </div>
                        <div class="modal-footer">
                            <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                            <a class="btn btn-primary" href="../index1.php">Logout</a>
                        </div>
                    </div>
                </div>
            </div>



            <script src="vendor/jquery/jquery.min.js"></script>
            <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
            <script src="vendor/jquery-easing/jquery.easing.min.js"></script>
            <script src="js/sb-admin-2.min.js"></script>
            <script src="vendor/datatables/jquery.dataTables.min.js"></script>
            <script src="vendor/datatables/dataTables.bootstrap4.min.js"></script>
            <script src="js/demo/datatables-demo.js"></script>
            <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
                integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM"
                crossorigin="anonymous"></script>

</body>
</html>