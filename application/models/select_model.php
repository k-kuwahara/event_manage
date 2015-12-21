<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * Exchange_model
 */
class Select_model extends CI_Model {

    /**
     * イベントの登録
     * @param Array DBに登録する値の配列
     * @param bool 登録完了orエラー
     */
    public function registerEvent($params) {
        // モデルの読み込み
        $this->load->model('query_model');
        $result = array();

        try {
            // 重複チェック
            $ret = $this->query_model->select('dt_event', 'count(*) as cnt', 
                array(
                    'event_title' => $params['eventTitle'],
                    'event_date'  => $params['eventDate'],
                    'email'       => $params['adminEmail'],
                    'del_flg'     => 0,
                )
            );

            if ($ret === false) throw new Exception('データベース参照エラーが発生');
            $check = $ret->result_array();

            if ($check[0]['cnt'] > 0) {
                throw new Exception("登録済みのデータです。別のイベントを登録してください。");
            } elseif (!$check) {
                throw new Exception('データベース参照エラーが発生');
            }

            $result = $this->query_model->insert('dt_event', 
                array(
                    'event_title' => $params['eventTitle'],
                    'create_date' => date('Y-m-d H:i:s'),
                    'update_date' => date('Y-m-d H:i:s'),
                    'event_date'  => $params['eventDate'],
                    'email'       => $params['adminEmail'],
                    'del_flg'     => 0,
                )
            );

            if ($result === false) throw new Exception('データベース登録エラーが発生');
            return array(true, "");

        } catch (Exception $e) {
            return array(false, $e->getMessage());
        }
    }
}