<?php
namespace menrui;

require_once '../autoload.php';

exit(main());

function main()
{
    $in = '';
    while ('' !== ($data = fread(STDIN, 8092))) {
        $in .= $data;
    }
    $job = unserialize($in);
    $job->run();
    echo serialize($job->result);
    return 0;
}
