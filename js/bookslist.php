<?php 
   $host = "localhost";
	$user = "root";
	$pass = "";
	$db = "library_db";

	$conn = mysqli_connect($host, $user, $pass, $db);
    if(!$conn){
      echo"check your database connection";
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
    <link rel="stylesheet" href="../css/stylesIbti.css" />
    <link rel="stylesheet" href="../css/styling.css" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css" rel="stylesheet">

  </head>
  <body style="background-color: #B4A0E5;">
    <!-- CONTENT WRAPPER -->
      <div class="table-wrapper">
        <!-- HOME -->
         <h1 class="text-center fw-bold mt-5" style="color:black;">Our Books Collection</h1> 
        <p class="mt-2 mb-4 text-light text-center">
                    <i class="las la-book-open"></i>
                    Find Your Next Favorite
        </p>

        <!-- SEARCH BAR -->
        
          <input onkeyup="searchBooklist()"  type="text" name="query" class="form-control border-0 rounded-pill shadow-sm" type="search" placeholder="Search..." aria-label="Search" style="width: 80%; margin-left: 100px" id="bookslist-search-input">
          <br></br>
        
        <!--// SEARCH BAR -->
  
      <table id="bookslist" class="table table-bordered bg-white" style="--bs-bg-opacity: .3; border-color:black; text-align:center">
         <thead style="background: linear-gradient(rgba(192, 43, 185, 0.8), rgba(73, 4, 90, 0.8)) !important;background-size: cover;background-position: center;color:white;">
            <tr>
               <th>BookId</th>
               <th class="searchable">bookTitle</th>
               <th>author</th>
               <th>publisherName</th>
               <th>pagesNumber</th>
               <th>copiesNumber</th>
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
            <td><?php echo $row['pagesNumber'] ?></td>
            <td><?php echo $row['copiesNumber']; ?></td>
         </tbody>
         <?php 	}
            ?>
      </table>
      <script>
                    function searchBooklist() {
                        // Declare variables
                        var input, filter, table, tr, td, i, td_bookTitle, txtValue
                        input = document.getElementById("bookslist-search-input");
                        filter = input.value.toUpperCase();
                        table = document.getElementById("bookslist");
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

    <script src="../javascript/bootstrap.bundle.min.js"></script>
    <script src="../javascript/aos.js"></script>
    <script src="../javascript/main.js"></script>
    <script src="../javascript/booktable.js"></script>
  </body>
</html>