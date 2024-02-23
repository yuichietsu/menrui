<?php
require_once __DIR__ . '/vendor/autoload.php';

namespace Menrui;

exit(main());

function main()
{
    $in = '';
    while ('' !== ($data = fread(STDIN, 8092))) {
        $in .= $data;
    }
    $job = \Opis\Closure\Unserialize($in);
    $job->run();
    echo serialize($job->result);
    return 0;
}
