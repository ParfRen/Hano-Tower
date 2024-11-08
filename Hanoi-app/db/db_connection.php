<?php
// Connexion à la base de données
$host = 'localhost';
$port = '3306';
$db = 'hanoi_game';
$user = 'root';
$password = 'ROOT';

try {
    $pdo = new PDO("mysql:host=$host;port=$port;dbname=$db;charset=utf8", $user, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Erreur de connexion : " . $e->getMessage());
}
?>
