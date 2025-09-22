<?php
$conn = mysqli_connect("localhost","root","","news_system");

if(isset($_POST['submit'])){
    $name = $_POST['name'];
    mysqli_query($conn,"INSERT INTO categories(name) VALUES('$name')");
    $success = "Category added!";
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Add Category</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

<div class="container mt-5" style="max-width:500px;">
  <h2 class="mb-4">Add Category</h2>

  <?php if(isset($success)){ ?>
    <div class="alert alert-success"><?= $success; ?></div>
  <?php } ?>

  <form method="post" class="bg-white p-4 border rounded">
    <div class="mb-3">
      <label class="form-label">Category Name</label>
      <input type="text" name="name" class="form-control" required>
    </div>
    <button type="submit" name="submit" class="btn btn-success w-100">Add</button>
  </form>

  <a href="view_categories.php" class="btn btn-secondary mt-3">Back to Categories</a>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
