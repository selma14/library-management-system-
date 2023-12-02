<?php
require '../includes/db-inc.php';

// Retrieve the form data using the $_POST superglobal
$personId = $_POST['personId'];
$firstName = $_POST['firstName'];
$lastName = $_POST['lastName'];
$email = $_POST['email'];
$address = $_POST['address'];
$status = $_POST['status'];
$booksNumber = $_POST['booksNumber'];

// Update the subscriber's information in the database
$sql = "UPDATE subscribers SET firstName='$firstName', lastName='$lastName', email='$email', address='$address', status='$status', booksNumber='$booksNumber' WHERE personId='$personId'";
$query = mysqli_query($conn, $sql);

if ($query) {
  // If the query was successful, redirect to the subscribers page with a success message
  header('Location: admin.php?status=success&message=Subscriber updated successfully.');
} else {
  // If the query failed, redirect to the subscribers page with an error message
  header('Location: admin.php?status=error&message=Subscriber update failed.');
}
?>
