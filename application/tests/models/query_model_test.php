<?php

/**
 * DBへのデータ挿入、更新、論理削除、物理削除のテスト
 * データ抽出は必ず使用するため明示的には記載しない
 **/
class Query_model_test extends TestCase {
    // セットアップ
    public function setUp()
    {
        $this->CI =& get_instance();
        $this->CI->load->model('query_model');
        $this->obj_query = $this->CI->query_model;
    }

    // 全データの物理削除テスト
    public function test_index() {
        // 全イベントを削除
        $event_delete_result = $this->obj_query->physical_delete('dt_event');
        // 全回答を削除
        $answer_delete_result = $this->obj_query->physical_delete('dt_answer');
        // 正常終了確認
        $this->assertTrue($event_delete_result);
        $this->assertTrue($answer_delete_result);

        // 登録データ取得
        $tmp = $this->obj_query->select(
            'dt_event',
            '*',
            ''
        );
        $events = $tmp->result_array();

        $tmp = $this->obj_query->select(
            'dt_answer',
            '*',
            ''
        );
        $answers = $tmp->result_array();

        // 正常終了確認
        $this->assertEquals(count($events), 0);
        $this->assertEquals(count($answers), 0);
    }


    // データ挿入テスト
    public function test_data_insert() {
        // イベントデータの挿入
        $test_events = [
            [
                'event_title' => 'テストイベントタイトル1',
                'create_date' => date('Y-m-d H:i:s'),
                'update_date' => date('Y-m-d H:i:s'),
                'event_date'  => '2015/12/22 19:00',
                'email'       => 'foo@gmail.com',
                'del_flg'     => 0,
            ],
            [
                'event_title' => 'テストイベントタイトル2',
                'create_date' => date('Y-m-d H:i:s'),
                'update_date' => date('Y-m-d H:i:s'),
                'event_date'  => '2015/12/25 20:30',
                'email'       => 'bar@yahoo.co.jp',
                'del_flg'     => 1,
            ],
            [
                'event_title' => 'テストイベントタイトル3',
                'create_date' => date('Y-m-d H:i:s'),
                'update_date' => date('Y-m-d H:i:s'),
                'event_date'  => '2016/01/04 09:30',
                'email'       => 'baz@hotmail.co.jp',
                'del_flg'     => 0,
            ]
        ];

        foreach ($test_events as $event) {
            // 登録実行
            $result = $this->obj_query->insert('dt_event', $event);
            // 正常終了確認
            $this->assertTrue($result);
        }

        // 登録イベントデータ全件取得
        $tmp = $this->obj_query->select(
            'dt_event',
            '*',
            ''
        );
        $events = $tmp->result_array();
        // 正常終了確認
        $this->assertEquals(count($events), 3);
        $this->assertEquals($events[0]['event_title'], 'テストイベントタイトル1');
        $this->assertEquals($events[1]['del_flg'], '1');
        $this->assertEquals($events[2]['email'], 'baz@hotmail.co.jp');

        // 登録イベントデータ取得(del_flg = 0)
        $tmp = $this->obj_query->select(
            'dt_event',
            '*',
            [
                'del_flg' => 0
            ]
        );
        $events = $tmp->result_array();
        // 正常終了確認
        $this->assertEquals(count($events), 2);
        $this->assertEquals($events[0]['event_title'], 'テストイベントタイトル1');
        $this->assertEquals($events[1]['email'], 'baz@hotmail.co.jp');


        // 回答データの挿入
        $answers = [
            [
                'event_id'    => $events[0]['event_id'],
                'answer_date' => date('Y-m-d H:i:s'),
                'answer'      => 3,
                'answer_name' => 'ほげテスト',
                'email'       => 'hogehoge@gmail.com',
                'memo'        => 'テストメモ１',
            ],
            [
                'event_id'    => $events[0]['event_id'],
                'answer_date' => date('Y-m-d H:i:s'),
                'answer'      => 1,
                'answer_name' => 'ふがテスト',
                'email'       => 'fugafuga@yahoo.co.jp',
                'memo'        => 'テストメモ２',
            ],
            [
                'event_id'    => $events[1]['event_id'],
                'answer_date' => date('Y-m-d H:i:s'),
                'answer'      => 2,
                'answer_name' => 'ぴよテスト',
                'email'       => 'piyopiyo@hotmail.co.jp',
                'memo'        => 'テストメモ３',
            ]
        ];

        foreach ($answers as $answer) {
            // 登録実行
            $result = $this->obj_query->insert('dt_answer', $answer);
            // 正常終了確認
            $this->assertTrue($result);
        }

        // 登録回答データ全件取得
        $tmp = $this->obj_query->select(
            'dt_answer',
            '*',
            ''
        );
        $answers = $tmp->result_array();
        // 正常終了確認
        $this->assertEquals(count($answers), 3);
        $this->assertEquals($answers[0]['answer_name'], 'ほげテスト');
        $this->assertEquals($answers[1]['answer'], '1');
        $this->assertEquals($answers[2]['email'], 'piyopiyo@hotmail.co.jp');
    }


