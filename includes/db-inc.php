<?php 
	$host = "localhost";
	$user = "root";
	$pass = "";
	$db = "library_db";

	$conn = mysqli_connect($host, $user, $pass, $db);
    if($conn){
        echo"connection to database is successful";
    }
    else{
        echo"check your database connection";
    }
?>