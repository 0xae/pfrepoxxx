<?php
namespace backend\components;

class FormData {
    public $data;
    public $isValid;
    public $lol;

    public function __construct($o,$v) {
        $this->data = $o;
        $this->isValid = $v;
    }
}

