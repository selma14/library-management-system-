<?php
   require '../includes/db-inc.php';
   include "../includes/header.php";  

   if(isset($_POST['submit'])){
   
    $title = $_POST['title'];
    $author = $_POST['author'];
    $id = $_POST['id'];
    $publisher = $_POST['publisher'];
    $copies = $_POST['copies'];
    $pages = $_POST['pages'];

    $sql = "INSERT INTO books(bookTitle, author, bookId, publisherName, copiesNumber, pagesNumber)
                 values ('$title','$author','$id', '$publisher','$copies','$pages')";
    
    $query = mysqli_query($conn, $sql);

    if($query){
        echo "<script>alert('New Book has been added ');
                location.href ='bookstable.php';
                 </script>";
    }
    else {
        echo "<script>alert('Book not added!');
                 </script>"; 
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
<body  data-bs-spy="scroll" data-bs-target=".navbar" class="d-flex align-items-center justify-content-center" style="background-color: #B4A0E5;">
  <div class="container  col-lg-9 col-md-11 col-sm-12 col-xs-12 col-lg-offset-2 col-md-offset-1 col-sm-offset-0 col-xs-offset-0  " style="margin-top: 20px">
   <div style="font-size: 13px;" class="jumbotron login2 col-lg-10 col-md-11 col-sm-12 col-xs-12">
      <p class="page-header text-dark" style="text-align: center; font-weight: bold; font-size: 23px;">ADD BOOK</p>
      <div class="container">
         <form class="form-horizontal" role="form" enctype="multipart/form-data" action="addbook.php" method="post">
<div class="form-group">
               <label for="id" class="col-sm-2 control-label text-dark">BOOK ID</label>
               <div class="col-sm-10">
                  <input type="text" class="addbookInput form-control" name="id" placeholder="Enter Book Id" id="password" required>
               </div>
            </div>
            <div class="form-group">
               <label for="title" class="col-sm-2 control-label text-dark">BOOK TITLE</label>
               <div class="col-sm-10">
                  <input type="text" class="addbookInput form-control" name="title" placeholder="Enter title" id="password" required>
               </div>
            </div>
            <div class="form-group">
               <label for="author" class="col-sm-2 control-label text-dark">AUTHOR</label>
               <div class="col-sm-10">
                  <input type="text" class="addbookInput form-control" name="author" placeholder="Enter Author" id="password" required>
               </div>
            </div>
            <div class="form-group">
               <label for="publisher" class="col-sm-2 control-label text-dark">PUBLISHER</label>
               <div class="col-sm-10">
                  <input type="text" class="addbookInput form-control" name="publisher" placeholder="Enter Publisher" id="password" required>
               </div>
            </div>
            <div class="form-group">
               <label for="pages" class="col-sm-2 control-label text-dark">PAGES</label>
               <div class="col-sm-10">
                  <input type="text" class="addbookInput form-control" name="pages" placeholder="Enter Pages Number" id="password" required>
               </div>
            </div>
            <div class="form-group">
               <label for="copies" class="col-sm-2 control-label text-dark">Copies</label>
               <div class="col-sm-10">
                  <input type="text" class="addbookInput form-control" name="copies" placeholder="Enter Copies Number" id="password" required>
               </div>
            </div>
<div class="modal-footer">
                  <button  name="submit" class="btn col-lg-4 mt-5" style="font-size: 13px;background-color: #B4A0E5;" data-toggle="modal" data-target="#info" >
                  ADD BOOK
                  </button>
            </div>
         </form>
      </div>
   </div>
</div>
<script type="text/javascript" src="js/jquery.js"></script>
<script type="text/javascript" src="js/bootstrap.js"></script>
</body>
</html>
