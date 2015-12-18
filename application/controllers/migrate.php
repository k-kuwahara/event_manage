<?php
class Migrate extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        // コマンドラインから実行されていることを確認
        if(!$this->input->is_cli_request()) {
            log_message('error', 'Request from HTTP is not allowed.');
            return FALSE;
        }
        $this->load->library('migration');
    }

    function current() {
        if ($this->migration->current()) {
            log_message('debug', 'Migration Success.');
        } else {
            log_message('error', $this->migration->error_string());
        }
    }

    function rollback($version = 0)
    {
        $this->migration->version($version);
    }

    function latest()
    {
        $this->migration->latest();
    }

}