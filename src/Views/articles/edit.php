<?php /** @var \App\Models\Article $article */ ?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Editar artículo</title>
</head>
<body>
    <h1>Editar artículo</h1>

    <form action="/articles/update" method="post">
        <input type="hidden" name="csrf_token" value="<?= $_SESSION['csrf_token'] ?>">
        <input type="hidden" name="id" value="<?= $article->id ?>">

        <label>Título:
            <input type="text" name="title" value="<?= htmlspecialchars($article->title) ?>" required>
        </label><br>

        <label>Descripción:
            <textarea name="description"><?= htmlspecialchars($article->description ?? '') ?></textarea>
        </label><br>

        <label>Precio:
            <input type="number" step="0.01" name="price" value="<?= $article->price ?>" required>
        </label><br>

        <label>Stock:
            <input type="number" name="stock" value="<?= $article->stock ?>" required>
        </label><br>

        <button type="submit">Actualizar</button>
    </form>

    <p><a href="/articles">← Volver al listado</a></p>
</body>
</html>
