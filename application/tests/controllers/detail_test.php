<?php
class detail_test extends TestCase {
   public function test_index() {
      $output = $this->request('GET', 'detail', ['id' => '1']);
      $this->assertNull($output);
   }

   // 存在しないメソッドテスト
   public function test_nonmethod() {
      $this->request('GET', ['detail', 'hoge']);
      $this->assertResponseCode(404);
   }

   // クエリなしテスト
   public function test_noquery() {
      $output = $this->request('GET', 'detail');
      $this->assertContains('不正なアクセスです。', $output);
   }
}