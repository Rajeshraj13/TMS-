<?php
session_start();
include "../connection.php";

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $sql = "DELETE FROM admin_registration WHERE id = ?";

    if ($stmt = $conn->prepare($sql)) {
        $stmt->bind_param("i", $id);

        if ($stmt->execute()) {

            header("Location: manage_attendance.php?msg=Record deleted successfully");
            
            exit();
        } else {
    
            header("Location:  manage_attendance .php?msg=Error deleting record");
            exit();
        }
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
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">
    <link href="css/sb-admin-2.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css"
        integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link href="vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    <style>
        .form-check-label {
            margin-right: 15px;
        }

        .table td,
        .table th {
            vertical-align: middle;
        }

        .table th {
            text-align: center;
        }

        .table-responsive {
            overflow-x: auto;
        }

        .btn-primary {
            background-color: #4e73df;
            border-color: #4e73df;
        }

        .btn-primary:hover {
            background-color: #2e59d9;
            border-color: #2653d4;
        }

        .form-check-input[type=radio] {
            position: absolute;
            opacity: 0;
            pointer-events: none;
        }

        .form-check-label {
            display: inline-block;
            padding: .5rem 1rem;
            font-size: 1rem;
            cursor: pointer;
            border: 1px solid #ced4da;
            border-radius: .25rem;
            background-color: gray;
        }

        /* Default styles for form-check-input and form-check-label */
        .form-check-input {
            margin-top: 3px;
        }

        .form-check-label {
            margin-left: 5px;
            cursor: pointer;
        }

        /* Styles for 'Present' option */
        .form-check-input[value='Present']:checked+.form-check-label {
            background-color: #28a745;
            /* Green color for Present */
            color: #fff;
            /* White text color */
        }

        /* Styles for 'Absent' option */
        .form-check-input[value='Absent']:checked+.form-check-label {
            background-color: #dc3545;
            /* Red color for Absent */
            color: #fff;
            /* White text color */
        }

        /* Styles for 'Leave' option */
        .form-check-input[value='Leave']:checked+.form-check-label {
            background-color: #ffc107;
            /* Yellow color for Leave */
            color: #212529;
            /* Dark text color */
        }

        .btn-primary {
            background-color: #4e73df;
            border-color: #4e73df;
        }

        .btn-primary:hover {
            background-color: #2e59d9;
            border-color: #2653d4;
        }

        .breadcrumb>li+li:before {
            content: "" !important;
        }

        .breadcrumb {
            padding: 25px;
            font-size: 14px;
            color: #aaa !important;
            letter-spacing: 2px;
            border-radius: 5px !important;
        }

        .first-1 {
            background-color: white !important;
        }

        a {
            text-decoration: none !important;
            color: #aaa !important;
        }

        a:focus,
        a:active {
            outline: none !important;
            box-shadow: none !important;
        }

        img {
            vertical-align: bottom;
            opacity: 0.3;
        }

        .first span {
            color: black;
        }

        .active-1,
        .active-2 {
            font-size: 13px !important;
            padding-bottom: 12px !important;
            padding-top: 12px !important;
            padding-right: 25px !important;
            padding-left: 25px !important;
            border-radius: 200px !important;
            background-color: #F3E5F5 !important;
        }

        #home {
            vertical-align: middle !important;
        }

        @media (max-width: 567px) {
            .breadcrumb {
                font-size: 10px;
            }

            .breadcrumb-item+.breadcrumb-item {
                padding-left: 0;
            }

            img {
                width: 11px;
                height: 11px;
                vertical-align: middle;
            }

            #home {
                vertical-align: middle !important;
                width: 12px;
                height: 10px;
            }

            .active-1,
            .active-2 {
                font-size: 8px !important;
                padding-right: 8px !important;
                padding-left: 8px !important;
                background-color: F3E5F !important;
                width: 100% !important;
            }

            .breadcrumb {
                letter-spacing: 0px !important;
                padding: 26px;
                padding-left: 6px !important;
                padding-right: 6px !important;
            }

            .breadcrumb>* div {
                max-width: 60px;
            }

            li.breadcrumb-item {
                padding: 0 !important;
            }
        }
    </style>

</head>

