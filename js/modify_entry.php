<?php
require '../includes/db-inc.php';
// Retrieve the personId value from the URL parameter
$personId = $_POST['personId'];

// Retrieve the subscriber's information from the database based on the personId value
$sql = "SELECT * FROM subscribers WHERE personId = '$personId'";
$query = mysqli_query($conn, $sql);
$row = mysqli_fetch_assoc($query);
?>

<!-- HTML form for modifying the subscriber's information -->
<html style="background-color: #cc59f9ea">
    
                <p class="page-header" style="margin-left: 30px"><b>UPDATE SUBSCRIBER</b></p>
                <br></br>
                <body style="margin-left: 500px">
                    <form method="POST" action="update_entry.php" role="form"  >
                        <input type="hidden" name="personId" value="<?php echo $row['personId']; ?>">
                        <div class="form-group">
                            <label for="firstName" >First Name:</label>
                            <input type="text" class="form-control" id="firstName" name="firstName" value="<?php echo $row['firstName']; ?>">
                        </div>
                        <br></br>
                        <div class="form-group">
                            <label for="lastName" >Last Name:</label>
                            <input type="text" class="form-control" id="lastName" name="lastName" value="<?php echo $row['lastName']; ?>">
                        </div>
                        <br></br>
                        <div class="form-group">
                            <label for="email" >Email:</label>
                            <input type="email" class="form-control" id="email" name="email" value="<?php echo $row['email']; ?>">
                        </div>
                        <br></br>
                        <div class="form-group">
                            <label for="address" >Address:</label>
                            <input type="text" class="form-control" id="address" name="address" value="<?php echo $row['address']; ?>">
                        </div>
                        <br></br>
                        <div class="form-group">
                            <label for="status" >Status:</label>
                            <input type="text" class="form-control" id="status" name="status" value="<?php echo $row['status']; ?>">
                        </div>
                        <br></br>
                        <div class="form-group">
                            <label for="booksNumber" >Books Number:</label>
                            <input type="number" class="form-control" id="booksNumber" name="booksNumber" value="<?php echo $row['booksNumber']; ?>">
                        </div>
                        <br></br>
                        <button type="submit" class="btn btn-primary">Update</button>
                    </form>
                </body>
</html>               
            
        
