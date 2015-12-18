<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Detail extends My_Controller {

    public function __construct() {
        parent::__construct();
    }

    public function index() {
        // 初期表示
        $this->getDetailEvent();
    }

    /**
     * 初期表示
     * @param void
     * @return void
     */
    private function getDetailEvent() {
        // モデルの読み込み
        $this->load->model('detail_model');
        // イベントIDを取得
        $eventId = $_GET['id'];
        list($members, $mess) = $this->detail_model->getEventInfo($eventId);

        // 何かしらのエラー発生時
        if ($members === false) {
            show_error($mess . 'しました。もう一度お手続きください。');
        } else {
            $this->_assign('eventMembers', $members);
            $this->_view("detail.tpl");
        }
    }
}
