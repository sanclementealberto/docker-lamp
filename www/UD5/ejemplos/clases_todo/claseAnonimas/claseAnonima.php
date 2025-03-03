<?php
/**
 * An anonymous class is closely related to a named class, 
 * with the primary difference being that we instantiate it without a name.
 */

$obj = new class($a, $b) {
    private $a;
    private $b;

    public function __construct($a, $b) {
        $this->a = $a;
        $this->b = $b;
    }
};