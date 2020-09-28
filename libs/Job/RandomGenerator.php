<?php

namespace merui\Job;

class RandomGenerator extends \merui\Job
{
    public function run()
    {
        $this->result = mt_rand();
        $this->done = true;
    }
}
