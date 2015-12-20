<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * Exchange_model
 */
class Detail_model extends CI_Model {

    /**
     * イベントの出欠情報の取得
     * @param Int エベントID
     * @param Array 出欠情報
     */
    public function getEventInfo($eventId) {
        // モデルの読み込み
        $this->load->model('query_model');
        $result = array();

        try {
            $ret = $this->query_model->select('dt_answer', 
                "answer_id, 
                event_id, 
                answer_date, 
                (CASE WHEN answer = 1 THEN '出席'
                     WHEN answer = 2 THEN '欠席'
                     ELSE '保留' END) AS answer, 
                answer_name as name, 
                memo", 
                array(
                    'event_id' => $eventId,
                )
            );

            if ($ret === false) throw new Exception('データベース参照エラーが発生');
            $result = $ret->result_array();

            return array($result, "");

        } catch (Exception $e) {
            return array(false, $e->getMessage());
        }
    }

}
