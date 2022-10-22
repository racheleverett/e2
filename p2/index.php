<?php
session_start();

require('Game.php');


echo '<pre>';
if (!is_null($_POST['move_x'] ?? null)) {
    $game = new Game('H', $_SESSION['matrix']);

    $response = $game->processHumanMove($_POST['move_x'], $_POST['move_y']);
    if ($response !== true) {
        echo '<span class="error">' . $response . '</span>' . PHP_EOL;
    }
    echo nl2br($game->displayMatrix()) . PHP_EOL;
    echo $game->makeMove();
} else {
    $game = new Game();

    echo 'Computer: ' . $game->computer . ' | You: ' . $game->human . PHP_EOL;
    echo PHP_EOL;
    // echo nl2br($game->displayMatrix()) . PHP_EOL;
    echo $game->makeMove();
    echo nl2br($game->displayMatrix()) . PHP_EOL;
    echo $game->makeMove();
    // echo nl2br($game->displayMatrix()) . PHP_EOL;
    // $game->computerMove();
    // echo nl2br($game->displayMatrix()) . PHP_EOL;
    // $game->computerMove();
    // echo nl2br($game->displayMatrix()) . PHP_EOL;
}
echo '</pre>';
