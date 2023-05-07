<?php 
   require '../includes/snippet.php';
   require '../includes/db-inc.php';
   include "../includes/header.php"; 
   
   if(isset($_POST['submit'])) {
   
       $personId = sanitize(trim($_POST['personId']));
       $firstName = sanitize(trim($_POST['firstName']));
       $lastName = sanitize(trim($_POST['lastName']));
       $email = sanitize(trim($_POST['email']));
       $address = sanitize(trim($_POST['address']));
       $status = sanitize(trim($_POST['status']));
       $booksNumber = sanitize(trim($_POST['booksNumber']));
   
   
   
         $sql = "INSERT INTO subscribers( personId, firstName, lastName, email, address, status, booksNumber) VALUES ('$personId', '$firstName', '$lastName', '$email', '$address', '$status', '$booksNumber' ) ";
   
         $query = mysqli_query($conn, $sql);
         $error = false;
         if($query){
          $error = true;
         }
         else{
           echo "<script>alert('Registration failed!! Try again.');
                       </script>";
         }
        
   
   }
   
   ?>
<div style="background-color: #cc59f9ea">
   <div class="container" >
      
      <div class="container  col-lg-9 col-md-11 col-sm-12 col-xs-12 col-lg-offset-2 col-md-offset-1 col-sm-offset-0 col-xs-offset-0  " style="margin-top: 20px">
         <div class="jumbotron login col-lg-10 col-md-11 col-sm-12 col-xs-10">
            <?php if(isset($error) && $error === true) { ?>
            <div class="alert alert-success alert-dismissable">
               <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
               <strong>Record added Successfully!</strong>
            </div>
            <?php } ?>
            <p class="page-header" style="text-align: center"><b>ADD STUDENT</b></p>
            <div class="container">
               <form class="form-horizontal" role="form" action="addstudent.php" method="post" enctype="multipart/form-data">
                  <div class="form-group">
                     <label for="Username" class="col-sm-2 control-label">FIRST NAME</label>
                     <div class="col-sm-10">
                        <input type="text" class="form-control" name="firstName" placeholder="first Name" id="firstName" required>
                     </div>
                  </div>
                  <div class="form-group">
                     <label for="Password" class="col-sm-2 control-label">ID NO</label>
                     <div class="col-sm-10">
                        <input type="text" class="form-control" name="personId" placeholder="ID Number" id="personId" required>
                     </div>
                  </div>
                  <div class="form-group">
                     <label for="Password" class="col-sm-2 control-label">LAST NAME</label>
                     <div class="col-sm-10">
                        <input type="text" class="form-control" name="lastName" placeholder="last name" id="lastName" required>
                     </div>
                  </div>
                  <div class="form-group">
                     <label for="Password" class="col-sm-2 control-label">EMAIL</label>
                     <div class="col-sm-10">
                        <input type="email" class="form-control" name="email" placeholder="Email" id="email" required>
                     </div>
                  </div>
                  <div class="form-group">
                     <label for="Password" class="col-sm-2 control-label">ADDRESS</label>
                     <div class="col-sm-10">
                        <input type="text" class="form-control" name="address" placeholder="address" id="address" required>
                     </div>
                  </div>
                  <div class="form-group">
                     <label for="Password" class="col-sm-2 control-label">BOOKS NUMBER</label>
                     <div class="col-sm-10">
                        <input type="text" class="form-control" name="booksNumber" placeholder="books number" id="booksNumber" required>
                     </div>
                  </div>
                  <div class="form-group">
                     <label for="Password" class="col-sm-2 control-label">STATUS</label>
                     <div class="col-sm-10">
                        <input type="text" class="form-control" name="status" placeholder="status" id="status" required>
                     </div>
                  </div>
                  <div class="form-group">
                     <div class="col-sm-offset-2 col-sm-10">
                        <button   data-toggle="modal" data-target="#info" name="submit" style="background-color: #cc59f9ea; color:white;  border-radius: 8px; margin-left: 120px; margin-top: 20px; " >
                        ADD MEMBER
                        </button>                            
                     </div>
                  </div>
               </form>
            </div>
         </div>
      </div>
   </div>
</div>
<script type="text/javascript" src="../javascript/jquery.js"></script>
<script type="text/javascript" src="../javascript/bootstrap.js"></script>
</body>
</html>