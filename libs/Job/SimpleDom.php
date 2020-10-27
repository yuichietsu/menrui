<?php

namespace menrui\Job;

class SimpleDom extends \menrui\Job
{
    public function run()
    {
        list($params, $data) = $this->extractParameters();
        if ($params !== null) {
            // selector
            $id    = $params['id'];
            $class = $params['class'];
            $tag   = $params['tag'];
            $attr  = $params['attr'];
            // target
            $target = $params['target'];
            if ($id || $class || $tag || $attr) {
                foreach ($data as $html) {
                    $dom = new \DOMDocument();
                    $dom->loadHTML($html);
                    $r = [];
                    if ($id) {
                        $r['id'] = $this->node($target, $dom->getElementById($id));
                    }
                    if ($class || $attr) {
                        $nodes = $dom->getElementsByTagName('*');
                        foreach ($nodes as $node) {
                            if ($class) {
                                if ($node->getAttribute('class') == $class) {
                                    $r['class'][] = $this->node($target, $node);
                                }
                            }
                            if ($attr) {
                                foreach ($attr as $k => $v) {
                                    if ($node->getAttribute($k) == $v) {
                                        $r['attr'][] = $this->node($target, $node);
                                    }
                                }
                            }
                        }
                    }
                    if ($tag) {
                        $nodes = $dom->getElementsByTagName($tag);
                        foreach ($nodes as $node) {
                            $r['tag'][] = $this->node($target, $node);
                        }
                    }
                    $this->result[] = $r;
                }
            }
        }
        $this->done = true;
    }

    protected function node($target, $node)
    {
        $ret = null;
        if ($node) {
            if (is_callable($target)) {
                $ret = call_user_func($target, $node);
            } else {
                $ret = $node->nodeValue;
            }
        }
        return $ret;
    }
}
