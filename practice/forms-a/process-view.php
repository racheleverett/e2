<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Results</title>
</head>

<body>
    <h3>Results</h3>
    <?php
    if ($haveAnswer) {
        echo $correct ? 'Correct answer :-)' : 'Incorrect answer!!';
    }
    echo '<br><a href="index.php">Play again</a>';
    ?>
</body>

</html>