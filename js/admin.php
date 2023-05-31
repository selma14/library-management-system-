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
   require '../includes/snippet.php';

   if (isset($_POST['submit'])) {
		$id = trim($_POST['del_btn']);
		$sql = "DELETE from subscribers where personId = '$id'";
		$query = mysqli_query($conn, $sql);

		if ($query) {
			echo "<script>alert('Subscriber Deleted!')</script>";
		}
	}

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

  if(isset($_GET['query'])) {
    $search_query =$_GET['query'];
    $sql = "SELECT * FROM books WHERE bookId LIKE '%$search_query%' OR bookTitle LIKE '%$search_query%' OR author LIKE '%$search_query%' OR publisherName LIKE '%$search_query%'";
    $result = mysqli_query($conn, $sql);
    if (mysqli_num_rows($result) > 0) {
      echo "works";
    } else {
      echo "No results found.";
    }
  }else {
    echo "No search query entered.";
  }

?>
<script>

</script>

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
              <a class="nav-link" href="#subscribers">subscribers</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="#bookstable">books</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="#borrow">Issued books</a>
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
        <!-- SUBSCRIBERS -->
        
        <section id="subscribers" class="full-height px-lg-5">
          <div class="container">
               <h1 class="display-4 fw-bold mt-5" data-aos="fade-up">
                  <span class="text-brand" style="color:#FCEC52;">Subscribers List: </span> 
               </h1>
               <br></br>
               <input type="text" id="search-input" onkeyup="searchSubscriberTable()" placeholder="  Search..." class="form-control border-0 rounded-pill shadow-sm">
               
               <br></br>
               <table class="table table-bordered" id="myTable">
                  <thead style="background: linear-gradient(rgba(192, 43, 185, 0.8), rgba(73, 4, 90, 0.8)) !important;background-size: cover;background-position: center;color:white;">
                        <tr>
                           <th>#</th> 
                           <th>ID No</th>
                           <th class="searchable">FirstName</th>
                           <th class="searchable">LastName</th>
                           <th>Email</th>
                           <th>Address</th>
                           <th>Status</th>
                           <th>BooksNumber</th>		             
                           <th>REMOVE</th>
                           <th>UPDATE</th>
                        </tr>    
                  </thead> 
                  <tbody>   
                  <?php 

                  $sql = "SELECT * FROM subscribers";
                  $query = mysqli_query($conn, $sql);
                  $counter = 1;
                  while ( $row = mysqli_fetch_assoc($query)) {        	
                  ?>
                   
                     <tr> 
                     <td><?php echo $counter++; ?></td>
                     <td><?php echo $row['personId']; ?></td>
                     <td class="searchable"><?php echo $row['firstName']; ?></td>
                     <td class="searchable"><?php echo $row['lastName']; ?></td>
                     <td><?php echo $row['email']; ?></td>
                     <td><?php echo $row['address']; ?></td>
                     <td><?php echo $row['status']; ?></td>
                     <td><?php echo $row['booksNumber']; ?></td>
                     
                     <td>
                        <form action="admin.php" method="post">
                           <input type="hidden" value="<?php echo $row['personId']; ?>" name="del_btn">
                           <button name="submit" class='btn btn-warning' >DELETE</button>
                        </form> 
                     </td>
                     <td>
                        <form method="post" action="modify_entry_subscriber.php">
                            <input type="hidden" name="personId" value="<?php echo $row['personId']; ?>">
                            <button type="submit" class='btn btn-info'>Update</button>
                        </form>
                     </td>
                     </tr> 
                     <?php } ?>
                  </tbody> 
                  
               </table>
               <script>
                  function searchSubscriberTable() {
                    // Declare variables
                    var input, filter, table, tr, td, i, txtValue;
                    input = document.getElementById("search-input");
                    filter = input.value.toUpperCase();
                    table = document.getElementById("myTable");
                    tr = table.getElementsByTagName("tr");

                    // Loop through all table rows, and hide those that don't match the search query
                    for (i = 0; i < tr.length; i++) {
                      // Only search in firstName and lastName columns
                      td_firstName = tr[i].getElementsByTagName("td")[2];
                      td_lastName = tr[i].getElementsByTagName("td")[3];
                      if (td_firstName || td_lastName) {
                        txtValue_firstName = td_firstName.textContent || td_firstName.innerText;
                        txtValue_lastName = td_lastName.textContent || td_lastName.innerText;
                        if (
                          txtValue_firstName.toUpperCase().indexOf(filter) > -1 ||
                          txtValue_lastName.toUpperCase().indexOf(filter) > -1
                        ) {
                          tr[i].style.display = "";
                        } else {
                          tr[i].style.display = "none";
                        }
                      }
                    }
                  }

               </script>
               <div style="margin-top : 20px ; margin-left : -15px">
                  <a href="addsubscriber.php"><button  class="btn btn-success col-lg-2 col-md-4 col-sm-11 col-xs-11 button mt-3" style="font-size: 13px; margin-left: 13px"><span class="glyphicon glyphicon-plus-sign"></span> Add Subscriber</button></a>
               </div>
            </div>
        </section>
        <!-- //SUBSCRIBERS -->
        <!-- BOOKS      -->
        <section id="bookstable" class="full-height px-lg-5">
          <div class="container">
            <h1 class="display-4 fw-bold mt-5" data-aos="fade-up">
                    <span class="text-brand" style="color:#FCEC52;">Books List: </span> 
            </h1>
            
            <p class="lead mt-2 mb-4 text-light" data-aos="fade-up" data-aos-delay="300">
                      <i class="las la-book-open"></i>
                      Discover Your Next Read
            </p>
           
            <input id="book-search-input" onkeyup="searchBookTable()" type="text"  class="form-control border-0 rounded-pill shadow-sm"  placeholder="Search..." aria-label="Search" style="width: 92%;">
            <br></br>
            
            
            <table class="table table-bordered bg-white" style="--bs-bg-opacity: .3; border-color:black;text-align:center" id="bookstable">
              <thead style="background: linear-gradient(rgba(192, 43, 185, 0.8), rgba(73, 4, 90, 0.8)) !important;background-size: cover;background-position: center;color:white;">
                  <tr>
                    <th>BookId</th>
                    <th class="searchable">bookTitle</th>
                    <th>author</th>
                    <th>publisherName</th>
                    <th>pagesNumber</th>
                    <th>copiesNumber</th>
                    <th>DELETE</th>
                    <th>UPDATE</th>
                  </tr>
              </thead>
              <?php 
                  $sql = "SELECT * from books";
                  
                  $query = mysqli_query($conn, $sql); 
                  $counter = 1;
                  while ($row = mysqli_fetch_array($query)) { ?>
              <tbody style="font-weight:bold;">
                  <td><?php echo $row['bookId']; ?></td>
                  <td class="searchable"><?php echo $row['bookTitle']; ?></td>
                  <td><?php echo $row['author']; ?></td>
                  <td><?php echo $row['publisherName']; ?></td>
                  <td><?php echo $row['pagesNumber']; ?></td>
                  <td><?php echo $row['copiesNumber']; ?></td>
                  <form method='post' action='admin.php'>
                    <input type='hidden' value="<?php echo $row['bookId']; ?>" name='id'>
                    <td class="d-grid gap-2 d-md-block">
                      <button name='del' type='submit' value='Delete' class='btn btn-warning'>DELETE</button>
                      </td>
                  </form>
                  <form method='post' action='modifyBooks.php'>
                    <input type='hidden' value="<?php echo $row['bookId']; ?>" name='bookId'>
                    <td>
                      <button name='edit' type='submit' value='Edit' class='btn btn-info'>UPDATE</button>
                      </td>
                  </form>
              </tbody>
              <?php 	}
                  ?>
            </table>
            <script>
                  function searchBookTable() {
                    // Declare variables
                    var input, filter, table, tr, td, i, td_bookTitle, txtValue
                    input = document.getElementById("book-search-input");
                    filter = input.value.toUpperCase();
                    table = document.getElementById("bookstable");
                    tr = table.getElementsByTagName("tr");

                    // Loop through all table rows, and hide those that don't match the search query
                    for (i = 0; i < tr.length; i++) {
                      // Only search in firstName and lastName columns
                      td_bookTitle = tr[i].getElementsByTagName("td")[1];
                      
                      if (td_bookTitle) {
                        txtValue_bookTitle = td_bookTitle.textContent || td_bookTitle.innerText;
                        
                        if (
                          txtValue_bookTitle.toUpperCase().indexOf(filter) > -1 
                        ) {
                          tr[i].style.display = "";
                        } else {
                          tr[i].style.display = "none";
                        }
                      }
                    }
                  }
                  
            </script>
            <div class="row">
                <a href="addbook.php"><button class="btn btn-success col-lg-2 col-md-4 col-sm-11 col-xs-11 button mt-3" style="font-size: 13px;"><span class="glyphicon glyphicon-plus-sign"></span> Add Book</button></a>
            </div>
         
          </div>
        </section>
        
        <!-- //BOOKS      -->
        <!-- ISSUED BOOKS -->
        <section id="borrow" class="full-height px-lg-5">
          <div class="container">
            <h1 class="display-4 fw-bold mt-5" data-aos="fade-up">
                    <span class="text-brand" style="color:#FCEC52;">Issued books: </span> 
            </h1>
            <div class="panel-heading">
              <div class="row">
                  <a href="lendbook.php"><button class="btn btn-success col-lg-3 col-md-4 col-sm-11 col-xs-11 button" style="margin-left: 15px;margin-bottom: 5px"><span class="glyphicon glyphicon-plus-sign"></span> Lend Book</button></a>
              </div>
            </div>
            <table class="table table-bordered">
              <thead>
                  <tr>
                    <th>S.No</th>
                    <th>Book Id</th>
                    <th>Book Name</th>
                    <th>Issue Date</th>
                    <th>Person ID</th>
                    <th>Actions</th>
                    <!-- <th>Actions</th> -->
                  </tr>
              </thead>
              <?php
                  // $sql = "SELECT * FROM borrow"; 	
                  $sql = "SELECT * FROM books NATURAL JOIN borrow;"; 	
                  
                  $query = mysqli_query($conn, $sql);
                  $counter =1;
                    while($row = mysqli_fetch_array($query)){
                      
                      ?>
              <tbody>
                  <tr>
                    <td><?php echo $counter++; ?></td>
                    <td><?php echo $row['bookId'];?></td>
                    <td><?php echo $row['bookTitle'];?></td>
                    <td><?php echo $row['borrowDate']; ?></td>
                    <td><?php echo $row['personId']; ?></td>
                    <td>
                        <a href="delete_query.php?bookId=<?php echo $row['bookId']?>"> <button class="btn btn-info" data-toggle="modal" >Return</button></a>
                    </td>
                    <!-- <td><a href="lendbook.php"> <button class="btn btn-success ">Lend Now</button></a></td> -->
                  </tr>
              </tbody>
              <?php }
                  ?>
            </table>
          </div>
        </section>
        <!-- //ISSUED BOOKS -->
        <!-- //CONTENT WRAPPER -->

    <script src="../javascript/bootstrap.bundle.min.js"></script>
    <script src="../javascript/aos.js"></script>
    <script src="../javascript/main.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  </body>
</html>