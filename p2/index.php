<?php
class Game
{
    public $computer = 'X';
    public $human = 'O';

    public $matrix  = [
        ['', '', ''],
        ['', '', ''],
        ['', '', '']
    ];

    public $turn = false;
    public $matrix_full = false;
    public $winner_move = false;

    public $moves = null;

    public function __construct()
    {
        session_start();

        $this->turn = 'C';  // first move
    }

    public function displayMatrix()
    {
        foreach ($this->matrix as $i => $row) {
            $result[] = '|';
            foreach ($row as $j => $cell) {
                if ($cell == '') {
                    $result[] = ' - |';
                } else {
                    $result[] = ' ' . $cell . ' |';
                }
            }
            $result[] = PHP_EOL;
        }
        return implode('', $result);
    }

    public function computerMove()
    {
        while (true) {
            $moveX = rand(0, 2);
            $moveY = rand(0, 2);

            if ($this->isCellEmpty($moveX, $moveY)) {
                $this->matrix[$moveX][$moveY] = $this->computer;

                $this->moves['C'][] = [$moveX, $moveY];

                $_SESSION['matrix'] = $this->matrix;
                $_SESSION['game_moves'] = $this->moves;
                break;
            }
        }
    }

    public function humanMove()
    {
        $html = '<form method="POST" action="process_move.php">
            <h1>Make your move</h1>

            <label for="move_x">X:</label>
            <input type="number" name="move_x" id="move_x" min="0" max="2" step="1">

            <label for="move_y">Y:</label>
            <input type="number" name="move_y" id="move_y" min="0" max="2" step="1">
        
            <button type="submit">Submit</button>
        </form>';
        echo $html;
    }

    public function isCellEmpty($x, $y)
    {
        return $this->matrix[$x][$y] == '';
    }
}

$game = new Game();

echo '<pre>';
echo $game->computer . PHP_EOL;
echo $game->human . PHP_EOL;
echo nl2br($game->displayMatrix()) . PHP_EOL;
$game->computerMove();
echo nl2br($game->displayMatrix()) . PHP_EOL;
$game->humanMove();
// echo nl2br($game->displayMatrix()) . PHP_EOL;
// $game->computerMove();
// echo nl2br($game->displayMatrix()) . PHP_EOL;
// $game->computerMove();
// echo nl2br($game->displayMatrix()) . PHP_EOL;

echo '</pre>';
