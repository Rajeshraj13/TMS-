
<!-- <?php
// include "../connection.php"; 
// 
// 
// if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // $email = $_POST['email'];
    // $password = $_POST['password'];
    // 
    // 
    // $sql = "SELECT * FROM `reg-information` WHERE `email` = ? AND `Password` = ?";
// 
    // if ($stmt = $conn->prepare($sql)) {
        // $stmt->bind_param("ss", $email, $password);
        // 
        // $stmt->execute();
        // 
        // $result = $stmt->get_result();
// 
        // 
        // if ($result->num_rows == 1) {
            // while($rows=mysqli_fetch_assoc($result)){
                // session_start();
                // session_unset();
           // $_SESSION['loggedin'] = true;
           // $_SESSION['username'] = $email;
            // $_SESSION["email"] = $rows["email"];
            // header('Location: index_user.php');
            // }
            //exit;
        // } else {
            // echo "<script type='text/javascript'> alert('Invalid Username & Password');</script>";
        // }
// 
        // $stmt->close();
    // } else {
        // echo "Database query failed: " . $conn->error;
    // }
// }
// ?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>User Login</title>
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">
    <link href="css/sb-admin-2.min.css" rel="stylesheet">
    <style>
        *,
        *:before,
        *:after {
            padding: 0;
            margin: 0;
            box-sizing: border-box;
        }

        body {
            background-color: black;
        }

        .background {
            width: 430px;
            height: 520px;
            position: absolute;
            transform: translate(-50%, -50%);
            left: 50%;
            top: 50%;
        }

        .background .shape {
            height: 200px;
            width: 200px;
            position: absolute;
            border-radius: 50%;
        }

        .shape:first-child {
            background: linear-gradient(#1845ad,
                    #23a2f6);
            left: -80px;
            top: -80px;
        }

        .shape:last-child {
            background: linear-gradient(to right,
                    #ff512f,
                    #f09819);
            right: -30px;
            bottom: -80px;
        }

        form {
            height: 520px;
            width: 400px;
            background-color: rgba(255, 255, 255, 0.13);
            position: absolute;
            transform: translate(-50%, -50%);
            top: 50%;
            left: 50%;
            border-radius: 10px;
            backdrop-filter: blur(10px);
            border: 2px solid rgba(255, 255, 255, 0.1);
            
            padding: 50px 35px;
        }

        form * {
            font-family: 'Poppins', sans-serif;
            color: #ffffff;
            letter-spacing: 0.5px;
            outline: none;
            border: none;
        }

        form h3 {
            font-size: 32px;
            font-weight: 500;
            line-height: 42px;
            text-align: center;
        }

        label {
            display: block;
            margin-top: 30px;
            font-size: 16px;
            font-weight: 500;
        }

        input {
            display: block;
            height: 50px;
            width: 100%;
            background-color: rgba(255, 255, 255, 0.07);
            border-radius: 3px;
            padding: 0 10px;
            margin-top: 8px;
            font-size: 14px;
            font-weight: 300;
        }

        ::placeholder {
            color: #e5e5e5;
        }

        button {
            margin-top: 50px;
            width: 100%;
            background-color: #ffffff;
            color: #080710;
            padding: 15px 0;
            font-size: 18px;
            font-weight: 600;
            border-radius: 5px;
            cursor: pointer;
        }
        /* Default styles for desktop */

/* Media query for tablet and mobile devices */
@media only screen and (max-width: 768px) {
  .user {
    max-width: 300px;
    margin: 20px auto;
    padding: 15px;
  }
}

/* Media query for mobile devices only */
@media only screen and (max-width: 480px) {
  .user {
    max-width: 250px;
    margin: 10px auto;
    padding: 10px;
  }
  label {
    font-size: 14px;
  }
  input[type="email"], input[type="password"] {
    font-size: 14px;
    padding: 10px;
  }
  button[type="submit"] {
    font-size: 14px;
    padding: 10px 20px;
  }
}
    </style>

</head>
<body class="bg-gradient-info">
    <div class="container">
         <div class="row justify-content-center"> -->
            <!-- <div class="col-xl-10 col-lg-12 col-md-9"> -->
                <!-- <div class="card o-hidden border-0 shadow-lg my-5"> -->
                    <!-- <div class="card-body p-0"> -->
                        <!-- <div class="row"> -->
                            <!-- <div class="col-lg-6 d-none d-lg-block"> -->
                                <!-- <img src="computer-security-with-login-password-padlock.jpg" alt="login image" class="img-fluid"> -->
                            <!-- </div> -->
                            <!-- <div class="col-lg-6"> -->
                                <!-- <div class="p-5"> -->
                                    <!-- <div class="text-center"> -->
                                        <!-- <h1 class="h4 text-gray-900 mb-4">User Login</h1> -->
                                    <!-- </div> -->
                                    <!-- <form class="user" action="user_login.php" method="POST"> -->
                                        <!-- <div class="form-group"> -->
                                            <!-- <input type="email" class="form-control form-control-user" id="exampleInputEmail" aria-describedby="emailHelp" placeholder="Enter Email Address..." name="email" required> -->
                                        <!-- </div> -->
                                        <!-- <div class="form-group"> -->
                                            <!-- <input type="password" class="form-control form-control-user" id="exampleInputPassword" placeholder="Password" name="password" required> -->
                                        <!-- </div> -->
                                        <!-- <div class="form-group"> -->
                                            <!-- <div class="custom-control custom-checkbox small"> -->
                                                <!-- <input type="checkbox" class="custom-control-input" id="customCheck"> -->
                                                <!-- <label class="custom-control-label" for="customCheck">Remember Me</label> -->
                                            <!-- </div> -->
                                        <!-- </div> -->
                                        <!-- <button type="submit" class="btn btn-success btn-lg">Login</button> -->
                                    <!-- </form> -->
                                    <!-- <hr> -->
                                    <!-- <div class="text-center"> -->
                                        <!-- <a class="small" href="user_register.php">Create an Account!</a> -->
                                    <!-- </div> -->
                                <!-- </div> -->
                            <!-- </div> -->
                        <!-- </div> -->
                    <!-- </div> -->
                <!-- </div> -->
            <!-- </div> -->
        <!-- </div> -->

        <!-- <div class="background"> -->
     <!-- <div class="shape"></div> -->
     <!-- <div class="shape"></div> -->
 <!-- </div> -->
 <!-- <form class="user" action="" method="POST"> -->
     <!-- <h3>Login Here</h3> -->
     <!-- <label for="email">Email</label> -->
     <!-- <input type="email" placeholder="Enter your Email" name="email" id="exampleInputEmail"> -->
     <!-- <label for="password">Password</label> -->
     <!-- <input type="password" placeholder="Password" name="password" id="password"> -->
     <!-- <button type="submit" class="btn btn-primary btn-lg">Log In</button> -->
 <!-- </form> -->
    <!-- </div> -->


    <!-- <script src="vendor/jquery/jquery.min.js"></script> -->
    <!-- <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script> -->
    <!-- <script src="vendor/jquery-easing/jquery.easing.min.js"></script> -->
    <!-- <script src="js/sb-admin-2.min.js"></script>  -->
<!-- </body> -->
<!-- </html> -->








