<?php

function getAllMusics($pdo) {
    $stmt = $pdo->query("SELECT * FROM MUSIQUE");
    return $stmt->fetchAll();
}

function getMusicById($pdo, $id) {
    $stmt = $pdo->prepare("SELECT * FROM musique WHERE id = :id");
    $stmt->execute(['id' => $id]);
    return $stmt->fetch();
}

function addMusic($pdo, $titre, $auteur, $album, $duree) {
    $sql = "INSERT INTO musique (titre, auteur, album, duree) VALUES (?, ?, ?, ?)";
    $stmt = $pdo->prepare($sql);
    return $stmt->execute([$titre, $auteur, $album, $duree]);
}