<?php
class Database {
    private static $instance = null;
    private $pdo;

    private function __construct() {
        try {
            $host = 'localhost';
            $user = 'root';
            $pass = ''; 
            $dbname = 'rexsport';

            $this->pdo = new PDO("mysql:host=$host", $user, $pass);
            $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            // Auto-create DB & Tables (agar tidak perlu import SQL manual)
            $this->pdo->exec("CREATE DATABASE IF NOT EXISTS `$dbname`");
            $this->pdo->exec("USE `$dbname`");
            $this->initTables();
        } catch (PDOException $e) {
            die("Koneksi Gagal: " . $e->getMessage());
        }
    }

    public static function getInstance() {
        if (!self::$instance) {
            self::$instance = new Database();
        }
        return self::$instance->pdo;
    }

    private function initTables() {
        $this->pdo->exec("CREATE TABLE IF NOT EXISTS users (
            id INT AUTO_INCREMENT PRIMARY KEY,
            nama VARCHAR(100) NOT NULL,
            email VARCHAR(100) NOT NULL,
            role VARCHAR(20) DEFAULT 'member'
        ) ENGINE=InnoDB");

        $this->pdo->exec("CREATE TABLE IF NOT EXISTS fields (
            id INT AUTO_INCREMENT PRIMARY KEY,
            nama_lapangan VARCHAR(100) NOT NULL,
            jenis VARCHAR(50) NOT NULL,
            harga_per_jam DECIMAL(10,2) NOT NULL
        ) ENGINE=InnoDB");

        $this->pdo->exec("CREATE TABLE IF NOT EXISTS bookings (
            id INT AUTO_INCREMENT PRIMARY KEY,
            user_id INT,
            field_id INT,
            tanggal DATE,
            durasi INT,
            total_harga DECIMAL(10,2),
            FOREIGN KEY(user_id) REFERENCES users(id) ON DELETE CASCADE,
            FOREIGN KEY(field_id) REFERENCES fields(id) ON DELETE CASCADE
        ) ENGINE=InnoDB");

        $this->pdo->exec("CREATE TABLE IF NOT EXISTS reviews (
            id INT AUTO_INCREMENT PRIMARY KEY,
            booking_id INT,
            rating INT,
            komentar TEXT,
            FOREIGN KEY(booking_id) REFERENCES bookings(id) ON DELETE CASCADE
        ) ENGINE=InnoDB");
    }
}
?>