<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Event extends My_Controller {

    public function __construct() {
        parent::__construct();
    }

    public function index() {

        // deleteモードの場合イベントを削除
        if ($_POST['mode'] == 'delete') {
            $this->postDelete($_POST['eventId']);
        } else {
            // イベントの取得
            $this->getEvents();
        }
    }

    /**
     * イベントの取得
     * @param void
     * @return void
     */
    private function getEvents() {
        // モデルの読み込み
        $this->load->model('event_model');
        // 取得
        list($events, $mess) = $this->event_model->getEvents();

        // 何かしらのエラー発生時
        if ($events === false) {
            show_error($mess . 'しました。もう一度お手続きください。');
        } else {
            $this->_assign('arrEvent', $events);
            $this->_view("event.tpl");
        }
    }

    /**
     * 削除処理
     * @param Int イベントID
     * @return void
     */
    private function postDelete($eventId = '') {
        // モデルの読み込み
        $this->load->model('event_model');
        // 削除
        list($events, $mess) = $this->event_model->deleteEvent($eventId);

        // 何かしらのエラー発生時
        if ($events === false) {
            show_error($mess . 'しました。もう一度お手続きください。');
        } else {
            $this->getEvents();
            $this->_view("event.tpl");
        }
    }
}
