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
        $this->queryObj = $this->CI->query_model;
    }

    // 全データの物理削除テスト
    public function test_index() {
        // 全イベントを削除
        $eventDeleteResult = $this->queryObj->physicalDelete('dt_event');
        // 全回答を削除
        $answerDeleteResult = $this->queryObj->physicalDelete('dt_answer');
        // 正常終了確認
        $this->assertTrue($eventDeleteResult);
        $this->assertTrue($answerDeleteResult);

        // 登録データ取得
        $eventGet = $this->queryObj->select(
            'dt_event',
            '*',
            ''
        );
        $eventGetResult = $eventGet->result_array();

        $answerGet = $this->queryObj->select(
            'dt_answer',
            '*',
            ''
        );
        $answerGetResult = $answerGet->result_array();

        // 正常終了確認
        $this->assertEquals(count($eventGetResult), 0);
        $this->assertEquals(count($answerGetResult), 0);
    }


    // データ挿入テスト
    public function test_data_insert() {
        // イベントデータの挿入
        $arrEvents = array(
            array(
                'event_title' => 'テストイベントタイトル1',
                'create_date' => date('Y-m-d H:i:s'),
                'update_date' => date('Y-m-d H:i:s'),
                'event_date'  => '2015/12/22 19:00',
                'email' => 'foo@gmail.com',
                'del_flg'     => 0,
            ),
            array(
                'event_title' => 'テストイベントタイトル2',
                'create_date' => date('Y-m-d H:i:s'),
                'update_date' => date('Y-m-d H:i:s'),
                'event_date'  => '2015/12/25 20:30',
                'email' => 'bar@yahoo.co.jp',
                'del_flg'     => 1,
            ),
            array(
                'event_title' => 'テストイベントタイトル3',
                'create_date' => date('Y-m-d H:i:s'),
                'update_date' => date('Y-m-d H:i:s'),
                'event_date'  => '2016/01/04 09:30',
                'email' => 'baz@hotmail.co.jp',
                'del_flg'     => 0,
            )
        );

        foreach ($arrEvents as $event) {
            // 登録実行
            $result = $this->queryObj->insert('dt_event', $event);
            // 正常終了確認
            $this->assertTrue($result);
        }

        // 登録イベントデータ全件取得
        $eventGet = $this->queryObj->select(
            'dt_event',
            '*',
            ''
        );
        $eventGetResult = $eventGet->result_array();
        // 正常終了確認
        $this->assertEquals(count($eventGetResult), 3);
        $this->assertEquals($eventGetResult[0]['event_title'], 'テストイベントタイトル1');
        $this->assertEquals($eventGetResult[1]['del_flg'], '1');
        $this->assertEquals($eventGetResult[2]['email'], 'baz@hotmail.co.jp');

        // 登録イベントデータ取得(del_flg = 0)
        $eventGet = $this->queryObj->select(
            'dt_event',
            '*',
            array(
                'del_flg' => 0
            )
        );
        $eventGetResult = $eventGet->result_array();
        // 正常終了確認
        $this->assertEquals(count($eventGetResult), 2);
        $this->assertEquals($eventGetResult[0]['event_title'], 'テストイベントタイトル1');
        $this->assertEquals($eventGetResult[1]['email'], 'baz@hotmail.co.jp');


        // 回答データの挿入
        $arrAnswers = array(
            array(
                'event_id'    => $eventGetResult[0]['event_id'],
                'answer_date' => date('Y-m-d H:i:s'),
                'answer'      => 3,
                'answer_name' => 'ほげテスト',
                'email'       => 'hogehoge@gmail.com',
                'memo'        => 'テストメモ１',
            ),
            array(
                'event_id'    => $eventGetResult[0]['event_id'],
                'answer_date' => date('Y-m-d H:i:s'),
                'answer'      => 1,
                'answer_name' => 'ふがテスト',
                'email'       => 'fugafuga@yahoo.co.jp',
                'memo'        => 'テストメモ２',
            ),
            array(
                'event_id'    => $eventGetResult[1]['event_id'],
                'answer_date' => date('Y-m-d H:i:s'),
                'answer'      => 2,
                'answer_name' => 'ぴよテスト',
                'email'       => 'piyopiyo@hotmail.co.jp',
                'memo'        => 'テストメモ３',
            )
        );

        foreach ($arrAnswers as $answer) {
            // 登録実行
            $result = $this->queryObj->insert('dt_answer', $answer);
            // 正常終了確認
            $this->assertTrue($result);
        }

        // 登録回答データ全件取得
        $answerGet = $this->queryObj->select(
            'dt_answer',
            '*',
            ''
        );
        $answerGetResult = $answerGet->result_array();
        // 正常終了確認
        $this->assertEquals(count($answerGetResult), 3);
        $this->assertEquals($answerGetResult[0]['answer_name'], 'ほげテスト');
        $this->assertEquals($answerGetResult[1]['answer'], '1');
        $this->assertEquals($answerGetResult[2]['email'], 'piyopiyo@hotmail.co.jp');
    }


    // データ更新テスト
    public function test_data_update() {
        // 登録イベントデータ全件取得
        $eventGet = $this->queryObj->select(
            'dt_event',
            '*',
            ''
        );
        $eventGetResult = $eventGet->result_array();

        // 登録回答データ全件取得
        $answerGet = $this->queryObj->select(
            'dt_answer',
            '*',
            ''
        );
        $answerGetResult = $answerGet->result_array();

        // イベントデータ更新
        foreach ($eventGetResult as $ekey => $event) {
            $eventUpdateResult = $this->queryObj->update(
                'dt_event',
                array(
                    'event_title' => 'イベントタイトルテストNo'. ($ekey+1),
                    'create_date' => date('Y-m-d H:i:s'),
                    'update_date' => date('Y-m-d H:i:s'),
                    'del_flg'     => 0
                ),
                array(
                    'event_id' => $event['event_id'],
                )
            );
            // 正常終了確認
            $this->assertTrue($eventUpdateResult);
        }
        // 登録イベントデータ全件取得
        $eventGet = $this->queryObj->select(
            'dt_event',
            '*',
            ''
        );
        $eventGetResult = $eventGet->result_array();
        // 正常終了確認
        $this->assertEquals(count($eventGetResult), 3);
        $this->assertEquals($eventGetResult[0]['event_title'], 'イベントタイトルテストNo1');
        $this->assertEquals($eventGetResult[1]['event_title'], 'イベントタイトルテストNo2');
        $this->assertEquals($eventGetResult[2]['event_title'], 'イベントタイトルテストNo3');

        // 回答データ更新
        foreach ($answerGetResult as $akey => $answer) {
            $answerUpdateResult = $this->queryObj->update(
                'dt_answer',
                array(
                    'answer_date' => date('Y-m-d H:i:s'),
                    'answer'      => $akey+1,
                    'memo'        => 'メモテストNo' . ($akey+1),
                ),
                array(
                    'answer_id' => $answer['answer_id'],
                )
            );
            // 正常終了確認
            $this->assertTrue($answerUpdateResult);
        }
        // 登録回答データ全件取得
        $answerGet = $this->queryObj->select(
            'dt_answer',
            '*',
            ''
        );
        $answerGetResult = $answerGet->result_array();
        // 正常終了確認
        $this->assertEquals(count($answerGetResult), 3);
        $this->assertEquals($answerGetResult[0]['answer'], '1');
        $this->assertEquals($answerGetResult[1]['answer'], '2');
        $this->assertEquals($answerGetResult[2]['answer'], '3');
        $this->assertEquals($answerGetResult[0]['memo'], 'メモテストNo1');
        $this->assertEquals($answerGetResult[1]['memo'], 'メモテストNo2');
        $this->assertEquals($answerGetResult[2]['memo'], 'メモテストNo3');
    }

    // イベントデータ論理削除（回答にはdel_flgが存在しないため対象外）
    public function test_logicalDelete() {
        // 登録イベントデータ取得(del_flg=0)
        $eventGet = $this->queryObj->select(
            'dt_event',
            '*',
            array(
                'del_flg' => 0
            )
        );
        $eventGetResult = $eventGet->result_array();
        $eventId = $eventGetResult[0]['event_id'];

        // イベント論理削除
        $result = $this->queryObj->logicalDelete(
            'dt_event',
            array(
                'event_id' => $eventId,
            )
        );
        // 正常終了確認
        $this->assertTrue($result);

        // 論理削除したイベントデータを再度取得
        $eventGetOne = $this->queryObj->select(
            'dt_event',
            '*',
            array(
                'event_id' => $eventId
            )
        );
        $eventGetResultOne = $eventGetOne->result_array();
        // 正常終了確認
        $this->assertEquals($eventGetResultOne[0]['del_flg'], '1');

        // 全件論理削除
        $result = $this->queryObj->logicalDelete('dt_event', '');
        // 正常終了確認
        $this->assertTrue($result);

        // 登録イベントデータ全件取得
        $eventGet = $this->queryObj->select(
            'dt_event',
            '*',
            array(
                'del_flg' => 1
            )
        );
        $eventGetResult = $eventGet->result_array();
        // 正常終了確認
        $this->assertEquals(count($eventGetResult), 3);
    }

// テストデータを全件削除したい方は以下のコメントアウトを外してください。
/*
    // 全データの物理削除テスト
    public function test_alldelete() {
        // 全イベントを削除
        $eventDeleteResult = $this->queryObj->physicalDelete('dt_event');
        // 全回答を削除
        $answerDeleteResult = $this->queryObj->physicalDelete('dt_answer');
        // 正常終了確認
        $this->assertTrue($eventDeleteResult);
        $this->assertTrue($answerDeleteResult);

        // 登録データ取得
        $eventGet = $this->queryObj->select(
            'dt_event',
            '*',
            ''
        );
        $eventGetResult = $eventGet->result_array();

        $answerGet = $this->queryObj->select(
            'dt_answer',
            '*',
            ''
        );
        $answerGetResult = $answerGet->result_array();

        // 正常終了確認
        $this->assertEquals(count($eventGetResult), 0);
        $this->assertEquals(count($answerGetResult), 0);
    }
*/
}
