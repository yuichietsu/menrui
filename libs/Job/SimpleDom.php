<?php

namespace menrui\Job;

class SimpleDom extends \menrui\Job
{
    public function run()
    {
        list($params, $data) = $this->extractParameters();
        if ($params !== null) {
            $id    = $params['id'];
            $class = $params['class'];
            $tag   = $params['tag'];
            $attr  = $params['attr'];
            if ($id || $class || $tag || $attr) {
                foreach ($data as $html) {
                    $dom = new \DOMDocument();
                    $dom->loadHTML($html);
                    $r = [];
                    if ($id) {
                        $r['id'] = $dom->getElementById($id);
                    }
                    if ($class || $attr) {
                        $nodes = $dom->getElementsByTagName('*');
                        foreach ($nodes as $node) {
                            if ($class) {
                                if ($node->getAttribute('class') == $class) {
                                    $r['class'][] = $node;
                                }
                            }
                            if ($attr) {
                                foreach ($attr as $k => $v) {
                                    if ($node->getAttribute($k) == $v) {
                                        $r['attr'][] = $node;
                                    }
                                }
                            }
                        }
                    }
                    if ($tag) {
                        $nodes = $dom->getElementsByTagName($tag);
                        foreach ($nodes as $node) {
                            $r['tag'][] = $node;
                        }
                    }
                    $this->result[] = $r;
                }
            }
        }
        $this->done = true;
    }
}
