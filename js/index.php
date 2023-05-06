<?php
   session_start(); 
   
   if ((isset($_SESSION['auth']) && $_SESSION['auth'] === true)) {
   	header("Location: admin.php");
   	exit();
   }
   
   	if (isset($_GET['access'])) {
   		$alert_user = true;
   	}
   
   require '../includes/snippet.php';
   require '../includes/db-inc.php';
   include "../includes/header.php";
   
   
   
   echo"<br>";
   
   if(isset($_POST['submit'])){
   	$username = sanitize(trim($_POST['username']));
   	$password = sanitize(trim($_POST['password']));
   
   	$sql_admin = "SELECT * from admin where username = '$username' and  password = '$password' ";
   	$query = mysqli_query($conn, $sql_admin);
   	// echo mysqli_error($conn);
   	if(mysqli_num_rows($query) > 0)
   	{
   			
   				while($row = mysqli_fetch_assoc($query)){
   					$_SESSION['auth'] = true;
   					$_SESSION['admin'] = $row['username'];		
   					}
   					if ($_SESSION['auth'] === true) {
   				header("Location: admin.php");
   				exit();
   					}
   	}
   		
   			else {
   						echo"<div class='alert alert-success alert-dismissable'>
   						<button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
   						<strong style='text-align: center'> Wrong Username and Password.</strong>  </div>";
   					}		
   					
   						
   
   		
   			}
   					
   ?>
<html>
    <head>
        <link href="https://fonts.googleapis.com/css?family=Open+Sans" rel="stylesheet">
        <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous"><link rel="stylesheet" href="../css/style.css">
    </head>
    <body>
        <div class="box-form">
            <div class="left">
                <div class="overlay">
                <h1>Books world</h1>
                <br></br>
                <p>“If you don't like to read, you haven't found the right book.”</p>
                <br><br><br>
                <a href="bookslist.php"><button class="button-style" style="float: left; ">&nbsp&nbspVIEW BOOKS</button></a>
                </div>
            </div>
            <div class="right" style="margin-left: 50px; margin-top: 110px;">
                <form role="form" method="post" action="index.php" enctype="multipart/form-data">
                    <h5>Login</h5>
                    <div class="inputs" style="margin-top: 100px">
                        <input type="text" placeholder="admin" name="username" id="username" required>
                        <br>
                        <input type="password" name="password" placeholder="Password (admin)" id="password" required>
                    </div>
                    <br><br>
                    <div class="remember-me--forget-password">
                    </div>
                    <br>
                    <input type="submit" name="submit" value="Sign In" class="button-style">
                </form>
            </div>
        </div>          
        </body>
</html>
<script type="text/javascript" src="js/jquery.js"></script>
<script type="text/javascript" src="js/bootstrap.js"></script>
<script type="text/javascript" src="js/sweetalert.min.js"> </script> 

<?php if (isset($alert_user)) { ?>
<!-- <script type="text/javascript">
   swal("Oops...", "You are not allowed to view this page directly...!", "error");
</script> --> 
<?php } ?>
</body>
</html>