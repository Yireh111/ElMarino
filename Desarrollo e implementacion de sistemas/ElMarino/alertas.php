<?php
session_start();
if (!isset($_SESSION['user'])) {
    header("Location: index.php");
    exit();
}

include("includes/db.php");

// Productos con stock menor o igual a 5
$query = "SELECT * FROM productos WHERE stock <= 5";
$resultado = mysqli_query($conn, $query);
?>

<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Alertas de Stock - El Marino</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
  <link href="css/style.css" rel="stylesheet">
</head>
<body>
  <?php include("includes/navbar.php"); ?>

  <main class="container mt-4">
    <h2><i class="bi bi-exclamation-triangle-fill text-danger"></i> Alertas de Stock Bajo</h2>

    <?php if (mysqli_num_rows($resultado) > 0): ?>
      <table class="table table-bordered mt-3">
        <thead class="table-danger">
          <tr>
            <th>ID</th>
            <th>Producto</th>
            <th>Stock</th>
          </tr>
        </thead>
        <tbody>
          <?php while($row = mysqli_fetch_assoc($resultado)): ?>
            <tr>
              <td><?= $row['id'] ?></td>
              <td><?= $row['nombre'] ?></td>
              <td><?= $row['stock'] ?></td>
            </tr>
          <?php endwhile; ?>
        </tbody>
      </table>
    <?php else: ?>
      <div class="alert alert-success mt-3">
        No hay productos con stock bajo. ¡Todo bien!
      </div>
    <?php endif; ?>
  </main>

  <?php include("includes/footer.php"); ?>
</body>
</html>
