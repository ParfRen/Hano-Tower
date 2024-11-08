document.addEventListener("DOMContentLoaded", () => {
    let moveCount = 0;
    let scoreBox = document.getElementById("score");
    let isPaused =  false;
    //let startTime, timer;  

    const modal = document.getElementById("modal")
    const modalMessage = document.getElementById("modal-message");

    // Variables de jeu
    const poles = [[], [], []];
    const numDiscs = 4;
    let selectedDisc = null;

    // Initia liser les disques sur le premier bâton
    function initGame() {
        moveCount = 0;
        isPaused = false;
        scoreBox.innerText = moveCount;
        const pole1 = document.getElementById("pole-1");
        pole1.innerHTML = "";
        poles[0] = [];
        poles[1] = [];
        poles[2] = [];

        for (let i = numDiscs; i > 0; i--) {
            const disc = document.createElement("div");
            disc.classList.add("disc");
            disc.style.width = `${i * 30}px`;
            
            disc.style.position = "absolute"; // Positionnement absolu pour les empiler
            disc.style.bottom = `${(numDiscs - i) * 20}px`; // Ajuste la position verticale
            
            disc.dataset.size = i;
            disc.innerText = i;
            pole1.appendChild(disc);
            poles[0].push(disc);
        }
    }

     function showModal(message, redirect = false) {
        modalMessage.innerText = message;
        modal.classList.remove("hidden");

        document.getElementById("modal-confirm").onclick = function() {
            modal.classList.add("hidden");
            if (redirect) {
                window.location.href = "home.php";
            }
        };
    }

    function pauseGame() {
        //clearInterval(timer);
        isPaused = !isPaused;
        if (isPaused){
            showModal("Le jeu est en pause.");
        } else {
            modal.classList.add("hidden");
        }
    }


    function restartGame() {
        //clearInterval(timer);
        //startTimer();
        initGame();
        showModal("Le jeu a été redémarré.");
    }

    function quitGame() {
        //clearInterval(timer);
        //window.location.href = "home.php";
        showModal("Quitter le jeu ?", true);
    }

    function gameWon() {
        showModal("Réussi ! Déplacements : " + moveCount);

        // Envoyer le score au serveur via fetch
        fetch("save_score.php", {
            method: "POST",
            headers: {
                "Content-Type": "application/json"
            },
            body: JSON.stringify({ score: moveCount })
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                console.log("Score sauvegardé avec succès !");
            } else {
                console.error("Erreur lors de la sauvegarde du score");
            }
        })
        .catch(error => console.error("Erreur réseau :", error));
    }

    /*function startTimer() {
        startTime = new Date();
        timer = setInterval(() => {
            const elapsedTime = new Date() - startTime;
            scoreBox.innerText = (elapsedTime / 1000).toFixed(2) + " sec";
        }, 100);
    }*/

    //Sélection et déplacement des disques
    document.querySelectorAll(".pole").forEach((pole, index) => {
        pole.addEventListener("click", () => {
             if (isPaused) return;

            if (selectedDisc) {
                const lastDiscOnPole = poles[index][poles[index].length - 1];
                if (!lastDiscOnPole || lastDiscOnPole.dataset.size > selectedDisc.dataset.size) {
                    poles[index].push(selectedDisc);
                    selectedDisc.style.bottom = `${poles[index].length * 20}px`;
                    pole.appendChild(selectedDisc);
                    selectedDisc = null;

                    // Augmenter le compteur de mouvements
                    moveCount++;
                    scoreBox.innerText = moveCount;

                    // Vérifier si le jeu est gagné
                    if (poles[2].length === numDiscs) {
                        gameWon();
                        // clearInterval(timer);
                        // alert("Réussi ! Score: " + scoreBox.innerText);
                    }
                }
            } else {
                selectedDisc = poles[index].pop();
            }
        });
    });

    //Initialisation du jeu au chargement
    initGame();
    //startTimer();

    //Assignation des fonctions de contrôle de jeu aux boutons
    window.pauseGame = pauseGame;
    window.restartGame = restartGame;
    window.quitGame = quitGame;
});
