<?php

class detail_model_test extends TestCase {
   // セットアップ
   public function setUp()
   {
      $this->CI =& get_instance();

      $this->CI->load->model('detail_model');
      $this->CI->load->model('query_model');

      $this->detailObj = $this->CI->detail_model;
      $this->queryObj  = $this->CI->query_model;

      // イベントデータ取得
      $eventGet = $this->queryObj->select(
         'dt_event',
         '*',
         ''
      );
      $this->eventGetResult = $eventGet->result_array();
   }

   public function test_index() {
      // 初期データ投入
      $params = array(
         'event_id'    => $this->eventGetResult[0]['event_id'],
         'answer_date' => date('Y-m-d H:i:s'),
         'answer'      => 2,
         'answer_name' => 'バーテスト',
         'email'       => 'bar@gmail.com',
         'memo'        => 'テストメモ５'
      );

      // 登録実行
      $result = $this->queryObj->insert('dt_answer', $params);
      // 正常終了確認
      $this->assertTrue($result);
   }

   // 回答データ取得
   public function test_getAnswer() {
      // 正常系
      // イベントデータ取得
      list($answerResult, $retMess) = $this->detailObj->getAnswer($this->eventGetResult[0]['event_id']);
      // 正常終了確認
      $this->assertEquals(count($answerResult), 1);
      $this->assertEquals($retMess, "");

      // 異常系
      // イベントデータ取得
      list($answerResult, $retMess) = $this->detailObj->getAnswer();
      // エラー確認
      $this->assertEquals($retMess, '不正なアクセスです。');
   }
}
