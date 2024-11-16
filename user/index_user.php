<?php
session_start();
include "../connection.php";
?>



<!DOCTYPE html>
<html lang="en">

<head>
    <script type="text/javascript">
        window.history.forward();
        function noBack() { window.history.forward(); }
        noBack();
        window.onload = noBack;
        window.onpageshow = function (evt) { if (evt.persisted) noBack(); }
        window.onunload = function () { void (0); }
    </script>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>User Dashboard</title>

    <!-- <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css"> -->
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">
    <link href="css/sb-admin-2.css" rel="stylesheet">
    <link rel="stylesheet" href="./index_user.css">
    <!-- <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css"> -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css"
        integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />

    <style>
        .card1 {
            box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2);
            margin: auto;
            text-align: center;
            font-family: arial;
        }

        .our-team {
            padding: 30px 0 40px;
            margin-bottom: 30px;
            background-color: #f5d86e;
            text-align: center;
            overflow: hidden;
            position: relative;
        }

        .our-team .picture {
            display: inline-block;
            height: 130px;
            width: 130px;
            margin-bottom: 50px;
            z-index: 1;
            position: relative;
        }

        .our-team .picture::before {
            content: "";
            width: 100%;
            height: 0;
            border-radius: 50%;
            background-color: #f5926e;
            position: absolute;
            bottom: 135%;
            right: 0;
            left: 0;
            opacity: 0.9;
            transform: scale(3);
            transition: all 0.3s linear 0s;
        }

        .our-team:hover .picture::before {
            height: 100%;
        }

        .our-team .picture::after {
            content: "";
            width: 100%;
            height: 100%;
            border-radius: 50%;
            background-color: #f211d0;
            position: absolute;
            top: 0;
            left: 0;
            z-index: -1;
        }

        .our-team .picture img {
            width: 100%;
            height: auto;
            border-radius: 50%;
            transform: scale(1);
            transition: all 0.9s ease 0s;
        }

        .our-team:hover .picture img {
            box-shadow: 0 0 0 14px #f7f5ec;
            transform: scale(0.7);
        }

        .our-team .title {
            display: block;
            font-size: 15px;
            color: #4e5052;
            text-transform: capitalize;
        }


        .our-team .social {
            width: 100%;
            padding: 0;
            margin: 0;
            background-color: #60db8e;
            position: absolute;
            bottom: -100px;
            left: 0;
            transition: all 0.5s ease 0s;
        }

        .our-team:hover .social {
            bottom: 0;
        }
        .scrollable-content {
    max-height: 400px; 
    overflow-y: auto; 
    overflow-x: hidden;
}

    </style>

</head>

