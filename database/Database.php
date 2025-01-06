<?php

class Database
{
    private $host = 'localhost';
    private $database = 'login_crud';
    private $username = 'root';
    private $password = 'root';
    protected $pdo;

    public function __construct()
    {
        try {
            $this->pdo = new PDO(
                "mysql:host={$this->host};dbname={$this->database};charset=utf8",
                $this->username,
                $this->password
            );
            $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            die("Erro ao conectar ao banco de dados: " . $e->getMessage());
        }
    }

}

?>
