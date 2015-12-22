<?php

class join_model_test extends TestCase {
   // セットアップ
   public function setUp()
   {
      $this->CI =& get_instance();

      $this->CI->load->model('join_model');
      $this->CI->load->model('query_model');

      $this->joinObj  = $this->CI->join_model;
      $this->queryObj = $this->CI->query_model;
   }

   public function test_index() {
      // 初期データ投入
      $arrParam = array(
         'event_title' => 'テストイベントタイトル4',
         'create_date' => date('Y-m-d H:i:s'),
         'update_date' => date('Y-m-d H:i:s'),
         'event_date'  => '2015/12/23 10:30',
         'email'       => 'bar@gmail.com',
         'del_flg'     => 0,
      );

      // 登録実行
      $result = $this->queryObj->insert('dt_event', $arrParam);
      // 正常終了確認
      $this->assertTrue($result);
   }

   // イベントデータ取得
   public function test_getEvents() {
      // 正常系
      // イベントデータ取得
      $eventGet = $this->queryObj->select(
         'dt_event',
         '*',
         ''
      );
      $eventGetResult = $eventGet->result_array();
      // 正常終了確認
      $this->assertLessThan(count($eventGetResult), 0);

      // 異常系
      // イベントデータ取得
      list($eventGet, $retMess) = $this->joinObj->getEvents();
      // エラー確認
      $this->assertFalse($eventGet);
      $this->assertEquals($retMess, '不正なアクセスです。');
   }


   // 回答登録テスト
   public function test_registerMember() {
      // 正常系
      $params = array(
          'aId'       => NULL,
          'joinResult'  => 1,
          'joinName'   => 'フーテスト',
          'joinEmail'   => 'foo@hotmail.co.jp',
          'joinMemo'   => 'テストメモ4'
      );
      // 登録実行
      list($result, $retMess) = $this->joinObj->registerMember($params);
      // 正常終了確認
      $this->assertEquals($result, TRUE);
      $this->assertEquals($retMess, "");

      // 異常系
      // 登録実行（空文字列）
      list($result, $retMess) = $this->joinObj->registerMember('');
      // 正常終了確認
      $this->assertEquals($result, FALSE);
      $this->assertEquals($retMess, "データベース登録エラーが発生");
      // 登録実行（空配列）
      list($result, $retMess) = $this->joinObj->registerMember(array());
      // 正常終了確認
      $this->assertEquals($result, FALSE);
      $this->assertEquals($retMess, "データベース登録エラーが発生");
      // 登録実行（空配列）
      list($result, $retMess) = $this->joinObj->registerMember(NULL);
      // 正常終了確認
      $this->assertEquals($result, FALSE);
      $this->assertEquals($retMess, "データベース登録エラーが発生");
   }


   // 回答データ取得
   public function test_getAnswer() {
      // 正常系
      // イベントデータ取得
      list($answerResult, $retMess) = $this->joinObj->getAnswer(0);
      // 正常終了確認
      $this->assertEquals(count($answerResult), 1);
      $this->assertEquals($retMess, "");

      // 異常系
      // イベントデータ取得
      list($answerResult, $retMess) = $this->joinObj->getAnswer();
      // エラー確認
      $this->assertEquals($retMess, '不正なアクセスです。');
   }
}
