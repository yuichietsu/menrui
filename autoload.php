<?php

spl_autoload_register(function ($class) {
    $s = explode('\\', $class);
    $root = array_shift($s);
    if ($root == 'menrui') {
        $name = implode('/', $s);
        $file = __DIR__ . "/libs/$name.php";
        file_exists($file) && require_once($file);
    }
});
