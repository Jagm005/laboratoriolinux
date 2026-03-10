<?php
require_once "db.php";
$buscar = $_GET["q"] ?? "";
$stmt = $pdo->prepare("SELECT * FROM contactos WHERE nombre LIKE :q ORDER BY fecha_creacion DESC");
$stmt->execute([":q" => "%$buscar%"]);
$contactos = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html lang="es">
<head><meta charset="UTF-8"><title>Agenda de Contactos</title><link rel="stylesheet" href="style.css"></head>
<body>
<div class="container">
  <h1>📋 Agenda de Contactos</h1>
  <div class="toolbar">
    <form method="GET">
      <input type="text" name="q" placeholder="🔍 Buscar por nombre..." value="<?= htmlspecialchars($buscar) ?>">
      <button type="submit">Buscar</button>
    </form>
    <a href="agregar.php" class="btn-add">➕ Nuevo Contacto</a>
  </div>
  <table>
    <thead><tr><th>Nombre</th><th>Teléfono</th><th>Email</th><th>Categoría</th><th>Fecha</th><th>Acción</th></tr></thead>
    <tbody>
    <?php foreach ($contactos as $c): ?>
      <tr>
        <td><?= htmlspecialchars($c["nombre"]) ?></td>
        <td><?= htmlspecialchars($c["telefono"]) ?></td>
        <td><?= htmlspecialchars($c["email"]) ?></td>
        <td><span class="badge"><?= htmlspecialchars($c["categoria"]) ?></span></td>
        <td><?= date("d/m/Y", strtotime($c["fecha_creacion"])) ?></td>
        <td><a href="eliminar.php?id=<?= $c["id"] ?>" onclick="return confirm('¿Eliminar?')">🗑️</a></td>
      </tr>
    <?php endforeach; ?>
    <?php if (empty($contactos)): ?>
      <tr><td colspan="6" style="text-align:center">No hay contactos aún.</td></tr>
    <?php endif; ?>
    </tbody>
  </table>
</div>
</body></html>
