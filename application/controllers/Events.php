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
            $this->eventDelete($_POST['eventId']);
        } else {
            // イベントの取得
            $this->getEvents();
        }
    }

    /**
     * イベントの取得
     *
     * @param  void
     * @return void
     */
    private function getEvents()
    {
        // モデルの読み込み
        $this->load->model('events_model');
        // 取得
        list($events, $mess) = $this->events_model->getEvents();

        // 何かしらのエラー発生時
        if ($events === false) {
            show_error($mess . 'しました。もう一度お手続きください。');
        } else {
            $this->_assign('arrEvent', $events);
            $this->_view("events.tpl");
        }
    }

    /**
     * 削除処理
     *
     * @param  Int $eventId イベントID
     * @return void
     */
    private function eventDelete($eventId = '')
    {
        // モデルの読み込み
        $this->load->model('events_model');
        // 削除
        list($events, $mess) = $this->events_model->deleteEvent($eventId);

        // 何かしらのエラー発生時
        if ($events === false) {
            show_error($mess . 'しました。もう一度お手続きください。');
        } else {
            $this->getEvents();
        }
    }
}
