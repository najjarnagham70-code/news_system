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

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>All News</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

<div class="container mt-4">
  <h2 class="mb-3">All News</h2>

  <table class="table table-striped table-bordered">
    <thead class="table-dark">
      <tr>
        <th>Title</th>
        <th>Category</th>
        <th>Author</th>
        <th>Image</th>
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
            <?php if($row['image'] != ""){ ?>
              <img src="uploads/<?= $row['image']; ?>" width="100" class="img-thumbnail">
            <?php } ?>
          </td>
          <td>
            <a href="edit_news.php?id=<?= $row['id']; ?>" class="btn btn-sm btn-warning">Edit</a>
            <a href="delete_news.php?id=<?= $row['id']; ?>" class="btn btn-sm btn-danger">Delete</a>
          </td>
        </tr>
      <?php } ?>
    </tbody>
  </table>

  <a href="dashboard.php" class="btn btn-secondary mt-3">Back to Dashboard</a>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
