<?php
session_start();
if (isset($_SESSION['user_id'])) {
    header("Location: home.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <link rel="stylesheet" href="assets/css/styles.css">
    <title>Connexion</title>
</head>
<body>
    <div class="header">
        <h1 style="text-align: center; margin-top: 20px;">Tours de Hanoï</h1>
        <!--<a href="logout.php" style="float: right;margin-right: 20px;">Déconnexion</a>-->
    </div>

    <div class="center-box">
        <h2>Connexion</h2>
        <form action="login_handler.php" method="POST">
            <input type="text" name="username" placeholder="Nom d'utilisateur" required>
            <input type="password" name="password" placeholder="Mot de passe" required>
            <button type="submit">Se connecter</button>
        </form>
        <a href="register.php" class="button">S'inscrire</a>
    </div>
</body>
</html>
