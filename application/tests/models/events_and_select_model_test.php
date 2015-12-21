<?php

class Events_and_select_model_test extends TestCase {
    // セットアップ
    public function setUp()
    {
        $this->CI =& get_instance();

        $this->CI->load->model('events_model');
        $this->CI->load->model('select_model');
        $this->CI->load->model('query_model');

        $this->eventsObj = $this->CI->events_model;
        $this->selectObj = $this->CI->select_model;
        $this->queryObj = $this->CI->query_model;
    }

    // 全データを物理削除
    public function test_index() {
        // 全イベントを削除
        $deleteResult = $this->queryObj->physicalDelete('dt_event');
        // 正常終了確認
        $this->assertEquals($deleteResult, TRUE);

        // 登録データ取得
        list($eventResult, $mess) = $this->eventsObj->getEvents();
        // 正常終了確認
        $this->assertEquals(count($eventResult), 0);
        $this->assertEquals($mess, "");
    }

    // データ挿入テスト
    public function test_data_insert() {
        $arrParams = array(
            array(
                'eventTitle' => 'テストイベントタイトル1',
                'eventDate'  => '2015/12/22 19:00',
                'adminEmail' => 'kuwahara@lepra.jp',
            ),
            array(
                'eventTitle' => 'テストイベントタイトル2',
                'eventDate'  => '2015/12/25 20:30',
                'adminEmail' => 'dummy@test.jp',
            ),
            array(
                'eventTitle' => 'テストイベントタイトル3',
                'eventDate'  => '2016/01/04 09:30',
                'adminEmail' => 'hogehoge@test.co.jp',
            )
        );

        foreach ($arrParams as $vals) {
            // 登録実行
            list($result, $mess) = $this->selectObj->registerEvent($vals);
            // 正常終了確認
            $this->assertTrue($result);
            $this->assertEquals($mess, "");
        }

        // 登録データ取得
        list($eventResult, $mess) = $this->eventsObj->getEvents();
        // 正常終了確認
        $this->assertEquals(count($eventResult), 3);
        $this->assertEquals($eventResult[0]['event_title'], 'テストイベントタイトル1');
        $this->assertEquals($eventResult[1]['event_date'], '2015-12-25 20:30:00');
        $this->assertEquals($eventResult[2]['email'], 'hogehoge@test.co.jp');
        $this->assertEquals($mess, "");
    }

    // データ更新テスト
    public function test_data_update() {

    }
}
