<?php
session_start();
if (!isset($_SESSION['user'])) {
    header("Location: index.php");
    exit();
}

include("includes/db.php");

// Obtener productos para el select
$sql = "SELECT id, nombre FROM productos";
$productos = mysqli_query($conn, $sql);
?>

<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Registrar Venta - El Marino</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
  <link href="css/style.css" rel="stylesheet">
</head>
<body>
  <?php include("includes/navbar.php"); ?>

  <main class="container mt-4">
    <h2><i class="bi bi-cart-check"></i> Registrar Venta</h2>

    <form action="ventas.php" method="POST" class="mt-3">
      <div class="mb-3">
        <label for="producto" class="form-label">Producto</label>
        <select name="producto" id="producto" class="form-select" required>
          <option value="">Seleccione un producto</option>
          <?php while ($row = mysqli_fetch_assoc($productos)): ?>
            <option value="<?= $row['id'] ?>"><?= $row['nombre'] ?></option>
          <?php endwhile; ?>
        </select>
      </div>

      <div class="mb-3">
        <label for="cantidad" class="form-label">Cantidad</label>
        <input type="number" name="cantidad" class="form-control" min="1" required>
      </div>

      <button type="submit" class="btn btn-success">
        <i class="bi bi-save"></i> Registrar
      </button>
    </form>

    <?php
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $producto_id = $_POST['producto'];
        $cantidad = $_POST['cantidad'];

        // Restar stock
        $actualizar = "UPDATE productos SET stock = stock - $cantidad WHERE id = $producto_id AND stock >= $cantidad";
        $ejecutado = mysqli_query($conn, $actualizar);

        if ($ejecutado && mysqli_affected_rows($conn) > 0) {
            echo "<div class='alert alert-success mt-3'>Venta registrada correctamente.</div>";
        } else {
            echo "<div class='alert alert-danger mt-3'>No se pudo registrar la venta (verifique stock).</div>";
        }
    }
    ?>
  </main>

  <?php include("includes/footer.php"); ?>
</body>
</html>
