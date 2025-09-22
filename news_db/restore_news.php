<?php
session_start();
if(!isset($_SESSION['user_id'])) header("Location: login.php");

$conn = mysqli_connect("localhost","root","","news_system");
$id = $_GET['id'];

mysqli_query($conn,"UPDATE news SET deleted=0 WHERE id=$id");

header("Location: deleted_news.php?msg=restored");
exit;
?>
