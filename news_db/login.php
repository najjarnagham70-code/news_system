<?php
session_start();
$conn = mysqli_connect("localhost","root","","news_system");

if(isset($_POST['submit'])){
    $email = $_POST['email'];
    $password = $_POST['password'];

    $res = mysqli_query($conn,"SELECT * FROM users WHERE email='$email' AND password='$password'");
    if(mysqli_num_rows($res) > 0){
        $row = mysqli_fetch_assoc($res);
        $_SESSION['user_id'] = $row['id'];
        $_SESSION['name'] = $row['name'];
        header("Location: dashboard.php");
        exit;
    } else {
        $error = "Invalid login!";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Login</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

<div class="container mt-5" style="max-width:500px;">
  <h2 class="mb-4">Login</h2>

  <?php if(isset($error)){ ?>
    <div class="alert alert-danger"><?= $error; ?></div>
  <?php } ?>

  <form method="post" class="bg-white p-4 border rounded">
    <div class="mb-3">
      <label class="form-label">Email</label>
      <input type="email" name="email" class="form-control" required>
    </div>
    <div class="mb-3">
      <label class="form-label">Password</label>
      <input type="password" name="password" class="form-control" required>
    </div>
    <button type="submit" name="submit" class="btn btn-primary w-100">Login</button>
  </form>

  <p class="mt-3 text-center">
    Don't have an account? <a href="register.php">Register</a>
  </p>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
