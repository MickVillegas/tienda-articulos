<?php /** @var \App\Models\Article $article */ ?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title><?= htmlspecialchars($article->title) ?></title>
</head>
<body>
    <h1><?= htmlspecialchars($article->title) ?></h1>

    <p><strong>ID:</strong> <?= $article->id ?></p>
    <p><strong>Precio:</strong> <?= number_format($article->price, 2) ?> €</p>
    <p><strong>Stock disponible:</strong> <?= $article->stock ?> unidades</p>

    <?php if ($article->description): ?>
        <h2>Descripción</h2>
        <p><?= htmlspecialchars($article->description) ?></p>
    <?php endif; ?>

    <hr>

    <p>
        <a href="/articles/edit?id=<?= $article->id ?>">✏️ Editar</a>

        <form action="/articles/delete" method="post" style="display:inline"
              onsubmit="return confirm('¿Seguro que quieres eliminar este artículo?');">
            <input type="hidden" name="id" value="<?= $article->id ?>">
            <input type="hidden" name="csrf_token" value="<?= $_SESSION['csrf_token'] ?>">
            <button type="submit">🗑️ Eliminar</button>
        </form>
    </p>

    <p><a href="/articles">← Volver al listado</a></p>
</body>
</html>
