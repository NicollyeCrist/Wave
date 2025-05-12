<?php

class DbConnection {
    private static $instance;

    private static $hostname = "localhost";
    private static $db = "mesominds";
    private static $user = "root";
    private static $pass = "";

    public static function getConn() {
        if (!isset(self::$instance)) {
            try {
                self::$instance = new PDO(
                    "mysql:host=" . self::$hostname . ";dbname=" . self::$db . ";charset=utf8",
                    self::$user,
                    self::$pass
                );
                self::$instance->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            } catch (PDOException $e) {
                echo "Erro na conexão: " . $e->getMessage();
                die();
            }
        }

        return self::$instance;
    }
}
?>
