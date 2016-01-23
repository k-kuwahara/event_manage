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
    public function get_events()
    {
        // モデルの読み込み
        $this->load->model('query_model');
        $result = [];

        try {
            $ret = $this->query_model->select(
                'dt_event', 'event_id, event_title, event_date, email, del_flg',
                [
                    'del_flg' => 0,
                ]
            );

            if ($ret === false) {
                throw new Exception('データベース参照エラーが発生'); 
            }
            $result = $ret->result_array();

            return [$result, ""];

        } catch (Exception $e) {
            return [false, $e->getMessage()];
        }
    }

    /**
     * イベント情報の削除
     *
     * @param  Int $event_id イベントID
     * @return Array イベント情報
     */
    public function delete_event($event_id = '')
    {
        // モデルの読み込み
        $this->load->model('query_model');
        $result = [];

        try {
            $result = $this->query_model->logical_delete('dt_event', ['event_id' => $event_id]);

            if ($result === false) {
                throw new Exception('データベース削除エラーが発生'); 
            }
            return [$result, ""];

        } catch (Exception $e) {
            return [false, $e->getMessage()];
        }
    }
}
