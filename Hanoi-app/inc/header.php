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
    <title>Application des Tours de Hanoï</title>
</head>
<body>
    <div class="header">
        <h1>Bienvenue, <?php echo htmlspecialchars($_SESSION['username']); ?>!</h1>
        <a href="logout.php">Déconnexion</a>
    </div>
</body>
</html>
