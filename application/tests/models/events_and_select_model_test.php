<?php

class Events_and_create_model_test extends TestCase
{
    // セットアップ
    public function setUp()
    {
        $this->CI =& get_instance();

        $this->CI->load->model('events_model');
        $this->CI->load->model('create_model');
        $this->CI->load->model('query_model');

        $this->obj_eevnts = $this->CI->events_model;
        $this->obj_create = $this->CI->create_model;
        $this->obj_query  = $this->CI->query_model;
    }

    // 全データを物理削除
    public function test_index() 
    {
        // 全イベントを削除
        $delete_result = $this->obj_query->physical_delete('dt_event');
        // 正常終了確認
        $this->assertEquals($delete_result, true);

        // 登録データ取得
        list($event_result, $mess) = $this->obj_eevnts->get_events();
        // 正常終了確認
        $this->assertEquals(count($event_result), 0);
        $this->assertEquals($mess, "");
    }

    // データ挿入テスト
    public function test_data_insert() 
    {
        $params = [
            [
                'event_title' => 'テストイベントタイトル1',
                'event_date'  => '2015/12/22 19:00',
                'admin_email' => 'foo@gmail.com',
            ],
            [
                'event_title' => 'テストイベントタイトル2',
                'event_date'  => '2015/12/25 20:30',
                'admin_email' => 'bar@yahoo.co.jp',
            ],
            [
                'event_title' => 'テストイベントタイトル3',
                'event_date'  => '2016/01/04 09:30',
                'admin_email' => 'baz@hotmail.co.jp',
            ]
        ];

        foreach ($params as $vals) {
            // 登録実行
            list($result, $ret_mess) = $this->obj_create->register_event($vals);
            // 正常終了確認
            $this->assertTrue($result);
            $this->assertEquals($ret_mess, "");
        }

        // 登録データ取得
        list($events, $ret_mess) = $this->obj_eevnts->get_events();
        // 正常終了確認
        $this->assertEquals(count($events), 3);
        $this->assertEquals($events[0]['event_title'], 'テストイベントタイトル1');
        $this->assertEquals($events[1]['event_date'], '2015-12-25 20:30:00');
        $this->assertEquals($events[2]['email'], 'baz@hotmail.co.jp');
        $this->assertEquals($ret_mess, "");
    }

    // データ更新テスト
    public function test_data_update() 
    {

    }
}
