<?php

namespace Menrui\Job;

class PrintR extends \Menrui\Job
{
    public function run()
    {
        $r = [];
        foreach ($this->upstreams as $stream) {
            $r[] = $stream->result;
        }
        print_r($r);
        $this->done = true;
    }
}