<body id="page-top">
    <div id="wrapper">
        <ul class="navbar-nav bg-gradient-info sidebar sidebar-dark accordion" id="accordionSidebar">

            <a class="sidebar-brand d-flex align-items-center justify-content-center fixed-left" href="index.php">
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
                                $Name    = $row['Name'];
                                } else {
                                $Name    = 'Guest';
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
                                <img class="img-profile rounded-circle" src="img/undraw_profile.svg">
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


                <div class="container d-flex justify-content-center">
                    <nav aria-label="breadcrumb " class="first  d-md-flex">
                        <ol class="breadcrumb indigo lighten-6 first-1 shadow-lg mb-5  ">
                            <li class="breadcrumb-item "><a class="black-text active-2" href="atten.php"><img id="home"
                                        src="https://img.icons8.com/ios-filled/50/000000/dog-house.png"
                                        class="mr-md-2 mr-1 mb-1 " width="22" height="19"><span>Current</span></a><img
                                    class="ml-md-3 ml-1" src="https://img.icons8.com/metro/50/000000/chevron-right.png "
                                    width="20" height="20"> </li>
                            <li class="breadcrumb-item "><a class="black-text active-2" href="view_atten.php">View
                                    Attendance<span></span></a>
                        </ol>
                    </nav>
                </div>

                <div class="container-fluid">
                    <h1 class="h3 mb-2 text-gray-800 mb-5">Take Attendance</h1>
                    <div class="card shadow mb-4">
                        <div class="card-body">

                            <div class="table-responsive">
                                <?php if (isset($_GET['message'])): ?>
                                <div class="alert alert-<?php echo htmlspecialchars($_GET['alert']); ?> alert-dismissible fade show"
                                    role="alert">
                                    <?php echo htmlspecialchars($_GET['message']); ?>
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>

                                <?php endif; ?>
                                <div class="table-scroll">
                                    <form method="POST" action="manage_attendance.php">

                                        <div class="form-group">
                                            <label for="attendance_date">Select Date:</label>
                                            <input type="date" id="attendance_date" name="attendance_date"
                                                value="<?php echo date('Y-m-d'); ?>" max="<?php echo date('Y-m-d'); ?>"
                                                class="form-control" required>
                                        </div>

                                        <table class="table table-bordered" id="dataTable" width="120%" cellspacing="0">
                                            <thead>
                                                <tr>
                                                    <th>Emp_id</th>
                                                    <th>Name</th>
                                                    <th>Attendance Status</th>
                                                </tr>
                                            </thead>
                                            <tbody>

                                                <?php 
                                                    $sql = "SELECT emp_id, name FROM `reg-information`";
                                                    $result = $conn->query($sql);
                                                    if ($result->num_rows > 0) {
                                                    while($row = $result->fetch_assoc()) {
                                                    echo "<tr>";
                                                    echo "<td class='text-center'>" . $row['emp_id'] . "</td>";
                                                    echo "<td>" . $row['name'] . "</td>";
                                                    echo "<td class='text-center'>
                                                    <div class='form-check form-check-inline'>
                                                    <input class='form-check-input' type='radio' name='status[" . $row['emp_id'] . "]' id='present_" . $row['emp_id'] . "' value='Present' required>
                                                    <label class='form-check-label' for='present_" . $row['emp_id'] . "'>P</label>
                                                    </div>
                                                    <div class='form-check form-check-inline'>
                                                    <input class='form-check-input' type='radio' name='status[" . $row['emp_id'] . "]' id='absent_" . $row['emp_id'] . "' value='Absent'>
                                                    <label class='form-check-label' for='absent_" . $row['emp_id'] . "'>A</label>
                                                    </div>
                                                    <div class='form-check form-check-inline'>
                                                    <input class='form-check-input' type='radio' name='status[" . $row['emp_id'] . "]' id='leave_" . $row['emp_id'] . "]' value='Leave'>
                                                    <label class='form-check-label' for='leave_" . $row['emp_id'] . "]'>L</label>
                                                    </div>
                                                    </td>";
                                                    echo "</tr>";
                                                    }
                                                    } else {
                                                    echo "<tr><td colspan='3' class='text-center'>No records found</td></tr>";
                                                    }
                                              ?>
                                            </tbody>
                                        </table>

                                        <div class="text-center mb-3 mt-5">
                                            <button type="submit" class="btn btn-outline-success">Submit
                                                Attendance</button>
                                        </div>

                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>


                <div class="modal fade" id="addadmin" tabindex="-1" role="dialog" aria-labelledby="addUserModalLabel"
                    aria-hidden="true">

                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="addUserModalLabel">Add New Admin</h5>
                                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <form id="addUserForm1" method="post" action="">

                                    <div class="form-group">
                                        <label for="username">Name</label>
                                        <input type="username" class="form-control" id="username" name="Name" required>
                                    </div>

                                    <div class="form-group">
                                        <label for="username">Email</label>
                                        <input type="email" class="form-control" id="Email" name="Email" required>
                                    </div>

                                    <div class="form-group">
                                        <label for="password">Password</label>
                                        <input type="password" class="form-control" id="password" name="Password"
                                            required>
                                    </div>

                                    <div class="form-group">
                                        <label for="password">Phone</label>
                                        <input type="text" class="form-control" id="Phone" name="Phone" required>
                                    </div>

                                    <button type="submit" class="btn btn-primary">Add Admin</button>
                                </form>
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
</body>

</html>