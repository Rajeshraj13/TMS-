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

    <title>TL Dashboard</title>
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">
    <link href="css/sb-admin-2.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css"
        integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link href="vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">
    <!-- <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css"> -->
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

            <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index_tl.php">
                <div class="sidebar-brand-icon rotate-n-15">
                    <i class="bi bi-apple"></i>
                </div>
                <div class="sidebar-brand-text mx-3">EMS Admin</div>
            </a>

            <hr class="sidebar-divider my-0">

            <li class="nav-item">
                <a class="nav-link" href="index_tl.php">
                    <i class="fas fa-fw fa-tachometer-alt"></i>
                    <span>Dashboard</span></a>
            </li>

            <hr class="sidebar-divider">



            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapsePages2"
                    aria-expanded="true" aria-controls="collapsePages2">
                    <i class="fas fa-fw fa-folder"></i>
                    <span>Task</span>
                </a>
                <div id="collapsePages2" class="collapse" aria-labelledby="headingPages2"
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
                                <img class="img-profile rounded-circle" src="images/images.jpeg">
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


                <!-- employee information start -->


                <?php
                  include "../connection.php";
                 // session_start();
                  // Ensure the correct path to your connection file
                  if ($_SERVER["REQUEST_METHOD"] == "POST") {
                  $emp_id = $_POST["emp_id"];
                  $name = $_POST["name"];
                  $email = $_POST["email"];
                  $password = $_POST['password'];
                  $contact = $_POST["phone"];
                  $address = $_POST["address"];
                  $role = $_POST["role"];
                  $blood_group = $_POST["blood_group"];
                  $experience = $_POST["experience"]; // Corrected variable name
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
                          //echo "<script>alert('Image uploaded successfully');</script>";
                      }
                  }
                  else {
                      echo "<script>alert('No image uploaded');</script>";
                      $newImageName = ""; // Set empty image name if no image is uploaded
                  }
                  
                  $sql = "INSERT INTO `reg-information` (imageUpload, emp_id, name, email, password, phone, address, role, `blood_group`, experience, dob) 
                  VALUES ('$newImageName','$emp_id', '$name', '$email', '$password', '$contact', '$address', '$role', '$blood_group', '$experience', '$dob')";
                  if ($conn->query($sql) === TRUE) {
                  echo "New record inserted successfully";
                  } else {
                  echo "Error: " . $sql . "<br>" . $conn->error;
                  }
                  }
              ?>

                <div class="modal fade" id="addUserModal" tabindex="-1" role="dialog"
                    aria-labelledby="addUserModalLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="addUserModalLabel">Add Employee</h5>

                                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                
                                <form id="addUserForm" class="user" method="POST" action="manage_admin.php"
                                    enctype="multipart/form-data">

                                    <div class="form-group">
                                        <label for="imageUpload">Upload Image</label>
                                        <input type="file" class="form-control-file" id="imageUpload" name="imageUpload"
                                            accept="image/*" required>
                                    </div>

                                    <div class="form-group">
                                        <label for="emp">Emp Id</label>
                                        <input type="number" class="form-control" id="emp_id" name="emp_id" required>
                                    </div>

                                    <div class="form-group">
                                        <label for="name">Name</label>
                                        <input type="text" class="form-control" id="name" name="name" required>
                                    </div>
                                    
                                    <div class="form-group">
                                        <label for="email">Email</label>
                                        <input type="email" class="form-control" id="email" name="email" required>
                                    </div>

                                    <div class="form-group">
                                        <label for="password">Password</label>
                                        <input type="password" class="form-control" id="password" name="password"
                                            required>
                                    </div>

                                    <div class="form-group">
                                        <label for="phone">Contact</label>
                                        <input type="tel" class="form-control" id="phone" name="phone" required>
                                    </div>

                                    <div class="form-group">
                                        <label for="address">Address</label>
                                        <input type="text" class="form-control" id="address" name="address" required>
                                    </div>

                                    <div class="form-group">
                                        <label for="role">Role</label>
                                        <select class="form-control" id="role" name="role" required>
                                            <option value="">Select a role</option>
                                            <option value="frontend_developer">Frontend Developer</option>
                                            <option value="backend_developer">Backend Developer</option>
                                            <option value="designer">Designer</option>
                                            <option value="digital_marketing">Digital Marketing</option>
                                        </select>
                                    </div>

                                    <div class="form-group">
                                        <label for="blood-group">Blood Group</label>
                                        <select class="form-control" id="blood-group" name="blood_group" required>
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
                                        <label for="experience">Experience</label>
                                        <input type="text" class="form-control" id="experience" name="experience"
                                            required>
                                    </div>

                                    <div class="form-group">
                                        <label for="dob">Date of Birth</label>
                                        <input type="date" class="form-control" id="dob" name="dob" required>
                                    </div>

                                    <button type="submit" class="btn btn-primary">Add</button>
                                </form>

                            </div>
                        </div>
                    </div>
                </div>


                <!-- Employee Information -->



                <div class="container">
                    <div id="attendance-sheet" data-spy="scroll" data-target="#navbar-example" data-offset="100">
                        <div class="d-flex justify-content-between align-items-center m-3">
                            <h1 class="h3 mb-0 text-dark">Employee Information</h1>
                            <a class="btn btn-success" href="#" data-toggle="modal" data-target="#addUserModal"><i
                                    class="fas fa-plus-circle mr-1"></i> <span>Add Employee</span></a>
                        </div>
                    </div>
                    <div class="card shadow mb-4">
                        <div class="card-body">
                            <div class="table-responsive">
                                <div class="table-scroll">
                                    <table id="example" class="table table-striped table-bordered table-sm"
                                        id="dataTable" width="140%" cellspacing="0">
                                        <thead>
                                            <tr>
                                                <th>Image</th>
                                                <th>Emp_id</th>
                                                <th>Name</th>
                                                <th>Email</th>
                                                <th>Password</th>
                                                <th>Phone</th>
                                                <th>Address</th>
                                                <th>Role</th>
                                                <th>Blood-Group</th>
                                                <th>Experience</th>
                                                <th>DoB</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php 
                                            // include "../connection.php";
                                            // $sql= "SELECT `imageUpload`,`emp_id`, `name`, `email`, `password`, `phone`, `address`, `role`,`blood-group`,`experience`,`dob` FROM `reg-information`";
                                            // $result = $conn->query($sql);
                                            // if (!$result) {
                                            // die("Error executing query: " . $conn->error);
                                            // }
                                            include "../connection.php";
                                            $sql= "SELECT `imageUpload`,`emp_id`, `name`, `email`, `password`, `phone`, `address`, `role`,`blood_group`,`experience`,`dob` FROM `reg-information`";
                                            $result = $conn->query($sql);
                                            if (!$result) {
                                            die("Error executing query: " . $conn->error);
                                           }
                                            // if ($result->num_rows > 0) {
                                            // while($row = $result->fetch_assoc()) {
                                            // echo "<tr>";
                                           // echo "<td>" . $row['imageUpload'] . "</td>";
                                            //echo "<td><img src='data:image/jpeg;base64," . base64_encode($row['imageUpload']) . "' width='100' height='100'></td>";
                                            // echo "<td><img src='admin/images/" . $row['imageUpload'] . "' style='border-radius: 50%;' width='50' height='50'></td>";
                                            // echo "<td>" . $row['emp_id'] . "</td>";
                                            // echo "<td>" . $row['name'] . "</td>";
                                            // echo "<td>" . $row['email'] . "</td>";
                                            // echo "<td>" . $row['password'] . "</td>";
                                            // echo "<td>" . $row['phone'] . "</td>";
                                            // echo "<td>" . $row['address'] . "</td>";
                                            // echo "<td>" . $row['role'] . "</td>";
                                            // echo "<td>" . $row['blood-group'] . "</td>";
                                            // echo "<td>" . $row['experience'] . "</td>";
                                            // echo "<td>" . $row['dob'] . "</td>";
                                            // echo "<td class='action-links'>
                                            // <a href=edit_employee.php?id=" . $row['emp_id'] . "'><i class='fa-regular fa-pen-to-square'></i></a>
                                            // <a href='?emp_id=" . $row['emp_id'] . "' onclick='return confirm(\"Are you sure you want to delete this user?\")'><i class='fa-solid fa-trash'></i></a>

                                            // </td>";
                                            // echo "</tr>";
                                            // }
                                            // } else {
                                            // echo "<tr><td colspan='11'>No records found</td></tr>";
                                            // }
                                            if ($result->num_rows > 0) {
                                                while($row = $result->fetch_assoc()) {
                                                    echo "<tr>";
                                                    echo "<td><img src='admin/images/" . $row['imageUpload'] . "' style='border-radius: 50%;' width='50' height='50'></td>";
                                                    echo "<td>" . $row['emp_id'] . "</td>";
                                                    echo "<td>" . $row['name'] . "</td>";
                                                    echo "<td>" . $row['email'] . "</td>";
                                                    echo "<td>" . $row['password'] . "</td>";
                                                    echo "<td>" . $row['phone'] . "</td>";
                                                    echo "<td>" . $row['address'] . "</td>";
                                                    echo "<td>" . $row['role'] . "</td>";
                                                    echo "<td>" . $row['blood_group'] . "</td>";
                                                    echo "<td>" . $row['experience'] . "</td>";
                                                    echo "<td>" . $row['dob'] . "</td>";
                                                    echo "<td class='action-links'>
                                                            <a href='edit_employee.php?emp_id=" . $row['emp_id'] . "'><i class='fa-regular fa-pen-to-square' style='color:green;'></i></a>
                                                            <a href='delete_employee.php?id=" . $row['emp_id'] . "' onclick='return confirm(\"Are you sure you want to delete this user?\")'><i class='fa-solid fa-trash' style='color:red;'></i></a>

                                                          </td>";
                                                    echo "</tr>";
                                                }
                                            } else {
                                                echo "<tr><td colspan='12'>No records found</td></tr>";
                                            }
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


        <!-- employee information end -->


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
                                <input type="password" class="form-control" id="password" name="Password" required>
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



            <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
                integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM"
                crossorigin="anonymous"></script>
            <script src="vendor/jquery/jquery.min.js"></script>
            <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
            <script src="vendor/jquery-easing/jquery.easing.min.js"></script>
            <script src="js/sb-admin-2.min.js"></script>
            <script src="vendor/datatables/jquery.dataTables.min.js"></script>
            <script src="vendor/datatables/dataTables.bootstrap4.min.js"></script>
            <script src="js/demo/datatables-demo.js"></script>
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