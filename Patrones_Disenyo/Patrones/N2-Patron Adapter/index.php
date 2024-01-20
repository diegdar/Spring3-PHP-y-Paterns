<?php
require "poultry.php";

function duck_interaction($duck) {
    $duck->quack();
    $duck->fly();
}

$duck = new Duck;
$turkey = new Turkey;
$turkey_adapter = new TurkeyAdapter($turkey);
echo "The Turkey says...\n";
$turkey->gobble();
$turkey->fly();
echo "The Duck says...\n";
duck_interaction($duck);
echo "The TurkeyAdapter says...\n";
duck_interaction($turkey_adapter);

// Output
// The expected output is as follows:
// The Turkey says...
// Gobble gobble
// I'm flying a short distance
// The Duck says...
// Quack
// I'm flying
// The TurkeyAdapter says...
// Gobble gobble
// I'm flying a short distance
// I'm flying a short distance
// I'm flying a short distance
// I'm flying a short distance
// I'm flying a short distance

