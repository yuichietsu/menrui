<?php
namespace menrui;

require_once '../autoload.php';

$b = new Bootstrap();
$b->flow = new Job\PrintR([
    new Job\RandomGenerator(),
    new Job\RandomGenerator(),
    new Job\RandomGenerator(),
]);
$b->run();
