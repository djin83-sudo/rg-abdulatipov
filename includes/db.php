<?php
/**
 * includes/db.php
 * Подключение к базе данных (PDO + MySQL)
 */

if (!defined('DB_HOST')) {
    require_once __DIR__ . '/config.php';
}

class Database {
    private static ?PDO $instance = null;

    public static function getInstance(): PDO {
        if (self::$instance === null) {
            try {
                $dsn = sprintf(
                    'mysql:host=%s;dbname=%s;charset=%s',
                    DB_HOST, DB_NAME, DB_CHARSET
                );
                self::$instance = new PDO($dsn, DB_USER, DB_PASS, [
                    PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
                    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
                    PDO::ATTR_EMULATE_PREPARES   => false,
                ]);
            } catch (PDOException $e) {
                if (DEBUG_MODE) {
                    die('Ошибка БД: ' . $e->getMessage());
                }
                die('Ошибка подключения к базе данных.');
            }
        }
        return self::$instance;
    }
}

function db(): PDO {
    return Database::getInstance();
}