<body id="page-top">
    <div id="wrapper">
        <ul class="navbar-nav bg-gradient-info sidebar sidebar-dark accordion" id="accordionSidebar">
            <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index_user.php">
                <div class="sidebar-brand-icon rotate-n-15">
                    <i class="bi bi-apple"></i>
                </div>
                <div class="sidebar-brand-text mx-3">EMS USER</div>
            </a>

            <hr class="sidebar-divider my-0">
            <li class="nav-item active">
                <a class="nav-link" href="index_user.php">
                    <i class="fas fa-fw fa-tachometer-alt"></i>
                    <span>Dashboard</span></a>
            </li>


            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapsePages"
                    aria-expanded="true" aria-controls="collapsePages">
                    <i class="fas fa-fw fa-folder"></i>
                    <span>Task</span>
                </a>
                <div id="collapsePages" class="collapse" aria-labelledby="headingPages" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <a class="collapse-item" href="view.php ">View</a>
                    </div>
                </div>

            </li>


            <li class="nav-item">
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
                    <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
                        <i class="fa fa-bars"></i>
                    </button>

                    <?php
                    include "../connection.php";
                    $email = $_SESSION['email']; 
                    $sql = "SELECT name FROM add_user WHERE email = '$email'";
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

                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        <h6> Welcome Back<strong>
                                <?php echo htmlspecialchars($userName); ?>
                            </strong> </h6>
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>


                    <ul class="navbar-nav ml-auto">
                        <li class="nav-item dropdown no-arrow d-sm-none">
                            <!-- Dropdown - Messages -->
                            <div class="dropdown-menu dropdown-menu-right p-3 shadow animated--grow-in"
                                aria-labelledby="searchDropdown">
                                <form class="form-inline mr-auto w-100 navbar-search">
                                    <div class="input-group">
                                        <input type="text" class="form-control bg-light border-0 small"
                                            placeholder="Search for..." aria-label="Search"
                                            aria-describedby="basic-addon2">
                                        <div class="input-group-append">
                                            <button class="btn btn-primary" type="button">
                                                <i class="fas fa-search fa-sm"></i>
                                            </button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </li>

                        <li class="nav-item dropdown no-arrow">


                            <!-- fetch the user name -->

                            <?php
                            include "../connection.php";
                            $email = $_SESSION['email']; 
                            $sql = "SELECT name FROM add_user WHERE email = '$email'";
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

                            <!-- fetch user-image    -->
                            <?php
                            // Include the file for database connection
                            include "../connection.php";

                        
                            if (!isset($_SESSION["email"])) {
                            // Redirect the user to the login page if not logged in
                            header("Location: login.php");
                            exit();
                            }

                            // Fetch user details including image path
                            $email = $_SESSION["email"];
                            $sql = "SELECT * FROM `reg-information` WHERE `email` = ?";
                            $stmt = $conn->prepare($sql);
                            $stmt->bind_param("s", $email);
                            $stmt->execute();
                            $result = $stmt->get_result();

                            if ($result->num_rows == 1) {
                            $row = $result->fetch_assoc();
                            // Assuming the column name for the image path is 'imageUpload'
                            $userImage = $row["imageUpload"];
                            } else {
                            // Handle the case where user details are not found
                            echo "User details not found.";
                            exit();
                            }

                            $stmt->close();
                            ?>

                            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <span class="mr-2 d-none d-lg-inline text-gray-600 small">
                                    <?php echo htmlspecialchars($userName); ?>
                                </span>
                                <?php if (!empty($userImage)) { ?>
                                <img src="../admin/admin/images/<?php echo $userImage; ?>" alt="User Image"
                                    class="img-profile" style='border-radius:50%; width:40px; height:40px;'>

                                <?php } else { ?>
                                <p>No image found for the user.</p>
                                <?php } ?>
                            </a>



                            <!-- Dropdown - User Information -->

                            <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in"
                                aria-labelledby="userDropdown">
                                <div class="dropdown-divider"> </div>

                                <a class="dropdown-item" href="#" data-toggle="modal" data-target="#profileModal">
                                    <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Profile
                                </a>

                                <a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal">
                                    <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Logout
                                </a>
                            </div>
                        </li>

                    </ul>

                </nav>


                <div class="container-fluid ">

                    <div class="d-sm-flex align-items-center justify-content-between mb-4 ">
                        <h1 class="h3 mb-0 text-gray-800">Dashboard</h1>
                    </div>


                    
                    <div class="row">
                        <div class="col-xl-6 col-md-6 mb-5">
                            <div class="card border-left-primary shadow h-100 py-2">
                                
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Task
                                                Status</div>

                                            <?php

                                                include "../connection.php";
                                                $email = $_SESSION['email']; 
                                                
                                                $sql_completed = "SELECT COUNT(id) AS completed_tasks FROM add_user WHERE email = '$email' AND assignment_status = 1";
                                                $result_completed = $conn->query($sql_completed);
                                                
                                                if (!$result_completed) {
                                                    die("Error fetching completed tasks: " . $conn->error);
                                                }
                                                
                                                $row_completed = $result_completed->fetch_assoc();
                                                $completed_tasks = $row_completed['completed_tasks'];
                                                
                                                // Query to fetch pending tasks
                                                $sql_pending = "SELECT COUNT(id) AS pending_tasks FROM add_user WHERE email = '$email' AND assignment_status = 0";
                                                $result_pending = $conn->query($sql_pending);
                                                
                                                if (!$result_pending) {
                                                    die("Error fetching pending tasks: " . $conn->error);
                                                }
                                                
                                                $row_pending = $result_pending->fetch_assoc();
                                                $pending_tasks = $row_pending['pending_tasks'];

                                        
                                            ?>

                                            <div class="profile-info">
                                                <p>Completed Tasks:
                                                    <?php echo $completed_tasks; ?>
                                                </p>
                                                <p>Pending Tasks:
                                                    <?php echo $pending_tasks; ?>
                                                </p>
                                            </div>
                                        </div>

                                        <div class="col-auto">
                                            <i class="fas fa-clipboard-list fa-2x text-gray-300"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>


                        <div class="col-xl-6 col-md-6 mb-4">
                            <div class="card border-left-danger shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">

                                            <a href="view.php">
                                                <div class="text-xs font-weight-bold text-info text-uppercase mb-1">
                                                    Overall Tasks
                                                </div>
                                            </a>

                                            <?php

                                                   $email = $_SESSION['email']; 
                                                   $sql = "SELECT COUNT(*) AS task FROM add_user WHERE email = '$email'";   
                                                   $result = mysqli_query($conn, $sql);
                                                         
                                                     if ($result && mysqli_num_rows($result) > 0) {
                                                         $row = mysqli_fetch_assoc($result);
                                                         $total = $row['task'];
                                                         echo '<h4 class="mb-0">' . $total . '</h4>';
                                                     } else {
                                                         echo '<h4 class="mb-0">No Data</h4>';
                                                     }

                                                 ?>
                                        </div>

                                        <div class="col-auto">
                                            <i class="fas fa-clipboard-list fa-2x text-gray-300"></i>
                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>


                    <div class="row">
                        <div class="col-lg-6 mt-3 mb-5">
                            <div class="card card-body card border-left-warning shadow  h-100">
                                <h4 class="text-dark header-title">Leave Info</h4>
                                <ul class="sortable-list taskList list-unstyled ui-sortable" id="upcoming">
                                    <li class="task-warning ui-sortable-handle" id="task1">
                                        <div class="d-flex justify-content-between align-items-center mt-3">
                                            <div class="logo">
                                                <i class="fa-solid fa-clipboard-user fa-3x text-gray-500"></i>
                                            </div>
                                            <div>
                                                <button type="button"
                                                    class="btn btn-outline-success btn-sm waves-effect waves-light"
                                                    data-toggle="modal" data-target="#attendanceModal1">View</button>
                                            </div>
                                        </div>
                                    </li>
                                </ul>
                            </div>
                        </div>


                        <div class="col-lg-6 mb-5">
                            <div class="card border-left-info shadow h-80">
                                <div class="card-body">
                                    <h4 class="text-dark header-title">Your Task</h4>

                                    <ul class="sortable-list taskList list-unstyled ui-sortable" id="upcoming">
                                        <li class="task-warning ui-sortable-handle" id="task1">

                                            <?php
                                                include "../connection.php";
                
                                                $email = $_SESSION['email']; 
                                                                                        
                                                // Fetch assignment and name in a single query
                                                $sql = "SELECT assignment FROM add_user WHERE email = '$email'";
                                                $query = mysqli_query($conn, $sql);
                                                                                        
                                                if ($query) {
                                                $result = mysqli_fetch_assoc($query);
                                                if ($result) {
                                                $assignment = htmlspecialchars($result['assignment']);
                                                
                                                ?>
                                            <div class="checkbox checkbox-custom checkbox-single float-right">
                                                <?php echo $assignment; ?>
                                            </div>
                                            <div class="clearfix"></div>
                                            <div class="mt-3">
                                                <p class="float-right mb-0 mt-2">
                                                    <a href="view.php"
                                                        class="btn btn-success btn-sm waves-effect waves-light">View</a>
                                                </p>
                                            </div>
                                            <?php
                                                } else {
                                                echo "No rows found.";
                                                }
                                                } else {
                                                echo "Database query failed: " . mysqli_error($conn);
                                                }
                                            ?>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="modal fade" id="attendanceModal1" tabindex="-1" aria-labelledby="attendanceModalLabel1"
                        aria-hidden="true">
                        <div class="modal-dialog">

                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="attendanceModalLabel1">Attendance
                                        Details</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>

                                <div class="modal-body">
                                    <?php
                                            include "../connection.php";
                                            // !isset() function returns true if the variable is not set or is null, and false otherwise
                                            if (!isset($_SESSION["email"])) {
                                            header("Location: login.php");
                                            exit();
                                            }
                                            $email = $_SESSION["email"];
                                            // Fetch user details
                                            $sql = "SELECT * FROM `reg-information` WHERE `email` = ?";
                                            $stmt = $conn->prepare($sql);
                                            $stmt->bind_param("s", $email);
                                            $stmt->execute();
                                            $result = $stmt->get_result();
                                            if ($result->num_rows == 1) {
                                            $row = $result->fetch_assoc();
                                            $userId = $row["emp_id"];
                                            
                                            // Prepare SQL to fetch absent dates
                                            $sql = "SELECT a.attendance_date, a.status 
                                            FROM attendance a 
                                            JOIN `reg-information` e ON a.emp_id = e.emp_id 
                                            WHERE a.emp_id = ? AND a.status = 'Absent'";
                                            $stmt = $conn->prepare($sql);
                                            $stmt->bind_param("i", $userId);
                                            $stmt->execute();
                                            $result = $stmt->get_result();
                                        ?>

                                    <div class="container mt-4">
                                        <div class="card shadow mb-5">
                                            <div class="card-body">
                                                <h4 class="card-title">Absent Dates</h4>
                                                <div class="list-group">
                                                    <?php 
                                                            if ($result->num_rows > 0) {
                                                            while($row = $result->fetch_assoc()) {
                                                            echo "<div class='list-group-item'>";
                                                            echo "<h5 class='mb-1'>Date: " . htmlspecialchars($row['attendance_date']) . "</h5>";
                                                            echo "<p class='mb-1'>Status: " . htmlspecialchars($row['status']) . "</p>";
                                                            echo "</div>";
                                                            }
                                                            } else {
                                                            echo "<div class='list-group-item text-center'>No absent records found</div>";
                                                            }
                                                         ?>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <?php
                                            } else {
                                            echo "User details not found.";
                                            exit();
                                            }
                                            $stmt->close();
                                            $conn->close();
                                         ?>

                                </div>

                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>


                <div class="row d-flex justify-content-center">
                    <div class="col-lg-4">
                        <div class="card card-body mb-2">

                            <?php
                                include "../connection.php";
                                // Check if the user is logged in
                                if(isset($_SESSION['email'])) {
                                $email = $_SESSION['email']; 
                                
                                // SQL query to fetch user information
                                $sql = "SELECT * FROM `reg-information` WHERE email = '$email'";
                                $query = mysqli_query($conn, $sql);
                                
                                if ($query) {
                                $result = mysqli_fetch_assoc($query);
                                if ($result) {
                                $userName = $result['name'];
                                $password = $result['email'];
                                $Role = $result['role'];
                                } else {
                                $userName = 'Guest'; 
                                echo "No rows found.";
                                }
                                } else {
                                $userName = 'Guest'; 
                                echo "Database query failed: " . mysqli_error($conn);
                                }
                                } else {
                                // If user is not logged in, set default values
                                $userName = 'Guest';
                                $password = '';
                                $phone = '';
                                }
                            ?>

                            <div class="our-team">
                                <div class="picture">
                                    <?php if (!empty($userImage)) { ?>
                                    <img class="img-fluid" src="../admin/admin/images/<?php echo $userImage; ?>"
                                        alt="User Image" class="img-profile"
                                        style='border-radius:50%; width:130px; height:130px;'>
                                    <?php } else { ?>
                                    <p>No image found for the user.</p>
                                    <?php } ?>
                                </div>

                                <div class="team-content">
                                    <h3 class="name">
                                        <?php echo htmlspecialchars($userName); ?>
                                    </h3>
                                    <h4 class="title">
                                        <?php echo htmlspecialchars($Role); ?>
                                    </h4>
                                </div>

                                <ul class="social">
                                    <a href="edit_img.php">.</a>
                                </ul>
                            </div>

                        </div>
                    </div>
                </div>

                <a class="scroll-to-top rounded" href="#page-top">
                    <i class="fas fa-angle-up"></i>
                </a>

                <!-- Logout Modal-->
                <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="logoutModalLabel"
                    aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="logoutModalLabel">Ready to Logout?</h5>
                                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">×</span>
                                </button>
                            </div>
                            <div class="modal-body">Select "Logout" below if you are ready to end
                                your current session.</div>
                            <div class="modal-footer">
                                <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                                <a class="btn btn-primary" href="../index1.php">Logout</a>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="modal fade" id="profileModal" tabindex="-1" role="dialog"
                    aria-labelledby="profileModalLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="profileModalLabel">Profile</h5>
                                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">×</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <!-- Profile content goes here -->
                                <h4>Profile:</h4>

                                <?php
                                                        include "../connection.php";
                                                        // Check if the user is logged in
                                                        if(isset($_SESSION['email'])) {
                                                        $email = $_SESSION['email']; 
                                                        
                                                        // SQL query to fetch user information
                                                        $sql = "SELECT * FROM `reg-information` WHERE email = ?";
                                                        $stmt = $conn->prepare($sql);
                                                        $stmt->bind_param("s", $email);
                                                        $stmt->execute();
                                                        $result = $stmt->get_result();
                                                         //condition checks if the number of rows in the result set is exactly one. 
                                                        // This means that the query returned exactly one row, indicating that a matching user was found in the database.
                                                        if ($result->num_rows == 1) {
                                                        $row = $result->fetch_assoc();
                                                        $userName = $row['name'];
                                                        $password = $row['email'];
                                                        $phone = $row['phone'];
                                                        } else {
                                                        $userName = 'Guest'; 
                                                        echo "No rows found.";
                                                        }
                                                        } else {

                                                        // If user is not logged in, set empty values
                                                        $userName = 'Guest';
                                                        $password = '';
                                                        $phone = '';
                                                        }
                                                    ?>

                                <p>Username:
                                    <?php echo htmlspecialchars($userName); ?>
                                </p>
                                <p>Email:
                                    <?php echo htmlspecialchars($password); ?>
                                </p>
                                <p>Phone:
                                    <?php echo htmlspecialchars($phone); ?>
                                </p>
                            </div>
                            <div class="modal-footer">
                                <button class="btn btn-danger" type="button" data-dismiss="modal">Close</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <script src="vendor/jquery/jquery.min.js"></script>
        <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
        <script src="vendor/jquery-easing/jquery.easing.min.js"></script>
        <script src="js/sb-admin-2.min.js"></script>
</body>

</html>