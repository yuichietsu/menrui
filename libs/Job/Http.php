<?php

namespace menrui\Job;

class Http extends \menrui\Job
{
    public function run()
    {
        $this->result = [];
        foreach ($this->upstreams as $stream) {
            if ($url = $stream->result['url']) {
                $this->result[] = file_get_contents($url);
            }
        }
        $this->done = true;
    }
}
