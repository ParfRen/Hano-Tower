<?php
session_start();
//require_once 'inc/header.php'; //s'attendre à devoir le modifier
require_once 'db/db_connection.php';

$user_id = $_SESSION['user_id'];

// Récupération du meilleur score de l'utilisateur
$stmt = $pdo->prepare("SELECT MIN(score) AS best_score FROM scores WHERE user_id = :user_id");
$stmt->execute(['user_id' => $user_id]);
$userBestScore = $stmt->fetchColumn();

// Récupération du meilleur score global
$stmt = $pdo->query("SELECT MIN(score) AS best_global_score FROM scores");
$globalBestScore = $stmt->fetchColumn();
?>


<!DOCTYPE html>
<html lang="fr">
<head>
    <link rel="stylesheet" href="assets/css/styles.css">
    <title>Meilleurs Scores</title>
</head>
<body>
    <div class="header">
        <h1 style="text-align: center; margin-top: 20px;">Tours de Hanoï</h1>
        <!--<a href="logout.php" style="float: right;margin-right: 20px;">Déconnexion</a>-->
    </div>

    <div class="center-box">
        <h2>Meilleurs Scores</h2>
        <div>
            <p>Votre meilleur score : <?php echo $userBestScore !== null ? $userBestScore : "Pas encore de score"; ?></p>
            <p>Meilleur score global : <?php echo $globalBestScore !== null ? $globalBestScore : "Pas encore de score"; ?> </p>
        </div>
        <br>
        <a href="home.php" class="button">Quitter</a>
    </div>
</body>
</html>
