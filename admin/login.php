<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">

<head>

	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<meta name="description" content="">
	<meta name="author" content="">

	<title>Login</title>

	<!-- Custom fonts for this template-->
	<link href="assets/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
	<link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

	<!-- Custom styles for this template-->
	<link href="assets/css/sb-admin-2.css" rel="stylesheet">
	<style type="text/css">
		.my-5 {
		    margin-top: 10rem !important;
		}
	    .errror{
	        color: red;
          text-align:center;
	    }


.bg-gradient-primary {
  background-color: #8060CA;
  background: linear-gradient(90deg, rgba(94,49,198,1) 0%, rgba(128,96,202,1) 46%, rgba(94,49,198,1) 100%);

  background-size: cover;
}

.login_button {
    color: #fff;
    background-color: #8060ca;
    border-color: #6e3ede;
}
.login_button:hover{
    color: #fff;
    background-color: #6e3ede;
    border-color: #5013de;
}
.bg-login-image{
  background: url("assets/img/logo.png");
}
	</style>

</head>

<body class="bg-gradient-primary">

  <div class="container">

    <!-- Outer Row -->
    <div class="row justify-content-center">

      <div class="col-xl-10 col-lg-12 col-md-9">

        <div class="card o-hidden border-0 shadow-lg my-5">
          <div class="card-body p-0">
            <!-- Nested Row within Card Body -->
             
            <div class="row">
              <div class="col-lg-6 d-none d-lg-block bg-login-image"></div>
              <div class="col-lg-6">
                <div class="p-5">
                  <div class="text-center">
                    <h1 class="h4 text-gray-900 mb-4">RELIEF MANAGER</h1>
                  </div>
                  <?php
                  	include("../config.php");
                  	$logged = false;
          					if(isset($_SESSION['loggedin'])) {
          						$logged = $_SESSION['loggedin'];
          						if ($logged == true) {
          				            header('Location: dashboard.php');
          				        }
          					}

                    date_default_timezone_set('Asia/Dhaka');
                    $date = date('Y-m-d H:i:s');
                    $message = "";
                    
                    if($_SERVER["REQUEST_METHOD"] == "POST") {
					    $myusername = mysqli_real_escape_string($conn,$_POST['username']);
					    $mypassword = mysqli_real_escape_string($conn,$_POST['password']); 
					    $sql = "SELECT * FROM users WHERE username = '$myusername' and password = '$mypassword' AND role=1";
      					$result = mysqli_query($conn,$sql);
      					$row = mysqli_fetch_array($result,MYSQLI_ASSOC);

      					if ($row['is_active'] == 1) {
      						$_SESSION["username"] = $row['username'];
							$_SESSION["name"] = $row['name'];
							$_SESSION['loggedin'] = true;
							header('Location: dashboard.php');
      					}else{
      						$message = "<p class='errror'>Username or Password is incorrect!!</p>";
      						echo $message;
      					}
					}
					      
                  ?>
                  <form class="user"  method="post">
                    <div class="form-group">
                      <input type="text" name="username" class="form-control form-control-user" id="exampleInputEmail" aria-describedby="emailHelp" placeholder="Enter Username" required>
                    </div>
                    <div class="form-group">
                      <input type="password" name="password" class="form-control form-control-user" id="exampleInputPassword" placeholder="Enter Password" required>
                    </div>
                    <input type="submit" class="login_button btn btn-primary btn-user btn-block" value="Login">
                  </form>
                </div>
              </div>
            </div>
          </div>
        </div>

      </div>

    </div>

  </div>

  <!-- Bootstrap core JavaScript-->
  <script src="assets/vendor/jquery/jquery.min.js"></script>
  <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

  <!-- Core plugin JavaScript-->
  <script src="assets/vendor/jquery-easing/jquery.easing.min.js"></script>

  <!-- Custom scripts for all pages-->
  <script src="assets/js/sb-admin-2.min.js"></script>

</body>

</html>