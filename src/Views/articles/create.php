<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Nuevo artículo</title>
</head>
<body>
    <h1>Nuevo artículo</h1>

    <form action="/articles" method="post">
        <input type="hidden" name="csrf_token" value="<?= $_SESSION['csrf_token'] ?>">

        <label>Título:
            <input type="text" name="title" required>
        </label><br>

        <label>Descripción:
            <textarea name="description"></textarea>
        </label><br>

        <label>Precio:
            <input type="number" step="0.01" name="price" required>
        </label><br>

        <label>Stock:
            <input type="number" name="stock" required>
        </label><br>

        <button type="submit">Guardar</button>
    </form>

    <p><a href="/articles">← Volver al listado</a></p>
</body>
</html>
