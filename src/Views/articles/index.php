<?php /** @var \App\Models\Article[] $articles */ ?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Artículos</title>
</head>
<body>
    <h1>Artículos</h1>

    <?php if (!empty($_SESSION['success'])): ?>
        <p style="color: green;"><?= htmlspecialchars($_SESSION['success']) ?></p>
        <?php unset($_SESSION['success']); ?>
    <?php endif; ?>

    <?php if (!empty($_SESSION['error'])): ?>
        <p style="color: red;"><?= htmlspecialchars($_SESSION['error']) ?></p>
        <?php unset($_SESSION['error']); ?>
    <?php endif; ?>

    <p><a href="/articles/create">➕ Nuevo artículo</a></p>

    <table border="1" cellpadding="6">
        <thead>
            <tr>
                <th>ID</th>
                <th>Título</th>
                <th>Precio</th>
                <th>Stock</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($articles as $article): ?>
                <tr>
                    <td><?= $article->id ?></td>
                    <td><?= htmlspecialchars($article->title) ?></td>
                    <td><?= number_format($article->price, 2) ?> €</td>
                    <td><?= $article->stock ?></td>
                    <td>
                        <a href="/articles/edit?id=<?= $article->id ?>">Editar</a>

                        <form action="/articles/delete" method="post" style="display:inline"
                              onsubmit="return confirm('¿Seguro que quieres eliminar este artículo?');">
                            <input type="hidden" name="id" value="<?= $article->id ?>">
                            <input type="hidden" name="csrf_token" value="<?= $_SESSION['csrf_token'] ?>">
                            <button type="submit">Eliminar</button>
                        </form>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</body>
</html>
