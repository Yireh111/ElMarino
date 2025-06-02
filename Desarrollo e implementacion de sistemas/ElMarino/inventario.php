<?php
session_start();
if (!isset($_SESSION['user'])) {
    header("Location: index.php");
    exit();
}

include("includes/db.php");

// Obtener productos
$sql = "SELECT * FROM productos";
$resultado = mysqli_query($conn, $sql);
?>

<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Inventario - El Marino</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
  <link href="css/style.css" rel="stylesheet">
</head>
<body>
  <?php include("includes/navbar.php"); ?>

  <main class="container mt-4">
    <h2><i class="bi bi-box-seam"></i> Inventario</h2>
    <table class="table table-bordered table-hover mt-3">
      <thead class="table-success">
        <tr>
          <th>ID</th>
          <th>Nombre</th>
          <th>Precio</th>
          <th>Stock</th>
        </tr>
      </thead>
      <tbody>
        <?php while($row = mysqli_fetch_assoc($resultado)): ?>
          <tr>
            <td><?= $row['id'] ?></td>
            <td><?= $row['nombre'] ?></td>
            <td>$<?= $row['precio'] ?></td>
            <td><?= $row['stock'] ?></td>
          </tr>
        <?php endwhile; ?>
      </tbody>
    </table>
  </main>

  <?php include("includes/footer.php"); ?>
</body>
</html>
