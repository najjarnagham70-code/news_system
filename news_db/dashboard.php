<?php
session_start();
if(!isset($_SESSION['user_id'])) header("Location: login.php");

$conn = mysqli_connect("localhost","root","","news_system");
$res = mysqli_query($conn,"SELECT news.*, categories.name AS cat_name, users.name AS user_name 
  FROM news 
  JOIN categories ON news.category_id=categories.id 
  JOIN users ON news.user_id=users.id 
  WHERE deleted=0");
?>
<?php if(isset($_GET['msg']) && $_GET['msg']=='deleted'){ ?>
<div class="alert alert-success">News deleted successfully!</div>
<?php } ?>


<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Dashboard</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

<div class="container mt-4">
  <h1 class="mb-4">Welcome <?= $_SESSION['name']; ?></h1>

  <div class="mb-4">
    <a href="add_category.php" class="btn btn-success">Add Category</a>
    <a href="view_categories.php" class="btn btn-info">View Categories</a>
    <a href="add_news.php" class="btn btn-primary">Add News</a>
    <a href="view_news.php" class="btn btn-secondary">View News</a>
    <a href="deleted_news.php" class="btn btn-warning">Deleted News</a>
  </div>

  <h2>All News</h2>
  <table class="table table-striped table-bordered">
    <thead class="table-dark">
      <tr>
        <th>Title</th>
        <th>Category</th>
        <th>Author</th>
        <th>Actions</th>
      </tr>
    </thead>
    <tbody>
      <?php while($row = mysqli_fetch_assoc($res)){ ?>
        <tr>
          <td><?= $row['title']; ?></td>
          <td><?= $row['cat_name']; ?></td>
          <td><?= $row['user_name']; ?></td>
          <td>
            <a href="edit_news.php?id=<?= $row['id']; ?>" class="btn btn-sm btn-warning">Edit</a>
            <a href="delete_news.php?id=<?= $row['id']; ?>" class="btn btn-sm btn-danger">Delete</a>
          </td>
        </tr>
      <?php } ?>
    </tbody>
  </table>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
