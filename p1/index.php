<?php
$player1 = 'X';
$player2 = 'O';

$max_attempt = 10;

$results = [];

for ($attempt = 0; $attempt < $max_attempt; $attempt++) {
    #define game matrix
    $matrix = [
        ['', '', ''],
        ['', '', ''],
        ['', '', '']
    ];

    $results[$attempt][] = PHP_EOL . '-----------------' . PHP_EOL . 'Game starts here' . PHP_EOL . '-----------------' . PHP_EOL;

    # display matrix
    foreach ($matrix as $i => $row) {
        $results[$attempt][] = '|';
        foreach ($row as $j => $cell) {
            if ($cell == '') {
                $results[$attempt][] = ' - |';
            } else {
                $results[$attempt][] = ' ' . $cell . ' |';
            }
        }
        $results[$attempt][] = PHP_EOL;
    }

    $matrix_full = false;
    $winner_move = false;
    while (true) {  # main game loop
        while (true) { # player 1 loop
            $player1XMove = rand(0, 2);
            $player1YMove = rand(0, 2);
            if ($matrix[$player1XMove][$player1YMove] == '') {
                $matrix[$player1XMove][$player1YMove] = $player1;
                $results[$attempt][] = PHP_EOL . 'Player 1 move at ' . $player1XMove . 'x' . $player1YMove . PHP_EOL;
                break;
            }
        }

        $cell_empty = 0;
        foreach ($matrix as $i => $row) {
            $results[$attempt][] = '|';
            foreach ($row as $j => $cell) {
                if ($cell == '') {
                    $results[$attempt][] = ' - |';
                    $cell_empty++;
                } else {
                    $results[$attempt][] = ' ' . $cell . ' |';
                }
            }
            $results[$attempt][] = PHP_EOL;
        }

        #check if it's a winning move
        if ($cell_empty <= 4) {
            foreach ($matrix as $i => $row) {
                if ($matrix[$i][0] == 'X' && $matrix[$i][1] == 'X' && $matrix[$i][2] == 'X') {
                    $results[$attempt][] = '<strong>Player 1 wins</strong>';
                    $winner_move = true;
                    break;
                }
                if ($matrix[0][$i] == 'X' && $matrix[1][$i] == 'X' && $matrix[2][$i] == 'X') {
                    $results[$attempt][] = '<strong>Player 1 wins</strong>';
                    $winner_move = true;
                    break;
                }
                if ($matrix[$i][0] == 'O' && $matrix[$i][1] == 'O' && $matrix[$i][2] == 'O') {
                    $results[$attempt][] = '<strong>Player 2 wins</strong>';
                    $winner_move = true;
                    break;
                }
                if ($matrix[0][$i] == 'O' && $matrix[1][$i] == 'O' && $matrix[2][$i] == 'O') {
                    $results[$attempt][] = '<strong>Player 2 wins</strong>';
                    $winner_move = true;
                    break;
                }
            }
            if ($matrix[0][0] == 'X' && $matrix[1][1] == 'X' && $matrix[2][2] == 'X') {
                $results[$attempt][] = '<strong>Player 1 wins</strong>';
                $winner_move = true;
                break;
            }
            if ($matrix[2][0] == 'X' && $matrix[1][1] == 'X' && $matrix[0][2] == 'X') {
                $results[$attempt][] = '<strong>Player 1 wins</strong>';
                $winner_move = true;
                break;
            }
            if ($matrix[0][0] == 'O' && $matrix[1][1] == 'O' && $matrix[2][2] == 'O') {
                $results[$attempt][] = '<strong>Player 2 wins</strong>';
                $winner_move = true;
                break;
            }
            if ($matrix[2][0] == 'O' && $matrix[1][1] == 'O' && $matrix[0][2] == 'O') {
                $results[$attempt][] = '<strong>Player 2 wins</strong>';
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
                $results[$attempt][] = PHP_EOL . 'Player 2 move at ' . $player2XMove . 'x' . $player2YMove . PHP_EOL;
                break;
            }
        }

        $cell_empty = 0;
        foreach ($matrix as $i => $row) {
            $results[$attempt][] = '|';
            foreach ($row as $j => $cell) {
                if ($cell == '') {
                    $results[$attempt][] = ' - |';
                    $cell_empty++;
                } else {
                    $results[$attempt][] = ' ' . $cell . ' |';
                }
            }
            $results[$attempt][] = PHP_EOL;
        }

        #check if it's a winning move
        if ($cell_empty <= 4) {
            foreach ($matrix as $i => $row) {
                if ($matrix[$i][0] == 'X' && $matrix[$i][1] == 'X' && $matrix[$i][2] == 'X') {
                    $results[$attempt][] = '<strong>Player 1 wins</strong>';
                    $winner_move = true;
                    break;
                }
                if ($matrix[0][$i] == 'X' && $matrix[1][$i] == 'X' && $matrix[2][$i] == 'X') {
                    $results[$attempt][] = '<strong>Player 1 wins</strong>';
                    $winner_move = true;
                    break;
                }
                if ($matrix[$i][0] == 'O' && $matrix[$i][1] == 'O' && $matrix[$i][2] == 'O') {
                    $results[$attempt][] = '<strong>Player 2 wins</strong>';
                    $winner_move = true;
                    break;
                }
                if ($matrix[0][$i] == 'O' && $matrix[1][$i] == 'O' && $matrix[2][$i] == 'O') {
                    $results[$attempt][] = '<strong>Player 2 wins</strong>';
                    $winner_move = true;
                    break;
                }
            }
            if ($matrix[0][0] == 'X' && $matrix[1][1] == 'X' && $matrix[2][2] == 'X') {
                $results[$attempt][] = '<strong>Player 1 wins</strong>';
                $winner_move = true;
                break;
            } else if ($matrix[2][0] == 'X' && $matrix[1][1] == 'X' && $matrix[0][2] == 'X') {
                $results[$attempt][] = '<strong>Player 1 wins</strong>';
                $winner_move = true;
                break;
            } else if ($matrix[0][0] == 'O' && $matrix[1][1] == 'O' && $matrix[2][2] == 'O') {
                $results[$attempt][] = '<strong>Player 2 wins</strong>';
                $winner_move = true;
                break;
            } else if ($matrix[2][0] == 'O' && $matrix[1][1] == 'O' && $matrix[0][2] == 'O') {
                $results[$attempt][] = '<strong>Player 2 wins</strong>';
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
        $results[$attempt][] = '<strong>DRAW</strong>';
    }
    $results[$attempt][] = PHP_EOL . '-----------------' . PHP_EOL;
}


require('index-view.php');
