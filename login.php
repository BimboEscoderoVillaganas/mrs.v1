<?php 
session_start();
include_once('config.php'); // Include the database configuration
$db = new Database();

if (isset($_POST['login'])) {
    $un = $_POST['un'];
    $up = $_POST['up'];

    $up = md5($up);

    $sql = 'SELECT * FROM users WHERE user_name = ? AND user_pass = ?';
    $result = $db->getRow($sql, [$un, $up]);

    if ($result) {
        $r = $result['user_type'];

        $_SESSION['tourID'] = $result['user_id'];
        $_SESSION['username'] = $result['user_name']; // Set username in session

        if ($r == '1') {
            $_SESSION['logged'] = '1';
            header('Location: admin/index.php');
            exit(); // Add exit() after header redirection
        } elseif ($r == '2') {
            $_SESSION['logged'] = '2';
            header('Location: manager/index.php');
            exit(); // Add exit() after header redirection
        } else {
            $_SESSION['logged'] = '3';
            header('Location: users/index.php');
            exit(); // Add exit() after header redirection
        }
    } else {
        // Handle login failure (e.g., display an error message)
        echo 'Invalid username or password.';
    }
}
?>

<!DOCTYPE html>
<html lang="">
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<title>Boat Reservation</title>

		<!-- Bootstrap CSS -->
		<link rel="stylesheet" type="text/css" href="bootstrap/css/bootstrap.css">
		<link rel="stylesheet" type="text/css" href="bootstrap/css/jquery.dataTables.css">

	</head>

	<style type="text/css">
		.navbar { margin-bottom:0px !important; }
		.carousel-caption { margin-top:0px !important }
	</style>



	<body>
<br />
<br />
<br />
<br />
<br />
<br />
		<div class="row">
			<div class="col-md-4"></div>
			<div class="col-md-4">
				<div class="panel panel-info">
					<div class="panel-heading">
						<h3 class="panel-title">Login | here</h3>
					</div>
					<div class="panel-body">
						 <form action="" method="post">
							 	<div class="form-group">
							    <label for="inputdefault">Username:</label>
							    <input class="form-control" name="un" type="text" required autofocus
							    value="<?php if(isset($_POST['un'])){echo $_POST['un'];} ?>"
							    >
							  </div>

							   <div class="form-group">
							    <label for="inputdefault">Password:</label>
							    <input class="form-control" name="up" type="password" required>
							  </div>

							  <button class="btn btn-info" type="submit" name="login">
							  	Login
							  	<span class="glyphicon glyphicon-log-in" aria-hidden="true"></span>
							  </button>
						 </form>
					</div>
				</div>
			</div>
			<div class="col-md-4"></div>
		</div>
		
		<footer style="background-color: white;">
			<center>
				&copy; All rights reserved
			</center>
		</footer>

 		<script src="bootstrap/js/jquery-1.11.1.min.js"></script>
 		<script src="bootstrap/js/dataTables.js"></script>
 		<script src="bootstrap/js/dataTables2.js"></script>
 		<script src="bootstrap/js/bootstrap.js"></script>

	</body>
</html>