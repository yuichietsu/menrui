<?php

namespace menrui\Job;

class Http extends \menrui\Job
{
    protected $flatten = false;
    
    public function run()
    {
        $this->result = [];
        foreach ($this->upstreams as $stream) {
            if ($url = $stream->result['url']) {
                $this->result[] = file_get_contents($url);
            }
            if ($stream->result['flatten']) {
                $this->flatten = true;
            }
        }
        if ($this->flatten && count($this->result) == 1) {
            $this->result = $this->result[0];
        }
        $this->done = true;
    }
}
