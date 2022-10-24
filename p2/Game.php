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
    public $empty_cells = 0;
    public $matrix_full = false;

    public $winner_move = false;
    public $winner = '';

    public $moves = null;

    public function __construct($turn = '', $matrix = null)
    {
        $this->turn = $turn ? $turn : 'C'; // first move
        $this->matrix = $matrix ?? $this->matrix;
        $_SESSION['matrix'] = $this->matrix;
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
            echo '┌────────────────────┐' . PHP_EOL;
            echo '│  Player: Computer  │' . PHP_EOL;
            echo '└────────────────────┘' . PHP_EOL;
            $this->computerMove();
            return;
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

                break;
            }
        }
        echo nl2br($this->displayMatrix()) . PHP_EOL;

        $this->turn = 'H';
        $_SESSION['turn'] = 'H';
    }

    public function humanMove()
    {
        $html = '<form method="POST" action="process_move.php">
            <strong>Make your move</strong>

            <label for="move_x">X:</label>
            <input type="number" name="move_x" id="move_x" min="0" max="2" step="1" autofocus required>

            <label for="move_y">Y:</label>
            <input type="number" name="move_y" id="move_y" min="0" max="2" step="1" required>

            <button type="submit">Submit</button>
        </form>';
        echo $html;
        exit;
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

    public function countEmptyCells()
    {
        $this->empty_cells = 0;
        foreach ($this->matrix as $i => $row) {
            foreach ($row as $j => $cell) {
                if ($cell == '') {
                    $this->empty_cells++;
                }
            }
        }
    }

    public function isMatrixFull()
    {
        $this->countEmptyCells();
        // print_r('>> ' . $this->empty_cells);
        return $this->empty_cells == 0;
    }

    public function isWinningMove()
    {
        $this->countEmptyCells();

        #check if it's a winning move
        if ($this->empty_cells <= 4) {
            foreach ($this->matrix as $i => $row) {
                if ($this->matrix[$i][0] == $this->computer && $this->matrix[$i][1] == $this->computer && $this->matrix[$i][2] == $this->computer) {
                    $this->winner_move = true;
                    $this->winner = $this->computer;
                    return;
                }
                if ($this->matrix[0][$i] == $this->computer && $this->matrix[1][$i] == $this->computer && $this->matrix[2][$i] == $this->computer) {
                    $this->winner_move = true;
                    $this->winner = $this->computer;
                    return;
                }
                if ($this->matrix[$i][0] == $this->human && $this->matrix[$i][1] == $this->human && $this->matrix[$i][2] == $this->human) {
                    $this->winner_move = true;
                    $this->winner = $this->human;
                    return;
                }
                if ($this->matrix[0][$i] == $this->human && $this->matrix[1][$i] == $this->human && $this->matrix[2][$i] == $this->human) {
                    $this->winner_move = true;
                    $this->winner = $this->human;
                    return;
                }
            }
            if ($this->matrix[0][0] == $this->computer && $this->matrix[1][1] == $this->computer && $this->matrix[2][2] == $this->computer) {
                $this->winner_move = true;
                $this->winner = $this->computer;
                return;
            }
            if ($this->matrix[2][0] == $this->computer && $this->matrix[1][1] == $this->computer && $this->matrix[0][2] == $this->computer) {
                $this->winner_move = true;
                $this->winner = $this->computer;
                return;
            }
            if ($this->matrix[0][0] == $this->human && $this->matrix[1][1] == $this->human && $this->matrix[2][2] == $this->human) {
                $this->winner_move = true;
                $this->winner = $this->human;
                return;
            }
            if ($this->matrix[2][0] == $this->human && $this->matrix[1][1] == $this->human && $this->matrix[0][2] == $this->human) {
                $this->winner_move = true;
                $this->winner = $this->human;
                return;
            }
        }
    }
}
