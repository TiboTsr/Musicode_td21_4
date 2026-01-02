<?php
session_start();
require_once __DIR__ . '/../db_connect.php';
require_once __DIR__ . '/../Models/MusicModel.php';
require_once __DIR__ . '/../Models/CollectionModel.php';

$message = "";
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['add_music_id'])) {
    if (isset($_SESSION['user_id'])) {
        try {
            addToCollection($pdo, $_SESSION['user_id'], $_POST['add_music_id']);
            $message = "Musique ajoutée !";
        } catch (Exception $e) { $message = "Déjà dans votre bibliothèque."; }
    }
}

$musiques = getAllMusics($pdo);
include __DIR__ . '/../Views/musics.php';