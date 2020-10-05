<?php

namespace menrui\Job;

class Parameter extends \menrui\Job
{
    public $done = true;

    public function __construct($result = [])
    {
        $this->result = $result;
    }
}
