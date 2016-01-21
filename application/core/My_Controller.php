<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * App_Controller
 * Smarty on CodeIgniter
 */
class MY_Controller extends CI_Controller {
    protected $template;

    public function __construct() {
        parent::__construct();

        # smarty
        $this->smarty->template_dir = APPPATH . 'views/templates';
        $this->smarty->compile_dir  = APPPATH . 'cache/templates_c';
        $this->smarty->left_delimiter = '<!--{';
        $this->smarty->right_delimiter = '}-->';
        $this->template = null;
    }

    public function _view($template) {
        $this->template = $template;
    }

    public function _output($output)
    {
        if (strlen($output) > 0) {
            echo $output;
        } else {
            $this->smarty->display($this->template); 
        }
    }

    public function _assign($k, $v) {
        $this->smarty->assign($k, $v);
    }
}
