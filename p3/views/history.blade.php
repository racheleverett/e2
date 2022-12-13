@extends('templates/master')

@section('title')
    Round History
@endsection

@section('content')
    <h2 class="text-center">Game History</h2>
    <p class="text-center">
        <span>The game has been played <strong>{{ $stats['total'] }} times</strong></span><br>
        <span>There has been <strong>{{ $stats['H'] }} wins, {{ $stats['C'] }} losses</strong> and
            <strong>{{ $stats['D'] }}
                draws</strong></span>
    </p>
    <br>

    <h2 class="text-center">Round History</h2>
    <ul class="text-center">
        @foreach ($rounds as $round)
            <li class="text-{{ $round['winner'] == 'D' ? 'blue' : ($round['winner'] == 'H' ? 'green' : 'red') }}">
                {{ $round['winner'] == 'D' ? 'Game Draw' : 'Winner: ' . ($round['winner'] == 'H' ? 'You' : 'Computer') }} <a
                    class="round-link" href="/round?id={{ $round['id'] }}">{{ $round['timestamp'] }}</a>
            </li>
        @endforeach
    </ul>

    <div class="card text-center">
        <a href="/">Home</a>
    </div>
@endsection
