<?php

class join_model_test extends TestCase {
   // セットアップ
   public function setUp()
   {
      $this->CI =& get_instance();

      $this->CI->load->model('join_model');
      $this->CI->load->model('query_model');

      $this->obj_join  = $this->CI->join_model;
      $this->obj_query = $this->CI->query_model;
   }

   public function test_index() {
      // 初期データ投入
      $params = [
         'event_title' => 'テストイベントタイトル4',
         'create_date' => date('Y-m-d H:i:s'),
         'update_date' => date('Y-m-d H:i:s'),
         'event_date'  => '2015/12/23 10:30',
         'email'       => 'bar@gmail.com',
         'del_flg'     => 0,
      ];

      // 登録実行
      $result = $this->obj_query->insert('dt_event', $params);
      // 正常終了確認
      $this->assertTrue($result);
   }

   // イベントデータ取得
   public function test_get_events() {
      // 正常系
      // イベントデータ取得
      $tmp = $this->obj_query->select(
         'dt_event',
         '*',
         ''
      );
      $events = $tmp->result_array();
      // 正常終了確認
      $this->assertLessThan(count($events), 0);

      // 異常系
      // イベントデータ取得
      list($events, $ret_mess) = $this->obj_join->get_events();
      // エラー確認
      $this->assertFalse($events);
      $this->assertEquals($ret_mess, '不正なアクセスです。');
   }


   // 回答登録テスト
   public function test_register_member() {
      // 正常系
      // イベントデータ取得
      $tmp = $this->obj_query->select(
         'dt_event',
         '*',
         ''
      );
      $events = $tmp->result_array();

      $params = [
          'a_id'        => NULL,
          'e_id'        => $events[0]['event_id'],
          'join_result' => 1,
          'join_name'   => 'フーテスト',
          'join_email'  => 'foo@hotmail.co.jp',
          'join_memo'   => 'テストメモ4'
      ];
      // 登録実行
      list($result, $ret_mess) = $this->obj_join->register_member($params);
      // 正常終了確認
      $this->assertTrue($result);
      $this->assertEquals($ret_mess, "");

      // 異常系
      // 登録実行（空文字列）
      list($result, $ret_mess) = $this->obj_join->register_member('');
      // 正常終了確認
      $this->assertFalse($result);
      $this->assertEquals($ret_mess, "データベース登録エラーが発生");
      // 登録実行（空配列）
      list($result, $ret_mess) = $this->obj_join->register_member([]);
      // 正常終了確認
      $this->assertFalse($result);
      $this->assertEquals($ret_mess, "データベース登録エラーが発生");
      // 登録実行（空配列）
      list($result, $ret_mess) = $this->obj_join->register_member(NULL);
      // 正常終了確認
      $this->assertFalse($result);
      $this->assertEquals($ret_mess, "データベース登録エラーが発生");
   }


   // 回答データ取得
   public function test_getAnswer() {
      // 正常系
      // 登録回答データ全件取得
      $tmp = $this->obj_query->select(
         'dt_answer',
         'answer_id',
         ''
      );
      $tmp_answers = $tmp->result_array();
      // イベントデータ取得
      list($answers, $ret_mess) = $this->obj_join->get_answer($tmp_answers[0]['answer_id']);
      // 正常終了確認
      $this->assertEquals(count($answers), 1);
      $this->assertEquals($ret_mess, "");

      // 異常系
      // イベントデータ取得
      list($answers, $ret_mess) = $this->obj_join->get_answer();
      // エラー確認
      $this->assertEquals($ret_mess, '不正なアクセスです。');
   }
}
