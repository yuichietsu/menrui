<?php

namespace menrui\Job;

class RandomGenerator extends \menrui\Job
{
    public function run()
    {
        $this->result = mt_rand();
        $this->done = true;
    }
}
