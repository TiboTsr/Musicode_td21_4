<?php

function getUserCollection($pdo, $userId) {
    $sql = "SELECT m.*, c.note 
            FROM MUSIQUE m
            JOIN COLLECTION c ON m.id = c.musique_id
            WHERE c.utilisateur_id = ?";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$userId]);
    return $stmt->fetchAll();
}

function addToCollection($pdo, $userId, $musicId) {
    $stmt = $pdo->prepare("INSERT INTO COLLECTION (utilisateur_id, musique_id, note) VALUES (?, ?, 0)");
    return $stmt->execute([$userId, $musicId]);
}

function updateCollectionNote($pdo, $userId, $musicId, $note) {
    $stmt = $pdo->prepare("UPDATE COLLECTION SET note = ? WHERE utilisateur_id = ? AND musique_id = ?");
    return $stmt->execute([$note, $userId, $musicId]);
}

function removeFromCollection($pdo, $userId, $musicId) {
    $stmt = $pdo->prepare("DELETE FROM COLLECTION WHERE utilisateur_id = ? AND musique_id = ?");
    return $stmt->execute([$userId, $musicId]);
}