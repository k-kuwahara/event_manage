<?php
defined('BASEPATH') or exit('No direct script access allowed');

/**
 * イベント詳細のモデル
 */
class Detail_model extends CI_Model
{

    /**
     * イベントの出欠情報の取得
     *
     * @param  Int $event_id エベントID
     * @return Array 出欠情報
     */
    public function get_answer($event_id = '')
    {
        // モデルの読み込み
        $this->load->model('query_model');
        $result = [];

        try {
            // イベントIDが空の場合はエラー
            if ($event_id == '') {
                throw new Exception('不正なアクセスです。'); 
            }

            $ret = $this->query_model->select(
                'dt_answer', 
                "answer_id, 
                 event_id, 
                 answer_date, 
                 (CASE WHEN answer = 1 THEN '出席'
                       WHEN answer = 2 THEN '欠席'
                       ELSE '保留' END) AS answer, 
                 answer_name as name, 
                 memo", 
                [
                    'event_id' => $event_id,
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

}
