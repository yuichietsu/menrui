<?php
namespace menrui;

class Fork
{
    public function exec($jobs)
    {
        $n = count($jobs);
        if ($n == 1) {
            $jobs[0]->run();
        } elseif ($n > 1) {
            $this->fork($jobs);
        }
    }

    protected function fork($jobs)
    {
        $this->fakeFork($jobs);
    }

    protected function fakeFork($jobs)
    {
        $descriptors = [
            0 => ['pipe', 'r'],
            1 => ['pipe', 'w'],
        ];
        $pipes = [];
        $procs = [];
        foreach ($jobs as $job) {
            $pipe = [];
            $proc = proc_open('php subprocess.php proc', $descriptors, $pipe);
            stream_set_blocking($pipe[1], 0);
            $procs[$job->id] = $proc;
            $pipes[$job->id] = $pipe;
        }

        $running = true;
        while ($running) {
            $running = false;
            foreach ($jobs as $job) {
                $stat = proc_get_status($procs[$job->id]);
                if ($stat['running']) {
                    $running = true;
                    usleep(10 * 1000);
                    $str = fread($pipes[$job->id][1], 1024);
                    if ($str) {
                        printf($str);
                    }
                }
            }
        }

        foreach ($jobs as $job) {
            fclose($pipes[$job->id][1]);
            proc_close($procs[$job->id]);
        }
    }

    protected function pcntlFork($jobs)
    {
    }
}
