<?php
require 'Number.php';
require 'EvenNumber.php';

$example1 = new Number(50);
$example2 = new EvenNumber(50);

var_dump($example1->getHalf());
var_dump($example2->getHalf());
