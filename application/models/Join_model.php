<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * Exchange_model
 */
class Join_model extends CI_Model {
   /**
    * 終了していないイベント情報の取得
    * @param Int イベントID
    * @return Array イベント情報
    **/
   public function getEvents($eventId = '') {
      // モデルの読み込み
      $this->load->model('query_model');
      $result = array();

      try {
         // イベントIDが空の場合はエラー
         if ($eventId == '') throw new Exception('不正なアクセスです。');

         $ret = $this->query_model->select('dt_event', 'event_id, event_title, event_date, email, del_flg',
            array(
               'event_id' => $eventId,
               'del_flg'  => 0,
            )
         );

         if ($ret === FALSE) throw new Exception('データベース参照エラーが発生');
         $result = $ret->result_array();

         return array($result, "");

      } catch (Exception $e) {
         return array(FALSE, $e->getMessage());
      }
   }

   /**
    * イベントの登録
    * @param Array DBに登録する値の配列
    * @param bool 登録完了orエラー
    */
   public function registerMember($params) {
      // モデルの読み込み
      $this->load->model('query_model');
      $result = FALSE;

      try {
         if ($params == '' || empty($params)) throw new Exception('データベース登録エラーが発生');

         if (!empty($params['aId'])) {
            $result = $this->query_model->update('dt_answer', 
               array(
                  'event_id'    => $params['eId'],
                  'answer_date' => date('Y-m-d H:i:s'),
                  'answer'      => $params['joinResult'],
                  'answer_name' => $params['joinName'],
                  'email'       => $params['joinEmail'],
                  'memo'        => $params['joinMemo'],
               ),
               array(
                  'answer_id' => $params['aId'],
               )
            );
         } else {
            $result = $this->query_model->insert('dt_answer', 
               array(
                  'event_id'    => $params['eId'],
                  'answer_date' => date('Y-m-d H:i:s'),
                  'answer'      => $params['joinResult'],
                  'answer_name' => $params['joinName'],
                  'email'       => $params['joinEmail'],
                  'memo'        => $params['joinMemo'],
               )
            );
         }

         if ($result === FALSE) throw new Exception('データベース登録エラーが発生');
         return array(TRUE, "");

      } catch (Exception $e) {
         return array(FALSE, $e->getMessage());
      }
   }

   /**
    * イベントの解凍情報取得
    * @param Int イベントID
    * @return Array イベント情報
    **/
   public function getAnswer($answerId = '') {
      // モデルの読み込み
      $this->load->model('query_model');
      $result = array();

      try {
         // イベントIDが空の場合はエラー
         if ($answerId == '') throw new Exception('不正なアクセスです。');

         $ret = $this->query_model->select('dt_answer', 
            'answer_id, 
             event_id, 
             answer as joinResult, 
             answer_name as joinName, 
             email as joinEmail, 
             memo as joinMemo',
            array(
               'answer_id' => $answerId,
            )
         );

         if ($ret === FALSE) throw new Exception('データベース参照エラーが発生');
         $result = $ret->result_array();

         return array($result, "");

      } catch (Exception $e) {
         return array(FALSE, $e->getMessage());
      }
   }
}
