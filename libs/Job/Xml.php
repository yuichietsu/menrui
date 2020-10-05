<?php

namespace menrui\Job;

class Xml extends \menrui\Job
{
    public function run()
    {
        list($params, $data) = $this->extractParameters();
        if ($params !== null) {
            $xpath = $params['xpath'];
            foreach ($data as $xml) {
                $sxe = new \SimpleXMLElement($xml);
                $this->result[] = $sxe->xpath($xpath);
            }
        }
        $this->done = true;
    }
}
