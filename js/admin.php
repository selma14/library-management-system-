<?php
   session_start(); 
   // session_destroy();
   if (!(isset($_SESSION['auth']) && $_SESSION['auth'] === true)) {
   	header("Location: index.php");
   	exit();
   }
   else {
    	$admin = $_SESSION['admin'];
   }
   require '../includes/db-inc.php';
   include "../includes/header.php";
   include "../css/styling.css";
   require '../includes/snippet.php';

   if (isset($_POST['submit'])) {
		$id = trim($_POST['del_btn']);
		$sql = "DELETE from subscribers where personId = '$id'";
		$query = mysqli_query($conn, $sql);

		if ($query) {
			echo "<script>alert('Subscriber Deleted!')</script>";
		}
	}
?>

<!DOCTYPE html>
<html>
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>library management system</title>
    <link rel="stylesheet" href="../css/bootstrap.min.css" />
    <link rel="stylesheet" href="../css/aos.css" />
    <link rel="stylesheet" href="../css/line-awesome.min.css" />
    <link rel="stylesheet" href="../css/styling.css" />
  </head>
  <body  data-bs-spy="scroll" data-bs-target=".navbar" class="body-navbar">
    <nav class="navbar navbar-expand-lg navbar-dark fixed-top">
      <div class="container flex-lg-column">
        <a class="navbar-brand mx-lg-auto mb-lg-4" href="admin.php">
          <span class="h3 fw-bold d-block d-lg-none">LIBRARY</span>
        </a>
        <button
          class="navbar-toggler"
          type="button"
          data-bs-toggle="collapse"
          data-bs-target="#navbarNav"
          aria-controls="navbarNav"
          aria-expanded="false"
          aria-label="Toggle navigation"
        >
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
          <ul class="navbar-nav ms-auto flex-lg-column text-lg-center">
            <?php if(isset($admin)) { ?> 
            <li class="nav-item">
              <a class="nav-link" href="admin.php">Home</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="bookstable.php">Books</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="users.php">Admins</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="#subscribers">subscribers</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="borrowedbooks.php">Issued books</a>
            </li>
            <?php } ?>
            <li class="nav-item">
              <a class="nav-link" href="logout.php">Logout</a>
            </li>
          </ul>
        </div>
      </div>
    </nav>
    <!-- CONTENT WRAPPER -->
    <div id="content-wrapper">
        <!-- HOME -->
        <section id="home" class="full-height px-lg-5">
          <div class="container">
            <div class="row">
              <div class="col-lg-10">
                <h1 class="display-4 fw-bold" data-aos="fade-up">
                  Admin Dashboard
                  <br>
                  <span class="text-brand">Library management system</span> 
                </h1>
                <p class="lead mt-2 mb-4" data-aos="fade-up" data-aos-delay="300">
                    <i class="las la-home"></i>
                    A home for teachers and students
                </p>
              </div>
            </div>
          </div>
        </section>
        <!-- //HOME-->
        <!-- STUDENTS -->
        <section id="subscribers" class="full-height px-lg-5">
          <div class="container">
               <table class="table table-bordered">
                  <thead>
                        <tr>
                           <th>#</th> 
                           <th>ID No</th>
                           <th>FirstName</th>
                           <th>LastName</th>
                           <th>Email</th>
                           <th>Address</th>
                           <th>Status</th>
                           <th>BooksNumber</th>		             
                           <th>REMOVE</th>
                        </tr>    
                  </thead>    
                  <?php 

                  $sql = "SELECT * FROM subscribers";
                  $query = mysqli_query($conn, $sql);
                  $counter = 1;
                  while ( $row = mysqli_fetch_assoc($query)) {        	
                  ?>
                  <tbody> 
                     <tr> 
                     <td><?php echo $counter++; ?></td>
                     <td><?php echo $row['personId']; ?></td>
                     <td><?php echo $row['firstName']; ?></td>
                     <td><?php echo $row['lastName']; ?></td>
                     <td><?php echo $row['email']; ?></td>
                     <td><?php echo $row['address']; ?></td>
                     <td><?php echo $row['status']; ?></td>
                     <td><?php echo $row['booksNumber']; ?></td>
                     
                     <td>
                        <form action="admin.php" method="post">
                           <input type="hidden" value="<?php echo $row['personId']; ?>" name="del_btn">
                           <button name="submit" style="background-color: #660066 ; color:white;  border-radius: 8px" >DELETE</button>
                        </form> 
                     </td>
                     </tr> 
                  
                  </tbody> 
                  <?php } ?>
               </table>
               <div style="margin-top : 20px ; margin-left : -15px">
                  <a href="addstudent.php"><button class="btn btn-success col-lg-3 col-md-4 col-sm-11 col-xs-11 button" style="margin-left: 15px;margin-bottom: 5px"><span class="glyphicon glyphicon-plus-sign"></span> Add Student</button></a>
               </div>
            </div>
        </section>
        <!-- //STUDENTS -->
        <!-- //CONTENT WRAPPER -->

    <script src="../javascript/bootstrap.bundle.min.js"></script>
    <script src="../javascript/aos.js"></script>
    <script src="../javascript/main.js"></script>
  </body>
</html>