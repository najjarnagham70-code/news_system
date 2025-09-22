<?php
session_start();
if(!isset($_SESSION['user_id'])) header("Location: login.php");

$conn = mysqli_connect("localhost","root","","news_system");
$categories = mysqli_query($conn,"SELECT * FROM categories");

if(isset($_POST['submit'])){
    $title = $_POST['title'];
    $category = $_POST['category'];
    $details = $_POST['details'];
    $user = $_SESSION['user_id'];

    $img = "";
if(!empty($_FILES['image']['name'])){
    $img = $_FILES['image']['name'];
    move_uploaded_file($_FILES['image']['tmp_name'], "uploads/".$img);
}

    mysqli_query($conn,"INSERT INTO news(title,category_id,details,image,user_id) 
        VALUES('$title','$category','$details','$img','$user')");
    $success = "News added!";
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Add News</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

<div class="container mt-5" style="max-width:600px;">
  <h2 class="mb-4">Add News</h2>

  <?php if(isset($success)){ ?>
    <div class="alert alert-success"><?= $success; ?></div>
  <?php } ?>

  <form method="post" enctype="multipart/form-data" class="bg-white p-4 border rounded">
    <div class="mb-3">
      <label class="form-label">Title</label>
      <input type="text" name="title" class="form-control" required>
    </div>

    <div class="mb-3">
      <label class="form-label">Category</label>
      <select name="category" class="form-select" required>
        <?php while($c = mysqli_fetch_assoc($categories)){ ?>
          <option value="<?= $c['id']; ?>"><?= $c['name']; ?></option>
        <?php } ?>
      </select>
    </div>

    <div class="mb-3">
      <label class="form-label">Details</label>
      <textarea name="details" class="form-control" rows="5" required></textarea>
    </div>

    <div class="mb-3">
      <label class="form-label">Image</label>
      <input type="file" name="image" class="form-control">
    </div>

    <button type="submit" name="submit" class="btn btn-primary w-100">Add News</button>
  </form>

  <a href="dashboard.php" class="btn btn-secondary mt-3">Back to Dashboard</a>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
