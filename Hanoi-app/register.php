<?php
require 'db/db_connection.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    $query = $pdo->prepare("INSERT INTO users (username, password) VALUES (:username, :password)");
    $query->bindParam(":username", $username);
    $query->bindParam(":password", $hashed_password);

    try {
        $query->execute();
        echo "Inscription réussie. <a href='index.php'>Connectez-vous ici.</a>";
    } catch (PDOException $e) {
        echo "Erreur lors de l'inscription : " . $e->getMessage();
    }
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <link rel="stylesheet" href="assets/css/styles.css">
    <title>Inscription</title>
</head>
<body>
    <div class="header">
        <h1 style="text-align: center; margin-top: 20px;">Tours de Hanoï</h1>
        <!--<a href="logout.php" style="float: right;margin-right: 20px;">Déconnexion</a>-->
    </div>

    <div class="center-box">
        <h2>Inscription</h2>
        <form action="register.php" method="POST">
            <input type="text" name="username" placeholder="Nom d'utilisateur" required>
            <input type="password" name="password" placeholder="Mot de passe" required>
            <button type="submit">S'inscrire</button>
        </form>
        <a href="index.php" class="button">Se connecter</a>
    </div>
</body>
</html>
