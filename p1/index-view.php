<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Project One</title>
</head>

<body>
    <h1>Tic Tac Toe Game Simulator</h1>

    <h2>Mechanics</h2>
    <ul>
        <li>Adding a 3x3 multidimensional array</li>
        <li>All elements of array are empty</li>
        <li>Set 2 computer players</li>
        <li>Distribute cell value X, O to each player</li>
        <li>Each player can guess x, y values between 0, 2</li>
        <li>After a player makes a guess, check if that spot is empty</li>
        <li>If not then make another guess until a proper move has been made</li>
        <li>Loop through the moves until either all places are filled or a winning combination is made</li>
        <li>If win combination found, terminate</li>
    </ul>

    <h2>Results</h2>
    <?php foreach ($results as $index => $result) { ?>
        <ul>
            <li>
                <?php echo 'Round ' . ($index + 1); ?>
                <pre>
                    <?php
                    foreach ($result as $line) {
                        echo $line;
                    }
                    ?>
                </pre>
            </li>
        </ul>
    <?php } ?>
    <pre>
    </pre>
</body>

</html>