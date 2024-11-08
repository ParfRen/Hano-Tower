<?php
session_start();
require_once 'db/db_connection.php';

if (!isset($_SESSION['user_id'])) {
    echo json_encode(['success' => false, 'message' => 'Utilisateur non connecté']);
    exit;
}

$data = json_decode(file_get_contents('php://input'), true);
$score = $data['score'];
$user_id = $_SESSION['user_id'];

try {
    // Enregistrer le score si c'est le meilleur score de l'utilisateur
    $stmt = $pdo->prepare("SELECT MIN(score) AS best_score FROM scores WHERE user_id = :user_id");
    $stmt->execute(['user_id' => $user_id]);
    $bestScore = $stmt->fetchColumn();

    if ($bestScore === null || $score < $bestScore) {
        $stmt = $pdo->prepare("INSERT INTO scores (user_id, score) VALUES (:user_id, :score)");
        $stmt->execute(['user_id' => $user_id, 'score' => $score]);
    }

    echo json_encode(['success' => true]);
} catch (Exception $e) {
    echo json_encode(['success' => false, 'message' => $e->getMessage()]);
}
?>
