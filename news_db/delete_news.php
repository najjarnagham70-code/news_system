<?php
$conn = mysqli_connect("localhost","root","","news_system");
$id = $_GET['id'];

mysqli_query($conn,"UPDATE news SET deleted=1 WHERE id=$id");

header("Location: dashboard.php?msg=deleted");
exit;
?>
