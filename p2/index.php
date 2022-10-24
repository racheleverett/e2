<?php
session_start();
// session_destroy();
require('Game.php');
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Project Two</title>
</head>

<body>
    <h1>Tic Tac Toe Game Simulator</h1>

    <h2>Mechanics</h2>
    <ol>
        <li>Defining Game class</li>
        <li>Initiating Game object</li>
        <li>Passing current status of matrix and player who's turn it is</li>
        <li>Make a move</li>
        <li>Computer will make a guess and submit</li>
        <li>Game will ask user to make their move and wait for it</li>
        <li>Once user makes it's move, validate and submit</li>
        <li>If winning move then declare winner and terminate</li>
        <li>If not, check if matrix is full then announce draw and terminate</li>
        <li>Otherwise go to to step 4</li>
    </ol>

    <h2>Instructions</h2>
    <ul>
        <li>Player 1: Computer (X)</li>
        <li>Player 2: User - [You] (O)</li>
        <li>Player 1 will make the first move</li>
        <li>Possible X/Y values are
            <ul>
                <li>0 - first row/column</li>
                <li>1 - second row/column</li>
                <li>2 - third row/column</li>
            </ul>
        </li>
        <li>Both X/Y input fields are required</li>
    </ul>

    <h2>Game Play</h2>
    <?php
    # game loop
    echo '<pre>';
    $turn = $_SESSION['turn'] ?? 'C';
    $current_matrix = $_SESSION['matrix'] ?? null;

    $game = new Game($turn, $current_matrix);

    // print_r([$turn, $current_matrix, $game->matrix]);

    echo PHP_EOL;

    # game loop
    while (true) {
        # check if a winning move exists
        $game->isWinningMove();
        if ($game->winner_move) {
            echo ($game->winner == 'X' ? 'Computer' : 'You') . ' won this round.' . PHP_EOL;
            echo 'click <a href=".">here</a> to restart.';
            session_destroy();
            break;
        }

        # check if matix is full
        if ($game->isMatrixFull()) {
            echo 'Game draw.' . PHP_EOL;
            echo 'click <a href=".">here</a> to restart.';
            session_destroy();
            break;
        }

        echo '> Turn: ' . $game->turn . PHP_EOL;
        if (isset($_SESSION['error'])) {
            echo '<span class="error">' . $_SESSION['error'] . '</span>' . PHP_EOL;
            echo nl2br($game->displayMatrix()) . PHP_EOL;
            unset($_SESSION['error']);
        }
        echo $game->makeMove();
    }

    echo '</pre>';
    ?>
</body>

</html>