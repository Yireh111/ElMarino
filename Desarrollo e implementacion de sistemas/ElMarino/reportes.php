<?php
session_start();
if (!isset($_SESSION['user'])) {
    header("Location: index.php");
    exit();
}

include("includes/db.php");

// Consulta para mostrar todos los productos y su stock
$query = "SELECT * FROM productos";
$resultado = mysqli_query($conn, $query);
?>

<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Reportes - El Marino</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
  <link href="css/style.css" rel="stylesheet">
</head>
<body>
  <?php include("includes/navbar.php"); ?>

  <main class="container mt-4">
    <h2><i class="bi bi-bar-chart-line"></i> Reporte de Inventario</h2>

    <table class="table table-striped table-bordered mt-3">
      <thead class="table-warning">
        <tr>
          <th>ID</th>
          <th>Nombre del producto</th>
          <th>Precio</th>
          <th>Stock actual</th>
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
