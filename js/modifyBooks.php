<?php
require '../includes/db-inc.php';
include "../includes/header.php";

$personId = $_POST['bookId'];
$bookId = $_POST['bookId'];


$sql = "SELECT * FROM books WHERE bookId = '$bookId'";
$query = mysqli_query($conn, $sql);
$row = mysqli_fetch_assoc($query);
?>

<html>
<body class="d-flex align-items-center justify-content-center" style="background-color: #A42AB0;">
  <div class="container  col-lg-9 col-md-11 col-sm-12 col-xs-12 col-lg-offset-2 col-md-offset-1 col-sm-offset-0 col-xs-offset-0  " style="margin-top: 20px">
   <div style="font-size: 13px;" class="jumbotron login2 col-lg-10 col-md-11 col-sm-12 col-xs-12">
      <p class="page-header text-dark" style="text-align: center; font-weight: bold; font-size: 23px;">UPDATE BOOK</p>
      <div class="container">
         <form class="form-horizontal" role="form" enctype="multipart/form-data" action="updateBooks.php" method="post">
         <input type="hidden" name="bookId" value="<?php echo $row['bookId']; ?>">
            <div class="form-group">
               <label for="title" class="col-sm-2 control-label text-dark">BOOK TITLE</label>
               <div class="col-sm-10">
                  <input type="text" class="form-control" name="title" placeholder="update title" id="password" required>
               </div>
            </div>
            <div class="form-group">
               <label for="author" class="col-sm-2 control-label text-dark">AUTHOR</label>
               <div class="col-sm-10">
                  <input type="text" class="form-control" name="author" placeholder="update Author" id="password" required>
               </div>
            </div>
            <div class="form-group">
               <label for="publisher" class="col-sm-2 control-label text-dark">PUBLISHER</label>
               <div class="col-sm-10">
                  <input type="text" class="form-control" name="publisher" placeholder="update Publisher" id="password" required>
               </div>
            </div>
            <div class="form-group">
               <label for="pages" class="col-sm-2 control-label text-dark">PAGES</label>
               <div class="col-sm-10">
                  <input type="text" class="form-control" name="pages" placeholder="update Pages Number" id="password" required>
               </div>
            </div>
            <div class="form-group">
               <label for="copies" class="col-sm-2 control-label text-dark">Copies</label>
               <div class="col-sm-10">
                  <input type="text" class="form-control" name="copies" placeholder="update Copies Number" id="password" required>
               </div>
            </div>
            <div class="modal-footer">
                  <button  name="submit" class="btn col-lg-2 mt-5" style="font-weight: bold; color:white; font-size: 15px;background-color: #A42AB0;" data-toggle="modal" data-target="#info" >
                  Update
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
