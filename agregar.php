<?php
require_once "db.php";
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $stmt = $pdo->prepare("INSERT INTO contactos (nombre, telefono, email, categoria) VALUES (:nombre, :tel, :email, :cat)");
    $stmt->execute([":nombre" => $_POST["nombre"], ":tel" => $_POST["telefono"], ":email" => $_POST["email"], ":cat" => $_POST["categoria"]]);
    header("Location: index.php");
    exit;
}
?>
<!DOCTYPE html>
<html lang="es">
<head><meta charset="UTF-8"><title>Agregar Contacto</title><link rel="stylesheet" href="style.css"></head>
<body>
<div class="container">
  <h1>➕ Agregar Contacto</h1>
  <form method="POST">
    <input type="text"  name="nombre"    placeholder="Nombre completo" required>
    <input type="tel"   name="telefono"  placeholder="Teléfono">
    <input type="email" name="email"     placeholder="Correo electrónico">
    <select name="categoria">
      <option value="General">General</option>
      <option value="Trabajo">Trabajo</option>
      <option value="Familia">Familia</option>
      <option value="Amigos">Amigos</option>
    </select>
    <button type="submit">Guardar Contacto</button>
    <a href="index.php">← Volver</a>
  </form>
</div>
</body></html>
