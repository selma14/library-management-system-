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
              <a class="nav-link" href="bookstable.php">Books</a>
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
               <input type="text" id="search-input" onkeyup="searchTable()" placeholder="  Search..." style="border-radius: 8px; width: 200px; color:black">
               <button id="search-btn" onkeyup="searchTable()" style="background-color: #660066; border-radius: 8px">Search</button>
               <br></br>
               <table class="table table-bordered" id="myTable">
                  <thead>
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
                           <button name="submit" style="background-color: #660066 ; color:white;  border-radius: 8px" >DELETE</button>
                        </form> 
                     </td>
                     <td>
                        <form method="post" action="modify_entry.php">
                            <input type="hidden" name="personId" value="<?php echo $row['personId']; ?>">
                            <button type="submit" style="background-color: #660066 ; color:white;  border-radius: 8px">Update</button>
                        </form>
                     </td>
                     </tr> 
                     <?php } ?>
                  </tbody> 
                  
               </table>
               <script>
                  function searchTable() {
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
                  <a href="addstudent.php"><button  style="margin-left: 15px;margin-bottom: 5px; background-color: #660066; width : 100px ;border-radius: 8px"><span class="glyphicon glyphicon-plus-sign"></span> Add Student</button></a>
               </div>
            </div>
        </section>
        <!-- //STUDENTS -->
        <!-- //CONTENT WRAPPER -->

    <script src="../javascript/bootstrap.bundle.min.js"></script>
    <script src="../javascript/aos.js"></script>
    <script src="../javascript/main.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  </body>
</html>