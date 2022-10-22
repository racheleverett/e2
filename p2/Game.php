<?php
class Game
{
    public $computer = 'X';
    public $human = 'O';

    public $matrix = [
        ['', '', ''],
        ['', '', ''],
        ['', '', '']
    ];

    public $turn = false;
    public $matrix_full = false;
    public $winner_move = false;

    public $moves = null;

    public function __construct($turn = '', $matrix = null)
    {
        $this->turn = $turn ? $turn : 'C'; // first move
        $this->matrix = $matrix ?? $this->matrix;
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

    public function makeMove()
    {
        if ($this->turn == 'C') {
            $this->computerMove();
            return 'Player: Computer' . PHP_EOL;
        } else {
            $html = $this->humanMove();
            return $html;
        }
    }

    public function computerMove()
    {
        while (true) {
            $moveX = rand(0, 2);
            $moveY = rand(0, 2);

            if ($this->isCellEmpty($moveX, $moveY)) {
                $this->matrix[$moveX][$moveY] = $this->computer;

                $this->moves[$this->turn][] = [$moveX, $moveY];

                $_SESSION['matrix'] = $this->matrix;
                $_SESSION['game_moves'] = $this->moves;

                $this->turn = 'H';
                break;
            }
        }
    }

    public function humanMove()
    {
        $html = '<form method="POST" action="">
            <h3>Make your move</h3>

            <label for="move_x">X:</label>
            <input type="number" name="move_x" id="move_x" min="0" max="2" step="1">

            <label for="move_y">Y:</label>
            <input type="number" name="move_y" id="move_y" min="0" max="2" step="1">

            <button type="submit">Submit</button>
        </form>';
        return $html;
    }

    public function processHumanMove($x, $y)
    {
        if ($this->isCellEmpty($x, $y)) {
            $this->matrix[$x][$y] = $this->human;

            $this->moves[$this->turn][] = [$x, $y];

            $_SESSION['matrix'] = $this->matrix;
            $_SESSION['game_moves'] = $this->moves;

            $this->turn = 'C';
            return true;
        }
        return 'This cell is taken, please try again.';
    }

    public function isCellEmpty($x, $y)
    {
        return $this->matrix[$x][$y] == '';
    }
}
