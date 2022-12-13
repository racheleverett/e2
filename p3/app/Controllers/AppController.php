<?php

namespace App\Controllers;

class AppController extends Controller
{
    public $matrix = [
        ['', '', ''],
        ['', '', ''],
        ['', '', '']
    ];
    public $computer = 'X';
    public $human = 'O';

    public $turn = 'C';
    public $empty_cells = 0;
    public $matrix_full = false;

    public $winner_move = false;
    public $winner = '';

    public $moves = null;

    public function __construct($app)
    {
        parent::__construct($app);
        $this->matrix = $_SESSION['matrix'] ?? $this->matrix;
        $this->moves = $_SESSION['game_moves'] ?? $this->moves;
        $this->turn = $_SESSION['turn'] ?? $this->turn;
    }

    public function index()
    {
        // dump($_SESSION);
        // dump($this->matrix);

        $this->matrix_full = $this->isMatrixFull();
        if ($this->empty_cells > 0 && !$this->winner_move) {
            if ($this->turn == 'C') {
                $this->computerMove();
            }
        }
        $computer_move = implode('-', $this->moves['C'][count($this->moves['C']) - 1]);

        $turn = $_SESSION['turn'] ?? $this->turn;
        // dump($turn);

        $matrix = $_SESSION['matrix'] ?? $this->matrix;
        $this->isWinningMove();
        // dd($matrix);

        $this->moves = $_SESSION['game_moves'] ?? $this->moves;
        // dump($this->moves);

        # if game draw or a winner save results
        if ($this->matrix_full || $this->empty_cells <= 1 || $this->winner_move) {
            $winner = ($this->matrix_full || $this->empty_cells <= 1) ? 'D' : ($this->winner == 'O' ? 'H' : 'C');
            $this->app->db()->insert('rounds', [
                'choices'   => json_encode($this->moves),
                'winner'    => $winner,
                'timestamp' => date('Y-m-d H:i:s')
            ]);
        }

        $human_move_error = $this->app->old('human_move_error');

        return $this->app->view('index', [
            'turn' => $this->turn,
            'matrix' => $matrix,
            'computer_move' => $computer_move,
            'empty_cells' => $this->empty_cells,
            'matrix_full' => $this->matrix_full,
            'winner_move' => $this->winner_move,
            'winner' => $this->winner,
            'human_move_error' => $human_move_error
        ]);
    }

    public function history()
    {
        session_destroy();
        $rounds = $this->app->db()->all('rounds');
        $draw = $this->app->db()->findByColumn('rounds', 'winner', '=', 'D'); # draw
        $winner_c = $this->app->db()->findByColumn('rounds', 'winner', '=', 'C'); # computer
        $winner_h = $this->app->db()->findByColumn('rounds', 'winner', '=', 'H'); # human

        return $this->app->view('history', [
            'rounds'    => $rounds,
            'stats'     => [
                'D'     => count($draw),
                'C'     => count($winner_c),
                'H'     => count($winner_h),
                'total' => count($rounds)
            ]
        ]);
    }

    public function round()
    {
        $id = $this->app->param('id');
        $round = $this->app->db()->findById('rounds', $id);

        return $this->app->view('round', ['round' => $round, 'matrix' => $this->matrix]);
    }

    public function reset()
    {
        session_destroy();
        return $this->app->redirect('/');
    }

    public function process()
    {
        // dump($this->app->inputAll());
        $this->app->validate([
            'move_x' => 'required|numeric|min:0|max:2',
            'move_y' => 'required|numeric|min:0|max:2',
        ]);

        $response = ['status' => false];
        $matrix = $_SESSION['matrix'];

        $x = $this->app->input('move_x');
        $y = $this->app->input('move_y');

        if ($this->isCellEmpty($x, $y)) {
            $matrix[$x][$y] = $this->human;
            $this->isWinningMove();

            $this->moves[$this->turn][] = [$x, $y];

            $_SESSION['matrix'] = $matrix;
            // dd($_SESSION);
            $_SESSION['game_moves'] = $this->moves;

            $_SESSION['turn'] = 'C';
            $response['status'] = true;
        } else {
            $response['human_move_error'] = 'This cell is taken, please try again.';
        }
        return $this->app->redirect('/', $response);
    }

    private function computerMove()
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
            $this->matrix_full = $this->isMatrixFull();
        }

        $this->turn = 'H';
        $_SESSION['turn'] = 'H';
    }

    private function isCellEmpty($x, $y)
    {
        return $this->matrix[$x][$y] == '';
    }

    private function countEmptyCells()
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

    private function isMatrixFull()
    {
        $this->countEmptyCells();
        return $this->empty_cells == 0;
    }

    private function isWinningMove()
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
