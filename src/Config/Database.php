<?php

declare(strict_types=1);

namespace App\Config;

use PDO;
use PDOException;

class Database
{
    private static ?PDO $connection = null;   // Esta línea "huele" a Java, pero es rara, ¿verdad? Luego la explicamos

    public static function getConnection(): PDO
    {
        if (self::$connection === null) {     // self en PHP = this en Java
            $host = 'localhost';
            $dbName = 'tienda';
            $user = 'root';
            $password = '';

            $dsn = "mysql:host={$host};dbname={$dbName};charset=utf8mb4";

            try {
                self::$connection = new PDO($dsn, $user, $password, [
                    PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
                    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
                ]);
            } catch (PDOException $e) {
                // die finaliza la ejecución bruscamente tras mostrar el mensaje error
                // (es como una "salida de emergencia" en caso de error grave)
                die('Error de conexión a la base de datos: ' . $e->getMessage());
            }
        }

        return self::$connection;
    }
}
