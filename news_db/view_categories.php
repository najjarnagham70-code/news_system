<?php
$conn = mysqli_connect("localhost","root","","news_system");
$res = mysqli_query($conn,"SELECT * FROM categories");
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>View Categories</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

<div class="container mt-4">
  <h2 class="mb-3">Categories</h2>

  <table class="table table-striped table-bordered">
    <thead class="table-dark">
      <tr>
        <th>ID</th>
        <th>Name</th>
      </tr>
    </thead>
    <tbody>
      <?php while($row = mysqli_fetch_assoc($res)){ ?>
        <tr>
          <td><?= $row['id']; ?></td>
          <td><?= $row['name']; ?></td>
        </tr>
      <?php } ?>
    </tbody>
  </table>

  <a href="add_category.php" class="btn btn-success mt-3">Add New Category</a>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
