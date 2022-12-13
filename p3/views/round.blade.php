@extends('templates/master')

@section('title')
    Round Details
@endsection

@section('content')
    <div class="card text-center">
        <a href="/">Home</a> | <a href="/history">History</a>
    </div>

    <h2 class="text-center">Round Details</h2>
    <ul class="text-center">
        <li>Round id: {{ $round['id'] }}</li>
        <li class="text-{{ $round['winner'] == 'D' ? 'blue' : ($round['winner'] == 'H' ? 'green' : 'red') }}">Result:
            <strong>{{ $round['winner'] == 'D' ? 'Game Draw' : 'Winner: ' . ($round['winner'] == 'H' ? 'You' : 'Computer') }}</strong>
        </li>
        <li>Timestamp: {{ $round['timestamp'] }}</li>
    </ul>
    <hr>

    <h2 class="text-center">Game Play</h2>
    <?php
    $choices = json_decode($round['choices'], true);
    ?>
    <table class="m-auto">
        @if (!count($choices))
            <div class="alert info">
                <input type="checkbox" id="alert2" />
                <label class="close" title="close" for="alert2">
                    <i class="icon-remove"></i>
                </label>
                <p class="inner text-center">
                    Seed Game. No choices available
                </p>
            </div>
        @endif

        @foreach ($choices as $player => $moves)
            @foreach ($moves as $move)
                <?php
                $matrix[$move[0]][$move[1]] = $player == 'H' ? 'O' : 'X';
                ?>
            @endforeach
        @endforeach

        @foreach ($matrix as $i => $row)
            <tr>
                @foreach ($row as $j => $cell)
                    @if ($cell == '')
                        <td>&nbsp;-&nbsp;</td>
                    @else
                        <td>&nbsp;{{ $cell }}&nbsp;</td>
                    @endif
                @endforeach
            </tr>
        @endforeach
    </table>

    <div class="card text-center">
        <a href="/">Home</a> | <a href="/history">History</a>
    </div>
@endsection
