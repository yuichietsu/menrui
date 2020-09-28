<?php

namespace menrui\Job;

class PrintR extends \menrui\Job
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
