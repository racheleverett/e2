<?php

$moves = ['rock', 'paper', 'scissors'];


$randomNumber = rand(0, 2);

$move = $moves[$randomNumber];

// var_dump($move);



# Associative array

$coin_values = [
    'penny' => .01,
    'nickel' => .05,
    'dime' => .10,
    'quarter' => .25
];

// var_dump($coin_values['quarter']);

$coin_counts = [
    'penny' => 100,
    'nickel' => 25,
    'dime' => 100,
    'quarter' => 34
];

// var_dump($coin_counts['quarter']);

// asort($coin_counts);

// arsort($coin_counts);

// var_dump($coin_counts);

// ksort($coin_counts);

// krsort($coin_counts);

// var_dump($coin_counts);

// $cards = [1, 2, 3, 4, 5, 6, 7, 8, 9];

// shuffle($cards);

// var_dump($cards);


$total = 0;
// foreach ($coin_counts as $coin => $count) {
//     $total = $total + ($count * $coin_values[$coin]);
// }

$coins = [
    'penny' => [
        'count' => 100,
        'value' => .01
    ],
    'nickel' => [
        'count' => 25,
        'value' => .05
    ],
    'dime' => [
        'count' => 100,
        'value' => .10
    ],
    'quarter' => [
        'count' => 34,
        'value' => .25
    ],
    'halfDollar' => [
        'count' => 10,
        'value' => .50
    ]
];
foreach ($coins as $coin => $info) {
    $total = $total + ($info['count'] * $info['value']);
}

// var_dump($total);


$cards = [1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14];

shuffle($cards);

// $playerCards = array_splice($cards, 0, count($cards) / 2);
// $computerCards = $cards;

$playerCards = [];
$computerCards = [];
$toalCards = count($cards);
foreach ($cards as $key => $card) {
    if (count($playerCards) < ($toalCards / 2)) {
        $playerCards[] = array_pop($cards);
    }
    if (count($computerCards) < ($toalCards / 2)) {
        $computerCards[] = array_pop($cards);
    }
}

var_dump($playerCards);
var_dump($computerCards);

$playerDraw = array_pop($playerCards);
var_dump($playerDraw);
