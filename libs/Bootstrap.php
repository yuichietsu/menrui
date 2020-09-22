<?php
namespace menrui;

class Bootstrap
{
    public $inputs   = [];
    public $converts = [];
    public $outputs  = [];

    public function run()
    {
        $fork = new Fork();
        $fork->exec($this->inputs);
    }
}
