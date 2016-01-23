<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Detail extends MY_Controller
{

    public function __construct()
    {
        parent::__construct();
    }

    public function index()
    {
        // モデルの読み込み
        $this->load->model('detail_model');
        // イベントIDを取得
        $event_id = $_GET['id'];
        if (is_null($event_id)) {
            show_error('不正なアクセスです。'); 
        } 

        list($members, $mess) = $this->detail_model->get_answer($event_id);

        // 何かしらのエラー発生時
        if ($members === false) {
            show_error($mess . 'しました。もう一度お手続きください。');
        } else {
            $this->_assign('members', $members);
            $this->_view('detail.tpl');
        }
    }
}