    // データ更新テスト
    public function test_data_update() {
        // 登録イベントデータ全件取得
        $tmp = $this->obj_query->select(
            'dt_event',
            '*',
            ''
        );
        $events = $tmp->result_array();

        // 登録回答データ全件取得
        $tmp = $this->obj_query->select(
            'dt_answer',
            '*',
            ''
        );
        $answers = $tmp->result_array();

        // イベントデータ更新
        foreach ($events as $e_key => $event) {
            $event_update_result = $this->obj_query->update(
                'dt_event',
                [
                    'event_title' => 'イベントタイトルテストNo'. ($e_key+1),
                    'create_date' => date('Y-m-d H:i:s'),
                    'update_date' => date('Y-m-d H:i:s'),
                    'del_flg'     => 0
                ],
                [
                    'event_id' => $event['event_id'],
                ]
            );
            // 正常終了確認
            $this->assertTrue($event_update_result);
        }
        // 登録イベントデータ全件取得
        $tmp = $this->obj_query->select(
            'dt_event',
            '*',
            ''
        );
        $events = $tmp->result_array();
        // 正常終了確認
        $this->assertEquals(count($events), 3);
        $this->assertEquals($events[0]['event_title'], 'イベントタイトルテストNo1');
        $this->assertEquals($events[1]['event_title'], 'イベントタイトルテストNo2');
        $this->assertEquals($events[2]['event_title'], 'イベントタイトルテストNo3');

        // 回答データ更新
        foreach ($answers as $a_key => $answer) {
            $answer_update_result = $this->obj_query->update(
                'dt_answer',
                [
                    'answer_date' => date('Y-m-d H:i:s'),
                    'answer'      => $a_key+1,
                    'memo'        => 'メモテストNo' . ($a_key+1),
                ],
                [
                    'answer_id' => $answer['answer_id'],
                ]
            );
            // 正常終了確認
            $this->assertTrue($answer_update_result);
        }
        // 登録回答データ全件取得
        $tmp = $this->obj_query->select(
            'dt_answer',
            '*',
            ''
        );
        $answers = $tmp->result_array();
        // 正常終了確認
        $this->assertEquals(count($answers), 3);
        $this->assertEquals($answers[0]['answer'], '1');
        $this->assertEquals($answers[1]['answer'], '2');
        $this->assertEquals($answers[2]['answer'], '3');
        $this->assertEquals($answers[0]['memo'], 'メモテストNo1');
        $this->assertEquals($answers[1]['memo'], 'メモテストNo2');
        $this->assertEquals($answers[2]['memo'], 'メモテストNo3');
    }

    // イベントデータ論理削除（回答にはdel_flgが存在しないため対象外）
    public function test_logical_delete() {
        // 登録イベントデータ取得(del_flg=0)
        $tmp = $this->obj_query->select(
            'dt_event',
            '*',
            [
                'del_flg' => 0
            ]
        );
        $events = $tmp->result_array();
        $event_id = $events[0]['event_id'];

        // イベント論理削除
        $result = $this->obj_query->logical_delete(
            'dt_event',
            [
                'event_id' => $event_id,
            ]
        );
        // 正常終了確認
        $this->assertTrue($result);

        // 論理削除したイベントデータを再度取得
        $tmp = $this->obj_query->select(
            'dt_event',
            '*',
            [
                'event_id' => $event_id
            ]
        );
        $one_event = $tmp->result_array();
        // 正常終了確認
        $this->assertEquals($one_event[0]['del_flg'], '1');

        // 全件論理削除
        $result = $this->obj_query->logical_delete('dt_event', '');
        // 正常終了確認
        $this->assertTrue($result);

        // 登録イベントデータ全件取得
        $tmp = $this->obj_query->select(
            'dt_event',
            '*',
            [
                'del_flg' => 1
            ]
        );
        $events = $tmp->result_array();
        // 正常終了確認
        $this->assertEquals(count($events), 3);
    }

// テストデータを全件削除したい方は以下のコメントアウトを外してください。
/*
    // 全データの物理削除テスト
    public function test_alldelete() {
        // 全イベントを削除
        $event_delete_result = $this->obj_query->physical_delete('dt_event');
        // 全回答を削除
        $answer_delete_result = $this->obj_query->physical_delete('dt_answer');
        // 正常終了確認
        $this->assertTrue($event_delete_result);
        $this->assertTrue($answer_delete_result);

        // 登録データ取得
        $tmp = $this->obj_query->select(
            'dt_event',
            '*',
            ''
        );
        $events = $tmp->result_array();

        $tmp = $this->obj_query->select(
            'dt_answer',
            '*',
            ''
        );
        $answers = $tmp->result_array();

        // 正常終了確認
        $this->assertEquals(count($events), 0);
        $this->assertEquals(count($answers), 0);
    }
*/
}
