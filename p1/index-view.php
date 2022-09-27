<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Project One</title>
</head>

<body>
    <h1>Project One</h1>
    <h3>Tic Tac Toe</h3>

    <h2>Mechanics</h2>
    <ul>
        <li>Adding a 3x3 multidimensional array</li>
        <li>All elements of array are empty</li>
        <li>Set 2 computer players</li>
        <li>Distribute cell value X, O to each player</li>
        <li>Each player can guess x, y values between 0, 2</li>
        <li>After a player makes a guess, check if that spot is empty</li>
        <li>If not then make another guess until a proper move has been made</li>
        <li>Loop through the moves until either all places are filled or a winning combination is made</li>
        <li>If win combination found, terminate</li>
    </ul>

    <h2>Results</h2>
    <ul>
        <li>With each move, display the matrix</li>
        <li>If no winning move has been made, declare draw and continue</li>
        <li>If a winning move found, declare the winning side</li>
    </ul>
    <hr>

    <pre>
        -----------------
        Game starts here
        -----------------
        <?php
        foreach ($matrix as $i => $row) {
            echo '|';
            foreach ($row as $j => $cell) {
                if ($cell == '') {
                    echo ' - |';
                } else {
                    echo ' ' . $cell . ' |';
                }
            }
            echo PHP_EOL . "\t";
        }

        $matrix_full = false;
        $winner_move = false;
        while (true) {  # main game loop
            while (true) { # player 1 loop
                $player1XMove = rand(0, 2);
                $player1YMove = rand(0, 2);
                if ($matrix[$player1XMove][$player1YMove] == '') {
                    $matrix[$player1XMove][$player1YMove] = $player1;
                    echo PHP_EOL . 'Player 1 move at ' . $player1XMove . 'x' . $player1YMove . PHP_EOL . "\t";
                    break;
                }
            }

            $cell_empty = 0;
            foreach ($matrix as $i => $row) {
                echo '|';
                foreach ($row as $j => $cell) {
                    if ($cell == '') {
                        echo ' - |';
                        $cell_empty++;
                    } else {
                        echo ' ' . $cell . ' |';
                    }
                }
                echo PHP_EOL . "\t";
            }

            #check if it's a winning move
            if ($cell_empty <= 4) {
                foreach ($matrix as $i => $row) {
                    if ($matrix[$i][0] == 'X' && $matrix[$i][1] == 'X' && $matrix[$i][2] == 'X') {
                        echo '<strong>Player 1 wins</strong>';
                        $winner_move = true;
                        break;
                    }
                    if ($matrix[0][$i] == 'X' && $matrix[1][$i] == 'X' && $matrix[2][$i] == 'X') {
                        echo '<strong>Player 1 wins</strong>';
                        $winner_move = true;
                        break;
                    }
                    if ($matrix[$i][0] == 'O' && $matrix[$i][1] == 'O' && $matrix[$i][2] == 'O') {
                        echo '<strong>Player 2 wins</strong>';
                        $winner_move = true;
                        break;
                    }
                    if ($matrix[0][$i] == 'O' && $matrix[1][$i] == 'O' && $matrix[2][$i] == 'O') {
                        echo '<strong>Player 2 wins</strong>';
                        $winner_move = true;
                        break;
                    }
                }
                if ($matrix[0][0] == 'X' && $matrix[1][1] == 'X' && $matrix[2][2] == 'X') {
                    echo '<strong>Player 1 wins</strong>';
                    $winner_move = true;
                    break;
                }
                if ($matrix[2][0] == 'X' && $matrix[1][1] == 'X' && $matrix[0][2] == 'X') {
                    echo '<strong>Player 1 wins</strong>';
                    $winner_move = true;
                    break;
                }
                if ($matrix[0][0] == 'O' && $matrix[1][1] == 'O' && $matrix[2][2] == 'O') {
                    echo '<strong>Player 2 wins</strong>';
                    $winner_move = true;
                    break;
                }
                if ($matrix[2][0] == 'O' && $matrix[1][1] == 'O' && $matrix[0][2] == 'O') {
                    echo '<strong>Player 2 wins</strong>';
                    $winner_move = true;
                    break;
                }
            }
            if ($winner_move == true) {
                break;
            }
            if ($cell_empty == 0) {
                break;
            }

            while (true) { # player 2 loop
                $player2XMove = rand(0, 2);
                $player2YMove = rand(0, 2);
                if ($matrix[$player2XMove][$player2YMove] == '') {
                    $matrix[$player2XMove][$player2YMove] = $player2;
                    echo PHP_EOL . 'Player 2 move at ' . $player2XMove . 'x' . $player2YMove . PHP_EOL . "\t";
                    break;
                }
            }

            $cell_empty = 0;
            foreach ($matrix as $i => $row) {
                echo '|';
                foreach ($row as $j => $cell) {
                    if ($cell == '') {
                        echo ' - |';
                        $cell_empty++;
                    } else {
                        echo ' ' . $cell . ' |';
                    }
                }
                echo PHP_EOL . "\t";
            }

            #check if it's a winning move
            if ($cell_empty <= 4) {
                foreach ($matrix as $i => $row) {
                    if ($matrix[$i][0] == 'X' && $matrix[$i][1] == 'X' && $matrix[$i][2] == 'X') {
                        echo '<strong>Player 1 wins</strong>';
                        $winner_move = true;
                        break;
                    }
                    if ($matrix[0][$i] == 'X' && $matrix[1][$i] == 'X' && $matrix[2][$i] == 'X') {
                        echo '<strong>Player 1 wins</strong>';
                        $winner_move = true;
                        break;
                    }
                    if ($matrix[$i][0] == 'O' && $matrix[$i][1] == 'O' && $matrix[$i][2] == 'O') {
                        echo '<strong>Player 2 wins</strong>';
                        $winner_move = true;
                        break;
                    }
                    if ($matrix[0][$i] == 'O' && $matrix[1][$i] == 'O' && $matrix[2][$i] == 'O') {
                        echo '<strong>Player 2 wins</strong>';
                        $winner_move = true;
                        break;
                    }
                }
                if ($matrix[0][0] == 'X' && $matrix[1][1] == 'X' && $matrix[2][2] == 'X') {
                    echo '<strong>Player 1 wins</strong>';
                    $winner_move = true;
                    break;
                } else if ($matrix[2][0] == 'X' && $matrix[1][1] == 'X' && $matrix[0][2] == 'X') {
                    echo '<strong>Player 1 wins</strong>';
                    $winner_move = true;
                    break;
                } else if ($matrix[0][0] == 'O' && $matrix[1][1] == 'O' && $matrix[2][2] == 'O') {
                    echo '<strong>Player 2 wins</strong>';
                    $winner_move = true;
                    break;
                } else if ($matrix[2][0] == 'O' && $matrix[1][1] == 'O' && $matrix[0][2] == 'O') {
                    echo '<strong>Player 2 wins</strong>';
                    $winner_move = true;
                    break;
                }
            }
            if ($winner_move == true) {
                break;
            }
            if ($cell_empty == 0) {
                break;
            }
        }
        if ($winner_move == false) {
            echo '<strong>DRAW</strong>';
        }

        ?>
    </pre>
</body>

</html>