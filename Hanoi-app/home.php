<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: index.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <link rel="stylesheet" href="assets/css/styles.css">
    <title>Menu Principal</title>
</head>
<body>
    <div class="header">
        <h1 style="text-align: center; margin-top: 20px;">Tours de Hanoï</h1>
        <!--<a href="logout.php" style="float: right;margin-right: 20px;">Déconnexion</a>-->
    </div>

    <div class="center-box">
        <h2>Menu Principal</h2>
        <ul>
            <li><a href="play.php">JOUER</a></li>
            <li><a href="rules.php">REGLES</a></li>
            <li><a href="scores.php">MEILLEURS SCORES</a></li>
            <li><a href="logout.php">DECONNEXION</a></li>
        </ul>
    </div>
</body>
</html>
