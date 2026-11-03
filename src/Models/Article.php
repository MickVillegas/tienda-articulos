<?php

declare(strict_types=1);

namespace App\Models;

use App\Config\Database;

class Article
{
    // Constructor PHP moderno, con promoción automática de propiedades
    public function __construct(
        public int $id,
        public string $title,
        public ?string $description,
        public float $price,
        public int $stock,
    ) {
    }

    // Obtener todos los artículos
    public static function all(): array
    {
        $pdo = Database::getConnection();
        $stmt = $pdo->query('SELECT * FROM articles ORDER BY id DESC');

        $articles = [];   // Así se declara un array vacío en PHP
        foreach ($stmt->fetchAll() as $row) {
            // Esto añade un elemento a la siguiente posición del array sin necesidad
            // de manipular el índice con un contador
            $articles[] = self::fromRow($row);
        }

        return $articles;
    }

    // Obtener un artículo por id
    public static function find(int $id): ?self   // Puede devolver Article o null
    {
        $pdo = Database::getConnection();
        $stmt = $pdo->prepare('SELECT * FROM articles WHERE id = :id');
        $stmt->execute(['id' => $id]);
        $row = $stmt->fetch();

        // Operador ternario. Funciona como en Java. 
        // Si $row es false, devuelve null; si no, devuelve el resultado de self::fromRow($row)
        // (=== compara valor y tipo, == compara solo valores y convierte tipos si es necesario)
        return $row === false ? null : self::fromRow($row);
    }

    // Insertar un artículo nuevo en la BD
    public static function create(string $title, ?string $description, float $price, int $stock): void
    {
        $pdo = Database::getConnection();
        $stmt = $pdo->prepare(
            'INSERT INTO articles (title, description, price, stock)
             VALUES (:title, :description, :price, :stock)'
        );

        $stmt->execute([
            'title'       => $title,
            'description' => $description,
            'price'       => $price,
            'stock'       => $stock,
        ]);
    }

    // Actualizar un artículo existente en la BD
    public function update(): void
    {
        $pdo = Database::getConnection();
        $stmt = $pdo->prepare(
            'UPDATE articles
             SET title = :title, description = :description, price = :price, stock = :stock
             WHERE id = :id'
        );

        $stmt->execute([
            'title'       => $this->title,
            'description' => $this->description,
            'price'       => $this->price,
            'stock'       => $this->stock,
            'id'          => $this->id,
        ]);
    }

    // Borrar un artículo de la BD
    public static function delete(int $id): void
    {
        $pdo = Database::getConnection();
        $stmt = $pdo->prepare('DELETE FROM articles WHERE id = :id');
        $stmt->execute(['id' => $id]);
    }

    // Crear un nuevo objeto Article a partir de los datos contenidos en $row.
    // Es un método auxiliar para no escribir varias veces lo mismo en los métodos anteriores.
    private static function fromRow(array $row): self
    {
        return new self(
            id: (int) $row['id'],
            title: $row['title'],
            description: $row['description'],
            price: (float) $row['price'],
            stock: (int) $row['stock'],
        );
    }
}
