<?php
    function conectar(){
        $host = 'db'; 
        $dbname = 'professor_mensuring';
        $user = 'root';
        $password = 'root';

        $conn = "mysql:host=$host;dbname=$dbname;charset=utf8mb4";
        try {
            return new PDO($conn, $user, $password, [
               PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION, // tratar erro
               PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC, // trate a resposta
            ]);
        } catch (PDOException $e){
           die('Erro ao conectar o banco de dados' . $e->getMessage());
        }
    }
?>