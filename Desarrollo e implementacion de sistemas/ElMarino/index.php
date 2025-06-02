<?php
session_start();
include("includes/db.php");


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];
    $pass = $_POST['password'];

    $query = "SELECT * FROM usuarios WHERE email='$email' AND password='$pass'";
    $result = mysqli_query($conn, $query);

    if (mysqli_num_rows($result) === 1) {
        $_SESSION['user'] = $email;
        header("Location: dashboard.php");
        exit();
    } else {
        $error = "Correo o contraseña incorrectos.";
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Iniciar sesión - El Marino</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
  <link href="css/style.css" rel="stylesheet">
</head>
<body class="d-flex align-items-center justify-content-center vh-100 bg-light">
  <main class="form-signin text-center">
    <form method="POST" style="max-width: 320px; margin: auto;">
      <img class="mb-4" src="assets/logo.png" alt="El Marino" width="72" height="72">
      <h1 class="h3 mb-3 fw-normal">Please sign in</h1>

      <?php if (isset($error)) echo "<div class='alert alert-danger'>$error</div>"; ?>

      <div class="form-floating mb-2">
        <input type="email" class="form-control" name="email" id="email" placeholder="Correo electrónico" required>
        <label for="email">Email address</label>
      </div>
      <div class="form-floating mb-2">
        <input type="password" class="form-control" name="password" id="password" placeholder="Contraseña" required>
        <label for="password">Password</label>
      </div>

      <div class="checkbox mb-3">
        <label>
          <input type="checkbox" value="remember-me"> Remember me
        </label>
      </div>
      <button class="w-100 btn btn-lg btn-primary" type="submit">
        <i class="bi bi-box-arrow-in-right"></i> Sign in
      </button>
      <p class="mt-5 mb-3 text-muted">&copy; 2017–2025</p>
    </form>
  </main>
</body>
</html>

