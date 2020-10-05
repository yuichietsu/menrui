<?php

namespace menrui\Job;

class UserFunction extends \menrui\Job
{
    public function run()
    {
        list($params, $data) = $this->extractParameters();
        if ($params !== null) {
            $func = $params['function'];
            $this->result = call_user_func($func, $data);
        }
        $this->done = true;
    }
}
