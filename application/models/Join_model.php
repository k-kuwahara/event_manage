<?php
defined('BASEPATH') or exit('No direct script access allowed');

/**
 * Exchange_model
 */
class Join_model extends CI_Model
{
    /**
    * 終了していないイベント情報の取得
    *
    * @param  Int $event_id イベントID
    * @return Array イベント情報
    */
    public function get_events($event_id = '') 
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
                'dt_event', 'event_id, event_title, event_date, email, del_flg',
                [
                    'event_id' => $event_id,
                    'del_flg'  => 0,
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
    * イベントの登録
    *
    * @param  Array $params DBに登録する値の配列
    * @return Bool 登録完了orエラー
    */
    public function register_member($params)
    {
        // モデルの読み込み
        $this->load->model('query_model');
        $result = false;

        try {
            if ($params == '' || empty($params)) {
                throw new Exception('データベース登録エラーが発生'); 
            }

            if (!empty($params['a_id'])) {
                $result = $this->query_model->update(
                    'dt_answer', 
                    [
                        'event_id'    => $params['e_id'],
                        'answer_date' => date('Y-m-d H:i:s'),
                        'answer'      => $params['join_result'],
                        'answer_name' => $params['join_name'],
                        'email'       => $params['join_email'],
                        'memo'        => $params['join_memo'],
                    ],
                    [
                        'answer_id' => $params['a_id'],
                    ]
                );
            } else {
                $result = $this->query_model->insert(
                    'dt_answer', 
                    [
                        'event_id'    => $params['e_id'],
                        'answer_date' => date('Y-m-d H:i:s'),
                        'answer'      => $params['join_result'],
                        'answer_name' => $params['join_name'],
                        'email'       => $params['join_email'],
                        'memo'        => $params['join_memo'],
                    ]
                );
            }

            if ($result === false) {
                throw new Exception('データベース登録エラーが発生'); 
            }
            return [true, ""];

        } catch (Exception $e) {
            return [false, $e->getMessage()];
        }
    }

    /**
     * イベントの回答情報取得
     *
     * @param  Int $answer_id イベントID
     * @return Array イベント情報
     */
    public function get_answer($answer_id = '')
    {
        // モデルの読み込み
        $this->load->model('query_model');
        $result = [];

        try {
            // イベントIDが空の場合はエラー
            if ($answer_id == '') {
                throw new Exception('不正なアクセスです。'); 
            }

            $ret = $this->query_model->select(
                'dt_answer', 
                'answer_id, 
                 event_id, 
                 answer as join_result, 
                 answer_name as join_name, 
                 email as join_email, 
                 memo as join_memo',
                [
                    'answer_id' => $answer_id,
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
