<?php
namespace menrui;

require_once '../autoload.php';

$b = new Bootstrap();
$b->inputs[] = new Job\Input();
$b->run();
