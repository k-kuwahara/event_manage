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
        $eventId = $_GET['id'];
        if (is_null($eventId)) { 
            show_error('不正なアクセスです。'); 
        } 

        list($members, $mess) = $this->detail_model->getAnswer($eventId);

        // 何かしらのエラー発生時
        if ($members === false) {
            show_error($mess . 'しました。もう一度お手続きください。');
        } else {
            $this->_assign('eventMembers', $members);
            $this->_view('detail.tpl');
        }
    }
}
