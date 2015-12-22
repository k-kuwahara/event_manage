<?php
class select_test extends TestCase {

   public function test_index() {
     $output = $this->request('GET', ['select', 'index']);
     $this->assertNull($output);
   }

   // 存在しないメソッドテスト
   public function test_nonMethod() {
     $this->request('GET', ['select', 'hoge']);
     $this->assertResponseCode(404);
   }

   // クエリなしテスト
   public function test_checkValidate() {
     // 正常系
     $arrPostOk = [
       'eventTitle' => 'テストイベントタイトル1',
       'adminEmail' => 'foo@gmail.com',
       'eventDate'  => '2015/12/22 19:00',
     ];
     $result = $this->request('POST', ['select', 'index'], $arrPostOk);
     // 正常終了テスト
     $this->assertNull($result);

     // 異常系
     $arrPostNg = [
       'eventTitle' => '',
       'adminEmail' => 'ダミー',
       'eventDate'  => '2015/11/31 99:00',
     ];
     $result = $this->request('POST', ['select', 'index'], $arrPostNg);
     // 正常終了テスト
     $this->assertNull($result);
   }
}

