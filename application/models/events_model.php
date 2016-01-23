<?php
defined('BASEPATH') or exit('No direct script access allowed');

/**
 * イベント一覧のモデル
 */
class Events_model extends CI_Model
{
    /**
     * 終了していないイベント情報の取得
     *
     * @param  Void
     * @return Array イベント情報
     */
    public function getEvents()
    {
        // モデルの読み込み
        $this->load->model('query_model');
        $result = array();

        try {
            $ret = $this->query_model->select(
                'dt_event', 'event_id, event_title, event_date, email, del_flg',
                array(
                    'del_flg' => 0,
                )
            );

            if ($ret === false) {
                throw new Exception('データベース参照エラーが発生'); 
            }
            $result = $ret->result_array();

            return array($result, "");

        } catch (Exception $e) {
            return array(false, $e->getMessage());
        }
    }

    /**
     * イベント情報の削除
     *
     * @param  Int $eventId イベントID
     * @return Array イベント情報
     */
    public function deleteEvent($eventId = '')
    {
        // モデルの読み込み
        $this->load->model('query_model');
        $result = array();

        try {
            $result = $this->query_model->logicalDelete('dt_event', array('event_id' => $eventId));

            if ($result === false) {
                throw new Exception('データベース削除エラーが発生'); 
            }
            return array($result, "");

        } catch (Exception $e) {
            return array(false, $e->getMessage());
        }
    }
}
