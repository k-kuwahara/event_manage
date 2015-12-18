<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Top extends My_Controller {

    public function __construct() {
        parent::__construct();
    }

    public function index() {
        $this->_view("top.tpl");
    }
}
