<?php
namespace menrui;

class Job
{
    public $done = false;
    public $errorMessage = null;
    public $exitCode = 0;
    public $upstreams = [];
    public $result = null;
    public $proc;
    public $pipes;
    public $raw = '';

    public function __construct($upstreams = [])
    {
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
    }

    public function error($msg)
    {
        if ($code === 0) {
            $this->result = unserialize($this->raw);
        }
        $this->errorMessage = $msg;
        $this->done = true;
    }

    public function exit($code)
    {
        if ($code === 0) {
            $this->result = unserialize($this->raw);
        }
        $this->exitCode = $code;
        $this->done = true;
    }

    public function open($cmd)
    {
        $pipes = [];
        $descriptors = [
            0 => ['pipe', 'r'],
            1 => ['pipe', 'w'],
            2 => ['pipe', 'w'],
        ];
        $proc = proc_open($cmd, $descriptors, $pipes);
        stream_set_blocking($pipes[1], 0);
        stream_set_blocking($pipes[2], 0);
        $this->proc = $proc;
        $this->pipes = $pipes;
    }

    public function init()
    {
        fwrite($this->pipes[0], serialize($this));
        fclose($this->pipes[0]);
    }

    public function close()
    {
        fclose($this->pipes[1]);
        fclose($this->pipes[2]);
        proc_close($this->proc);
    }
}
