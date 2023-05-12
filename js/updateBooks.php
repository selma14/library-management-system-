<?php
require '../includes/db-inc.php';

// Retrieve the form data using the $_POST superglobal
$title = $_POST['title'];
$author = $_POST['author'];
$bookId = $_POST['bookId'];
$publisher = $_POST['publisher'];
$copies = $_POST['copies'];
$pages = $_POST['pages'];

// Update the Book's information in the database
$sql = "UPDATE books SET bookTitle='$title', author='$author', publisherName='$publisher', copiesNumber='$copies', pagesNumber='$pages' WHERE bookId='$bookId'";
$query = mysqli_query($conn, $sql);

if($query) {
    echo "<script>alert('Book updated');
    location.href ='admin.php';
    </script>";
} else {
    echo "<script>alert('Book update failed');
    location.href ='admin.php';
    </script>";;
}
?>