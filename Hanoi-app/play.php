<!DOCTYPE html>
<html lang="fr">
<head>
    <link rel="stylesheet" href="assets/css/styles.css">
    <script src="assets/js/game.js" defer></script>
    <title>Jeu des Tours de Hanoï</title>
</head>
<body>

    <div class="header">
        <h1 style="text-align: center; margin-top: 20px;">Tours de Hanoï</h1>
        <!--<a href="logout.php" style="float: right;margin-right: 20px;">Déconnexion</a>-->
    </div>

    <div class="center-box-play">
        <div class="game-controls">
            <button onclick="pauseGame()">Pause</button>
            <button onclick="restartGame()">Recommencer</button>
            <button onclick="quitGame()">Quitter</button>
        </div>

        <div id="game-container">
            <!-- Bâtons du jeu -->
            <div class="pole" id="pole-1"></div>
            <div class="pole" id="pole-2"></div>
            <div class="pole" id="pole-3"></div>
        </div>
        <div id="score-box">Déplacements : <span id="score">0</span></div>
    </div>

    <div id="modal" class="modal hidden">
    <div class="modal-content">
        <p id="modal-message"></p>
        <button id="modal-confirm">OK</button>
    </div>
</div>

</body>
</html>
