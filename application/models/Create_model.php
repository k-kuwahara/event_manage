<?php
defined('BASEPATH') or exit('No direct script access allowed');

/**
 * Exchange_model
 */
class Create_model extends CI_Model
{

    /**
     * イベントの登録
     *
     * @param  Array $params DBに登録する値の配列
     * @return Bool 登録完了orエラー
     */
    public function register_event($params)
    {
        // モデルの読み込み
        $this->load->model('query_model');
        $result = [];

        try {
            // 重複チェック
            $ret = $this->query_model->select(
                'dt_event', 'count(*) as cnt',
                [
                    'event_title' => $params['event_title'],
                    'event_date'  => $params['event_date'],
                    'email'       => $params['admin_email'],
                    'del_flg'     => 0,
                ]
            );

            if ($ret === false) {
                throw new Exception('データベース参照エラーが発生');
            }
            $check = $ret->result_array();

            if ($check[0]['cnt'] > 0) {
                throw new Exception("登録済みのデータです。別のイベントを登録してください。");
            } elseif (!$check) {
                throw new Exception('データベース参照エラーが発生');
            }

            $result = $this->query_model->insert(
                'dt_event',
                [
                    'event_title' => $params['event_title'],
                    'create_date' => date('Y-m-d H:i:s'),
                    'update_date' => date('Y-m-d H:i:s'),
                    'event_date'  => $params['event_date'],
                    'email'       => $params['admin_email'],
                    'del_flg'     => 0,
                ]
            );

            if ($result === false) {
                throw new Exception('データベース登録エラーが発生');
            }
            return [true, ""];

        } catch (Exception $e) {
            return [false, $e->getMessage()];
        }
    }
}
