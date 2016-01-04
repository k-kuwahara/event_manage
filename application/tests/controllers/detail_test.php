<?php
class detail_test extends TestCase {
   public function test_index() {
      $arrGet = array(
         'id' => '1'
      );
      $output = $this->request('GET', 'detail', $arrGet);
      $this->assertNull($output);
   }

   // 存在しないメソッドテスト
   public function test_nonMethod() {
      $this->request('GET', ['detail', 'hoge']);
      $this->assertResponseCode(404);
   }

   // クエリなしテスト
   public function test_noQuery() {
      $output = $this->request('GET', 'detail');
      $this->assertContains('不正なアクセスです。', $output);
   }
}