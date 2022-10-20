<?php
$answer = $_POST['answer'];

$haveAnswer = $answer == '' ? false : true;

$correct = $answer == 'pumpkin';

require 'process-view.php';
