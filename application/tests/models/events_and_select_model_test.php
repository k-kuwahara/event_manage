<?php

class Events_and_select_model_test extends TestCase {
    // セットアップ
    public function setUp()
    {
        $this->CI =& get_instance();

        $this->CI->load->model('events_model');
        $this->CI->load->model('join_model');
        $this->CI->load->model('query_model');

        $this->eventsObj = $this->CI->events_model;
        $this->joinObj = $this->CI->join_model;
        $this->queryObj = $this->CI->query_model;
    }

    // 全データを物理削除
    public function test_index() {
        // 全イベントを削除
        $deleteResult = $this->queryObj->physicalDelete('dt_event');
        $this->assertEquals($deleteResult, TRUE);

        // データ取得
        $eventResult = $this->eventsObj->getEvents();
        $this->assertEquals(count($eventResult), 0);
    }

    // データ挿入周りのテスト
    public function test_data_insert() {
        $params = [
            'answer_date' => date('Y-m-d H:i'),
            'joinResult'  => 1,
            'joinName'    => '桑原',
            'joinEmail'   => 'kuwahara@lepra.jp',
            'joinMemo'    => '回答一つ目'
        ];

        // 登録実行
        list($result, $mess) = $this->joinObj->registerMember($params);
        // 正常終了確認
        $this->assertEquals($result, TRUE);
    }
}
