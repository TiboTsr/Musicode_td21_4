<?php

function getUserByEmail($pdo, $email) {
    $stmt = $pdo->prepare("SELECT * FROM UTILISATEUR WHERE email = ?");
    $stmt->execute([$email]);
    return $stmt->fetch();
}

function getUserById($pdo, $id) {
    $stmt = $pdo->prepare("SELECT * FROM UTILISATEUR WHERE id = ?");
    $stmt->execute([$id]);
    return $stmt->fetch();
}

function createUser($pdo, $username, $email, $hash) {
    $sql = "INSERT INTO UTILISATEUR (nom_affichage, email, motdepasse) VALUES (?, ?, ?)";
    $stmt = $pdo->prepare($sql);
    return $stmt->execute([$username, $email, $hash]);
}

function updateUser($pdo, $id, $username, $passwordHash = null) {
    if ($passwordHash) {
        $stmt = $pdo->prepare("UPDATE UTILISATEUR SET nom_affichage = ?, motdepasse = ? WHERE id = ?");
        return $stmt->execute([$username, $passwordHash, $id]);
    } else {
        $stmt = $pdo->prepare("UPDATE UTILISATEUR SET nom_affichage = ? WHERE id = ?");
        return $stmt->execute([$username, $id]);
    }
}