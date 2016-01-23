<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Events extends MY_Controller
{
    public function __construct()
    {
        parent::__construct();
    }

    public function index()
    {
        // deleteモードの場合イベントを削除
        if ($_POST['mode'] == 'delete') {
            $this->event_delete($_POST['event_id']);
        } else {
            // イベントの取得
            $this->get_events();
        }
    }

    /**
     * イベントの取得
     *
     * @param  void
     * @return void
     */
    private function get_events()
    {
        // モデルの読み込み
        $this->load->model('events_model');
        // 取得
        list($events, $mess) = $this->events_model->get_events();

        // 何かしらのエラー発生時
        if ($events === false) {
            show_error($mess . 'しました。もう一度お手続きください。');
        } else {
            $this->_assign('events', $events);
            $this->_view("events.tpl");
        }
    }

    /**
     * 削除処理
     *
     * @param  Int $event_id イベントID
     * @return void
     */
    private function event_delete($event_id = '')
    {
        // モデルの読み込み
        $this->load->model('events_model');
        // 削除
        list($events, $mess) = $this->events_model->delete_event($event_id);

        // 何かしらのエラー発生時
        if ($events === false) {
            show_error($mess . 'しました。もう一度お手続きください。');
        } else {
            $this->get_events();
        }
    }
}
