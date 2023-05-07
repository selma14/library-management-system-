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

   if(isset($_POST['del'])){
    $id = $_POST['id'];
    $sql_del = "DELETE from books where BookId = ?";
    $error = false;
    $stmt = mysqli_prepare($conn, $sql_del);
    mysqli_stmt_bind_param($stmt, "i", $id);
    $result = mysqli_stmt_execute($stmt);
    if ($result)
    {
        $error = true; //delete successful
    }			
}

   
?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Books List</title>
    <link rel="stylesheet" href="../css/bootstrap.min.css" />
    <link rel="stylesheet" href="../css/aos.css" />
    <link rel="stylesheet" href="../css/line-awesome.min.css" />
    <link rel="stylesheet" href="../css/styling.css" />
    <link rel="stylesheet" href="../css/stylesIbti.css" />
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
              <a class="nav-link" href="viewstudents.php">Students</a>
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
    <div id="content-wrapper" class="table-wrapper">
        <!-- HOME -->
        <h1 class="display-4 fw-bold mt-5" data-aos="fade-up">
                  <span class="text-brand">Books List: </span> 
        </h1>
        <p class="lead mt-2 mb-4 text-light" data-aos="fade-up" data-aos-delay="300">
                    <i class="las la-book-open"></i>
                     Discover Your Next Read
                </p>

        <?php if(isset($error)===true) { ?>
         <div class="alert alert-success alert-dismissable">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
            <strong>Record Deleted Successfully!</strong>
         </div>
         <?php } ?>
  
      <table class="table table-bordered bg-white" style="--bs-bg-opacity: .3;">
         <thead>
            <tr>
               <th>BookId</th>
               <th>bookTitle</th>
               <th>author</th>
               <th>publisherName</th>
               <th>pagesNumber</th>
               <th>copiesNumber</th>
               <th>Delete</th>
            </tr>
         </thead>
         <?php 
            $sql = "SELECT * from books";
            
            $query = mysqli_query($conn, $sql); 
            $counter = 1;
            while ($row = mysqli_fetch_array($query)) { ?>
         <tbody>
            <td><?php echo $row['bookId']; ?></td>
            <td><?php echo $row['bookTitle']; ?></td>
            <td><?php echo $row['author']; ?></td>
            <td><?php echo $row['publisherName']; ?></td>
            <td><?php echo $row['pagesNumber']; ?></td>
            <td><?php echo $row['copiesNumber']; ?></td>
            <form method='post' action='bookstable.php'>
               <input type='hidden' value="<?php echo $row['bookId']; ?>" name='id'>
               <td><button name='del' type='submit' value='Delete' class='btn btn-warning'>DELETE</button></td>
            </form>
         </tbody>
         <?php 	}
            ?>
      </table>
      <div class="row">
            <a href="addbook.php"><button class="btn btn-success col-lg-2 col-md-4 col-sm-11 col-xs-11 button mt-3" style="font-size: 13px;"><span class="glyphicon glyphicon-plus-sign"></span> Add Book</button></a>
      </div>
        <!-- //HOME-->
        <!-- //CONTENT WRAPPER -->

    <script src="../javascript/bootstrap.bundle.min.js"></script>
    <script src="../javascript/aos.js"></script>
    <script src="../javascript/main.js"></script>
  </body>
</html>