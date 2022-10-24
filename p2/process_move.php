<?php
session_start();

require('Game.php');

if (!is_null($_POST['move_x'] ?? null)) {
    $game = new Game('H', $_SESSION['matrix']);

    $response = $game->processHumanMove($_POST['move_x'], $_POST['move_y']);
    if ($response !== true) {   // wrong move
        $_SESSION['error'] = $response;
    } else {
        $game->turn = 'C';
        $_SESSION['turn'] = 'C';
    }
}
header('Location: .');
