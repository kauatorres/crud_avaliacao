<?php
date_default_timezone_set('America/Sao_Paulo');

$pdo = new PDO('mysql:host=localhost;dbname=teste_php', 'root', '');

try {
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo 'Erro ao conectar: ' . $e->getMessage();
}
