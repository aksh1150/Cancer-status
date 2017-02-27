<?php


class Node
{
    public 	$value;
    public	$namedBranches;
    public $decisionUility;
    public function __construct($new_item) {
        $this->value = $new_item;
        $this->namedBranches=array();
    }

    public function display($level) {
        echo $this->value . "\n";
        foreach($this->namedBranches as $b => $child_node) {
            echo str_repeat(" ", ($level+1)*4) . str_repeat("-", 14/2 - strlen($b)/2) . $b . str_repeat("-", 14/2 - strlen($b)/2) . ">";
            $child_node->display($level + 1);
        }
    }
    public function get_parent() {
        return ($this->tree);
    }
}