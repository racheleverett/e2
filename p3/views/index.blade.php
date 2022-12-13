@extends('templates/master')

@section('content')
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
    <hr>

    <h2 class="text-center">Game Play</h2>
    <div class="text-center">Computer move:
        <span test="c-move">{{ $computer_move }}</span>
    </div>
    <table class="m-auto">
        @foreach ($matrix as $i => $row)
            <tr>
                @foreach ($row as $j => $cell)
                    @if ($cell == '')
                        <td>&nbsp;-&nbsp;</td>
                    @else
                        <td test="{{ $cell == 'X' ? 'computer' : 'human' }}-move">&nbsp;{{ $cell }}&nbsp;</td>
                    @endif
                @endforeach
            </tr>
        @endforeach
    </table>

    <h4 class="text-center">Make your move</h4>
    @if ($app->errorsExist())
        @foreach ($app->errors() as $error)
            <div class="alert error">
                <input type="checkbox" id="alert1" />
                <label class="close" title="close" for="alert1">
                    <i class="icon-remove"></i>
                </label>
                <p class="inner text-center">
                    <strong>Error!</strong> {{ $error }}
                </p>
            </div>
        @endforeach
    @endif

    @if ($human_move_error)
        <div class="alert warning">
            <input type="checkbox" id="alert4" />
            <label class="close" title="close" for="alert4">
                <i class="icon-remove"></i>
            </label>
            <p class="inner text-center">
                <strong>Warning!</strong> {{ $human_move_error }}
            </p>
        </div>
    @endif

    @if ($matrix_full || $empty_cells <= 1)
        <div class="alert info">
            <input type="checkbox" id="alert3" />
            <label class="close" title="close" for="alert3">
                <i class="icon-remove"></i>
            </label>
            <p class="inner text-center">
                Game draw. Click <a href="/resetGame">here</a> to restart.
            </p>
        </div>
    @else
        @if ($winner_move)
            <div class="alert success">
                <input type="checkbox" id="alert2" />
                <label class="close" title="close" for="alert2">
                    <i class="icon-remove"></i>
                </label>
                <p class="inner text-center">
                    {{ $winner == 'X' ? 'Computer' : 'You' }} won this round. Click <a href="/resetGame">here</a> to
                    restart.
                </p>
            </div>
        @else
            <form mathod="post" action='/process' class="text-center">
                <label for="move_x">X:</label><input type="number" name="move_x" id="move_x" min="0"
                    max="2" step="1" autofocus required>
                <label for="move_y">Y:</label><input type="number" name="move_y" id="move_y" min="0"
                    max="2" step="1" autofocus required>
                <p></p>
                <button class="btn" id="btn_submit" type="submit">Submit</button>
            </form>
        @endif
    @endif

    <div class="card text-center">
        <a href="/history">View <strong>Previous rounds</strong></a> | <a href="/resetGame">Reset game</a>
    </div>
@endsection
