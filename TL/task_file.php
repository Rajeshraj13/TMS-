<?php
session_start();
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>TL Dashboard</title>

    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">
    <!-- <link href="css/sb-admin-2.min.css" rel="stylesheet"> -->
    <link href="css/sb-admin-2.css" rel="stylesheet">
    <link href="vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css"
        integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
</head>

<body id="page-top">
    <div id="wrapper">
        <ul class="navbar-nav bg-gradient-info sidebar sidebar-dark accordion" id="accordionSidebar">

            <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index_tl.php">
                <div class="sidebar-brand-icon rotate-n-15">
                    <i class="bi bi-apple"></i>
                </div>
                <div class="sidebar-brand-text mx-3 ">EMS Admin</div>
            </a>

            <hr class="sidebar-divider my-0">

            <li class="nav-item active">
                <a class="nav-link" href="index_tl.php">
                    <i class="fas fa-fw fa-tachometer-alt"></i>
                    <span>Dashboard</span></a>
            </li>

            <li class="nav-item">
                <a class="nav-link collapsed" href="" data-toggle="collapse" data-target="#collapsePages"
                    aria-expanded="true" aria-controls="collapsePages">
                    <i class="fas fa-fw fa-folder"></i>
                    <span>Manage Information</span>
                </a>
                <div id="collapsePages" class="collapse" aria-labelledby="headingPages" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <a class="collapse-item" href="manage_admin.php">Employee Information</a>
                    </div>
                </div>
            </li>

            <li class="nav-item">
                <a class="nav-link collapsed" href="" data-toggle="collapse" data-target="#collapsePagesTask"
                    aria-expanded="true" aria-controls="collapsePagesTask">
                    <i class="fas fa-fw fa-folder"></i>
                    <span>Task</span>
                </a>
                <div id="collapsePagesTask" class="collapse" aria-labelledby="headingPagesTask"
                    data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <a class="collapse-item" href="add_task.php">Add Task</a>
                        <a class="collapse-item" href="view.php">View</a>
                    </div>
                </div>
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
                                    <P>
                                        <?php echo htmlspecialchars($row["Name"]); ?>
                                    </P>
                                </span>
                                <img class="img-profile rounded-circle" src="images/images.jpeg">
                            </a>



                            <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in"
                                aria-labelledby="userDropdown">

                                <div class="dropdown-divider"></div>

                                <a class="dropdown-item" href="#" data-toggle="modal" data-target="#profile">
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

            <div class="container">
            <h4>Task Files</h4>
            <div class="card shadow mb-4">
                <div class="card-body">
                    <div class="table-responsive">
                      <div class="table-scroll">
                        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th scope="col">Id</th>
                                    <th scope="col">File Name</th>
                                    <th scope="col" style="text-align:center;">Download</th>
                                    <th scope="col" style="text-align:center;">Delete</th>
                                    <th scope="col" style="text-align:center;">Uploader</th>
                                </tr>
                            </thead>
                            <tbody>
                              <?php
                                include "../connection.php";
                                $sql = "SELECT * FROM uploaded_files";
                                $result = $conn->query($sql);
                                if ($result->num_rows > 0) {
                                    while ($row = $result->fetch_assoc()) {
                                        $id = $row["id"];
                                        $fileName = $row["file_name"];
                                        $filePath = $row["file_path"];
                                        $uploaderName = $row["uploaderName"];
                                        echo "<tr>";
                                        echo "<td>$id</td>";
                                        echo "<td>$fileName</td>";
                                        echo "<td style='text-align:center;'><a href='download.php?id=$id'><i class='fas fa-download'></i></a></td>";
                                        echo "<td style='text-align:center;'><a href='filedelete.php?id=$id'><i class='fas fa-trash-alt'></i></a></td>";
                                        echo "<td style='text-align:center;'>$uploaderName</td>";
                                        echo "</tr>";
                                    }
                                } else {
                                    echo "<tr><td colspan='5'>No files uploaded yet.</td></tr>";
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
</div>
    
    <a class="scroll-to-top rounded" href="#page-top">
    <i class="fas fa-angle-up"></i>
</a>

<!-- Logout Modal-->
<div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Ready to Logout?</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
            <div class="modal-footer">
                <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                <a class="btn btn-primary" href="../index1.php">Logout</a>
            </div>
        </div>
    </div>
</div>

<!-- Profile Modal -->
<div class="modal dark" id="profile" tabindex="-1" role="dialog" aria-labelledby="profileModalLabel" aria-hidden="true">
    <div class="modal-dialog " role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="profileModalLabel" style="color: red;">Admin Profile</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <?php
                include "../connection.php";

                // Check if the user is logged in
                if(isset($_SESSION['Email'])) {
                    $Email = $_SESSION['Email'];
                    
                    // SQL query to fetch user information
                    $sql = "SELECT * FROM admin_registration WHERE Email = ?";
                    $stmt = mysqli_prepare($conn, $sql);
                    
                    if ($stmt) {
                        mysqli_stmt_bind_param($stmt, "s", $Email);
                        mysqli_stmt_execute($stmt);
                        
                        // Get the result
                        $result = mysqli_stmt_get_result($stmt);
                        
                        // Fetch the associative array
                        if ($row = mysqli_fetch_assoc($result)) {
                            $userName = $row['Name'];
                            $password = $row['Email'];
                            $phone = $row['Phone'];
                        } else {
                            $userName = 'Guest';
                            echo "No rows found.";
                        }
                        
                        mysqli_stmt_close($stmt);
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

                <p>UserName: <?php echo htmlspecialchars($userName); ?></p>
                <p>Email: <?php echo htmlspecialchars($password); ?></p>
                <p>Phone: <?php echo htmlspecialchars($phone); ?></p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

<script src="vendor/jquery/jquery.min.js"></script>
<script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="vendor/jquery-easing/jquery.easing.min.js"></script>
<script src="js/sb-admin-2.min.js"></script>
<script src="vendor/chart.js/Chart.min.js"></script>
<script src="js/demo/chart-area-demo.js"></script>
<script src="js/demo/chart-pie-demo.js"></script>
<script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.11.5/js/dataTables.bootstrap5.min.js"></script>

<script>
    $(document).ready(function () {
        $('#dataTable').DataTable();
    });
</script>
