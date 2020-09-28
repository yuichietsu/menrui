<?php
namespace menrui;

class Job
{
    private static $idSeq = 1;

    public $id = 0;
    public $done = false;
    public $upstreams = [];
    public $result = null;

    public function __construct($upstreams = [])
    {
        $this->id = self::$idSeq++;
        $this->upstreams = $upstreams;
    }

    public function nextJobs(&$jobs = null)
    {
        $jobs === null && ($jobs = []);
        if (!$this->done) {
            $prepared = true;
            foreach ($this->upstreams as $stream) {
                if (!$stream->done) {
                    $prepared = false;
                    $stream->nextJobs($jobs);
                }
            }
            $prepared && ($jobs[] = $this);
        }
        return $jobs;
    }

    public function run()
    {
        $this->done = true;
    }
}
