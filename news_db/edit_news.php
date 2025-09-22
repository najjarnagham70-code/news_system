<?php
session_start();
if(!isset($_SESSION['user_id'])) header("Location: login.php");

$conn = mysqli_connect("localhost","root","","news_system");

$id = $_GET['id'];
$news = mysqli_query($conn,"SELECT * FROM news WHERE id=$id");
$row = mysqli_fetch_assoc($news);

$categories = mysqli_query($conn,"SELECT * FROM categories");

if(isset($_POST['submit'])){
    $title = $_POST['title'];
    $category = $_POST['category'];
    $details = $_POST['details'];

    if(isset($_FILES['image']) && $_FILES['image']['name'] != ""){
        if(!file_exists("uploads")) mkdir("uploads",0777,true);
        $img = time()."_".$_FILES['image']['name'];
        move_uploaded_file($_FILES['image']['tmp_name'],"uploads/".$img);
        mysqli_query($conn,"UPDATE news SET title='$title', category_id='$category', details='$details', image='$img' WHERE id=$id");
    } else {
        mysqli_query($conn,"UPDATE news SET title='$title', category_id='$category', details='$details' WHERE id=$id");
    }
    $success = "News updated!";
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Edit News</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

<div class="container mt-5" style="max-width:600px;">
  <h2 class="mb-4">Edit News</h2>

  <?php if(isset($success)){ ?>
    <div class="alert alert-success"><?= $success; ?></div>
  <?php } ?>

  <form method="post" enctype="multipart/form-data" class="bg-white p-4 border rounded">
    <div class="mb-3">
      <label class="form-label">Title</label>
      <input type="text" name="title" class="form-control" value="<?= $row['title']; ?>" required>
    </div>

    <div class="mb-3">
      <label class="form-label">Category</label>
      <select name="category" class="form-select" required>
        <?php while($c=mysqli_fetch_assoc($categories)){
          $selected = ($c['id']==$row['category_id']) ? "selected" : "";
        ?>
          <option value="<?= $c['id']; ?>" <?= $selected; ?>><?= $c['name']; ?></option>
        <?php } ?>
      </select>
    </div>

    <div class="mb-3">
      <label class="form-label">Details</label>
      <textarea name="details" class="form-control" rows="5" required><?= $row['details']; ?></textarea>
    </div>

    <div class="mb-3">
      <label class="form-label">Image</label>
      <input type="file" name="image" class="form-control">
      <?php if($row['image'] != ""){ ?>
        <p class="mt-2">Current Image:</p>
        <img src="uploads/<?= $row['image']; ?>" width="150">
      <?php } ?>
    </div>

    <button type="submit" name="submit" class="btn btn-primary w-100">Update</button>
  </form>

  <a href="view_news.php" class="btn btn-secondary mt-3">Back to News</a>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
