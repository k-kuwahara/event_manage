<?php
class join_test extends TestCase {
   public function test_index() {
      // 存在しないイベントID
      $arrGetNg = [
         'a_id' => NULL,
         'e_id' => '999'
      ];
      $output = $this->request('GET', ['join', 'index'], $arrGetNg);
      $this->assertNull($output);
   }

   // 存在しないメソッドテスト
   public function test_nonMethod() {
      $this->request('GET', ['join', 'hoge']);
      $this->assertResponseCode(404);
   }

   // イベントIDなしテスト
   public function test_noQuery() {
      $arrGet = array(
         'a_id' => NULL,
      );
      $output = $this->request('GET', ['join', 'index'], $arrGet);
      $this->assertContains('不正なアクセスです。', $output);
   }
}
