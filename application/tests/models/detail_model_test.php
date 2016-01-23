<?php

class detail_model_test extends TestCase
{
    // セットアップ
    public function setUp()
    {
        $this->CI =& get_instance();

        $this->CI->load->model('detail_model');
        $this->CI->load->model('query_model');

        $this->obj_detail = $this->CI->detail_model;
        $this->obj_query  = $this->CI->query_model;

        // イベントデータ取得
        $tmp = $this->obj_query->select(
            'dt_event',
            '*',
            ''
        );
        $this->events = $tmp->result_array();
    }

    public function test_index() 
    {
        // 初期データ投入
        $params = [
            'event_id'    => $this->events[0]['event_id'],
            'answer_date' => date('Y-m-d H:i:s'),
            'answer'      => 2,
            'answer_name' => 'バーテスト',
            'email'       => 'bar@gmail.com',
            'memo'        => 'テストメモ５'
        ];

        // 登録実行
        $result = $this->obj_query->insert('dt_answer', $params);
        // 正常終了確認
        $this->assertTrue($result);
    }

    // 回答データ取得
    public function test_get_answer()
    {
        // 正常系
        // イベントデータ取得
        list($answer_result, $ret_mess) = $this->obj_detail->get_answer($this->events[0]['event_id']);
        // 正常終了確認
        $this->assertEquals(count($answer_result), 1);
        $this->assertEquals($retMess, "");

        // 異常系
        // イベントデータ取得
        list($answer_result, $ret_mess) = $this->obj_detail->get_answer();
        // エラー確認
        $this->assertEquals($ret_mess, '不正なアクセスです。');
    }
}
