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
        $this->turn = 'C';
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
                break;
            }
        }
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
$game->computerMove();
echo nl2br($game->displayMatrix()) . PHP_EOL;
$game->computerMove();
echo nl2br($game->displayMatrix()) . PHP_EOL;
$game->computerMove();
echo nl2br($game->displayMatrix()) . PHP_EOL;

echo '</pre>';
