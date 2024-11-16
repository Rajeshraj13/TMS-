<?php
session_start();
include "../connection.php";

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $sql = "DELETE FROM admin_registration WHERE id = ?";

    if ($stmt = $conn->prepare($sql)) {
        $stmt->bind_param("i", $id);

        if ($stmt->execute()) {

            header("Location: manage_admin.php?msg=Record deleted successfully");
            exit();
        } else {
    
            header("Location: manage_admin.php?msg=Error deleting record");
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

</head>

<style>
    .table-scroll {
        max-height: 550px;
        overflow-y: auto;
    }

    .breadcrumb {
        background-color: #c4c8f5;
        padding: 10px;
        border-radius: 5px;
        display: flex;
        list-style: none;
        margin: 0;
        overflow: hidden;
    }

    .breadcrumb-item {
        display: flex;
        align-items: center;
        font-size: 16px;
        color: #333;
    }

    .breadcrumb-item a {
        color: #333;
        text-decoration: none;
        display: flex;
        align-items: center;
        padding: 5px 10px;
        transition: color 0.3s ease;
    }

    .breadcrumb-item a:hover {
        color: #007bff;
    }

    .breadcrumb-item.active a {
        font-weight: bold;
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



                <!-- Intern Information start-->
                <div class="container d-flex justify-content-center">
                    <nav aria-label="breadcrumb " class="first  d-md-flex">
                        <ol class="breadcrumb indigo lighten-6 first-1 shadow-lg mb-5  ">
                            <li class="breadcrumb-item "><a class="black-text active-2" href=""><img id="home"
                                        src="https://img.icons8.com/ios-filled/50/000000/dog-house.png"
                                        class="mr-md-2 mr-1 mb-1 " width="22" height="19"><span>Current</span></a><img
                                    class="ml-md-3 ml-1" src="https://img.icons8.com/metro/50/000000/chevron-right.png "
                                    width="20" height="20"> </li>
                            <li class="breadcrumb-item "><a class="black-text active-2" href="index.php">
                                    Home<span></span></a>
                        </ol>
                    </nav>
                </div>
                
                <div id="attendance-sheet" data-spy="scroll" data-target="#navbar-example" data-offset="100">
                    <div class="d-flex justify-content-between align-items-center m-3">

                        <h1 class="h3 mb-0 text-dark">Add New Intern</h1>
                        <a class="btn btn-success" href="#" id="addUserBtn" data-toggle="modal"
                            data-target="#internModal">
                            <i class="fas fa-plus-circle mr-1"></i> <span>Add New Intern</span></a>
                    </div>

                    <div class="card shadow mb-4">

                        <?php
                        if (isset($_GET['msg']) && isset($_GET['status'])) {
                        $msg = $_GET['msg'];
                        $status = $_GET['status'];
                        $alertType = $status === 'success' ? 'alert-success' : 'alert-danger';
                        echo "<div class='alert $alertType alert-dismissible fade show' role='alert'>
                        $msg
                        <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
                        <span aria-hidden='true'>&times;</span>
                        </button>
                        </div>";
                        }
                     ?>

                        <div class="card-body">
                            <div class="table-responsive">
                                <div class="table-scroll">
                                    <table id="example1" class="table table-striped table-bordered table-sm"
                                        id="dataTable" width="120%" cellspacing="0">
                                        <thead>
                                            <tr>
                                                <th>Image</th>
                                                <th>Intern_id</th>
                                                <th>Name</th>
                                                <th>Email</th>
                                                <th>Contact</th>
                                                <th>Address</th>
                                                <th>Role</th>
                                                <th>Blood-Group</th>
                                                <th>College</th>
                                                <th>DoB</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>

                                            <?php 
                                            include "../connection.php";
                                          //  $sql= "SELECT `imageUpload`,`intern_id`, `name`, `email`, `contact`, `address`, `role`, `blood_group`, `college`,`dob` FROM `intern`";
                                          $sql= "SELECT `imageUpload`,`intern_id`, `name`, `email`, `contact`, `address`, `role`,`blood_group`, `college`, `dob` FROM intern";

                                            $result = $conn->query($sql);
                                            if (!$result) {
                                            die("Error executing query: " . $conn->error);
                                            }
                                            if ($result->num_rows > 0) {
                                            while($row = $result->fetch_assoc()) {
                                            echo "<tr>";
                                            //echo "<td>" . $row['imageUpload'] . "</td>";
                                            //echo "<td><img src='data:image/jpeg;base64," . base64_encode($row['imageUpload']) . "' width='100' height='100'></td>";
                                            echo "<td><img src='admin/images/" . $row['imageUpload'] . "' style='border-radius: 50%;' width='50' height='50'></td>";
                                            echo "<td>" . $row['intern_id'] . "</td>";
                                            echo "<td>" . $row['name'] . "</td>";
                                            echo "<td>" . $row['email'] . "</td>";
                                            echo "<td>" . $row['contact'] . "</td>";
                                            echo "<td>" . $row['address'] . "</td>";
                                            echo "<td>" . $row['role'] . "</td>";
                                            echo "<td>" . $row['blood_group'] . "</td>";
                                            echo "<td>" . $row['college'] . "</td>";
                                            echo "<td>" . $row['dob'] . "</td>";
                                            echo "<td class='action-links'>
                                            <a href='intern_edit.php?id=" . $row['intern_id'] . "'><i class='fa-regular fa-pen-to-square'></i></a>
                                            <a href='intern_delete.php?id=" . $row['intern_id'] . "' onclick='return confirm(\"Are you sure you want to delete this user?\")'><i class='fa-solid fa-trash'></i></a>
                                            </td>";
                                            echo "</tr>";
                                            echo "</tr>";
                                            }
                                            } else {
                                            echo "<tr><td colspan='11'>No records found</td></tr>";
                                            }
                                        ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>




                <!-- intern table information -->
                <?php
            include "../connection.php";
                    
                    
            if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $intern_id = $_POST["intern_id"];
            $name = $_POST["name"];
            $email = $_POST["email"];
            $contact = $_POST["contact"];
            $address = $_POST["address"];
            $role = $_POST["role"];
            $blood_group = $_POST["blood_group"];
            $college = $_POST["college"];
            $dob = $_POST["dob"];
            
            
            if(isset($_FILES["imageUpload"]) && $_FILES["imageUpload"]["error"] == 0) {
            $fileName = $_FILES["imageUpload"]["name"];
            $fileSize = $_FILES["imageUpload"]["size"];
            $tmpName = $_FILES["imageUpload"]["tmp_name"];
            $validImageExtensions = ['jpg', 'jpeg', 'png'];
            $imageExtension = explode('.', $fileName);
            $imageExtension = strtolower(end($imageExtension));
            if(!in_array($imageExtension, $validImageExtensions)){
            echo "<script>alert('Invalid image extension');</script>";
            }
            else if($fileSize > 2000000){
            echo "<script>alert('Image size is too large');</script>";
            }
            else{
            // Create the directory if it doesn't exist
            $directory = "admin/images/";
            if (!file_exists($directory)) {
            mkdir($directory, 0777, true); // Create the directory recursively
            }
            
            $newImageName = uniqid();
            $newImageName .= '.' .$imageExtension;
            move_uploaded_file($tmpName, $directory . $newImageName);
           // echo "<script>alert('Image uploaded successfully');</script>";
            }
            }
            else {
            echo "<script>alert('No image uploaded');</script>";
            $newImageName = ""; // Set empty image name if no image is uploaded
            }
            
            $sql = "INSERT INTO intern (`intern_id`, `name`, `email`, `contact`, `address`, `role`, `blood_group`, `college`, `dob`) VALUES ('$intern_id', '$name', '$email', '$contact', '$address', '$role', '$blood_group', '$college', '$dob')";

            //$sql = "INSERT INTO intern ( imageUpload, intern_id, name, email, contact, address, role, blood_group, college, dob)
           // VALUES ('$newImageName', '$intern_id', '$name', '$email', '$contact', '$address', '$role', '$blood_group', '$college', '$dob')";
            
           if ($conn->query($sql) === TRUE) {
            echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
                    Data inserted successfully.
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                  </div>';
        } else {
            echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                    Error: ' . $sql . '<br>' . $conn->error . '
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                  </div>';
        }
            }
            
            $conn->close();
            ?>


                <div class="modal fade" id="internModal" tabindex="-1" role="dialog" aria-labelledby="internModal"
                    aria-hidden="true">
                    <div class="modal-dialog modal-lg" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="addinternModalLabel">Add Interns</h5>
                                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <form id="addUserForm" class="user" method="POST" action="intern_info.php"
                                    enctype="multipart/form-data">

                                    <div class="form-group">
                                        <label for="imageUpload">Upload Image</label>
                                        <input type="file" class="form-control-file" id="imageUpload" name="imageUpload"
                                            accept="image/*" required>
                                        <!-- <button type="submit" class="btn btn-primary">Submit</button> -->
                                    </div>

                                    <div class="form-group">
                                        <label for="intern">Intern Id</label>
                                        <input type="number" class="form-control" id="intern" name="intern id" required>
                                    </div>

                                    <div class="form-group">
                                        <label for="name">Name</label>
                                        <input type="text" class="form-control" id="username" name="name" required>
                                    </div>

                                    <div class="form-group">
                                        <label for="email">Email</label>
                                        <input type="email" class="form-control" id="username" name="email" required>
                                    </div>

                                    <!-- <div class="form-group"> -->
                                    <!-- <label for="tel">Contact</label> -->
                                    <!-- <input type="tel" class="form-control" id="contact" name="contact" required> -->
                                    <!-- </div> -->

                                    <div class="form-group">
                                        <label for="tel">Contact</label>
                                        <input type="tel" class="form-control" id="contact" name="contact" required
                                            pattern="\d{10}" title="Please enter a 10-digit phone number" />
                                        <div class="invalid-feedback">
                                            Please enter a 10-digit phone number.
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label for="address">Address</label>
                                        <input type="address" class="form-control" id="address" name="address" required>
                                    </div>

                                    <div class="form-group">
                                        <label for="role">Role</label>
                                        <select class="form-control" id="role" name="role" required>
                                            <option value="">Select a role</option>
                                            <option value="student">Frontend Developer</option>
                                            <option value="faculty">Backend Developer</option>
                                            <option value="staff">Designer</option>
                                            <option value="staff">Digital Marketing</option>
                                        </select>
                                    </div>



                                    <div class="form-group">
                                        <label for="blood_group">Blood Group</label>
                                        <select class="form-control" id="blood_group" name="blood_group" required>
                                            <option value="">Select a blood group</option>
                                            <option value="A+">A+</option>
                                            <option value="A-">A-</option>
                                            <option value="B+">B+</option>
                                            <option value="B-">B-</option>
                                            <option value="AB+">AB+</option>
                                            <option value="AB-">AB-</option>
                                            <option value="O+">O+</option>
                                            <option value="O-">O-</option>
                                        </select>
                                    </div>


                                    <div class="form-group">
                                        <label for="college">College Name</label>
                                        <input type="college" class="form-control" id="college" name="college" required>
                                    </div>


                                    <div class="form-group">
                                        <label for="dob">Date of Birth</label>
                                        <input type="date" class="form-control" id="dob" name="dob" required>
                                    </div>

                                    <button type="submit" class="btn btn-primary">Add Intern</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- intern end -->



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
                                <form id="addUserForm" method="post" action="">

                                    <div class="form-group">
                                        <label for="username">Name</label>
                                        <input type="email" class="form-control" id="username" name="Name" required>
                                    </div>

                                    <div class="form-group">
                                        <label for="username">Email</label>
                                        <input type="email" class="form-control" id="username" name="Email" required>
                                    </div>

                                    <div class="form-group">
                                        <label for="password">Password</label>
                                        <input type="password" class="form-control" id="password" name="Password"
                                            required>
                                    </div>

                                    <div class="form-group">
                                        <label for="password">Phone</label>
                                        <input type="password" class="form-control" id="password" name="Phone" required>
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

                    <script>
                        window.location.reload_once();
                    </script>
                    <script>
                        $(document).ready(function () {
                            $('#example').DataTable();
                        });
                    </script>

                    <script>
                        $(document).ready(function () {
                            $('#example1').DataTable();
                        });
                    </script>


</body>

</html>