<?php
$conn = mysqli_connect("localhost","root","","news_system");

if(isset($_POST['submit'])){
    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = $_POST['password'];

    $sql = "INSERT INTO users (name,email,password) VALUES ('$name','$email','$password')";
    mysqli_query($conn,$sql);
    $success = "Account created!";
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Register</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

<div class="container mt-5" style="max-width:500px;">
  <h2 class="mb-4">Register</h2>

  <?php if(isset($success)){ ?>
    <div class="alert alert-success"><?= $success; ?></div>
  <?php } ?>

  <form method="post" class="bg-white p-4 border rounded">
    <div class="mb-3">
      <label class="form-label">Name</label>
      <input type="text" name="name" class="form-control" required>
    </div>
    <div class="mb-3">
      <label class="form-label">Email</label>
      <input type="email" name="email" class="form-control" required>
    </div>
    <div class="mb-3">
      <label class="form-label">Password</label>
      <input type="password" name="password" class="form-control" required>
    </div>
    <button type="submit" name="submit" class="btn btn-primary w-100">Register</button>
  </form>

  <p class="mt-3 text-center">
    Already have an account? <a href="login.php">Login</a>
  </p>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
