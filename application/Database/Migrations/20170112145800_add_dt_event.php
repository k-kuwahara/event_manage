<?php
class Migration_Add_dt_event extends \CodeIgniter\Database\Migration {
	public function up()
	{
		$this->forge->addField([
			'event_id' => [
				'type'		   => 'INT',
				'constraint'	 => 8,
				'unsigned'	   => TRUE,
				'auto_increment' => TRUE,
				'comment'		=> 'イベントID'
			],
			'event_title' => [
				'type'	   => 'VARCHAR',
				'constraint' => '255',
				'comment'	=> 'イベントタイトル'
			],
			'create_date' => [
				'type'	   => 'DATETIME',
				'null'	   => TRUE,
				'comment'	=> '作成日'
			],
			'update_date' => [
				'type'	   => 'DATETIME',
				'comment'	=> '更新日'
			],
			'event_date' => [
				'type'	   => 'DATETIME',
				'comment'	=> 'イベント日'
			],
			'email' => [
				'type'	   => 'VARCHAR',
				'constraint' => '255',
				'comment'	=> '作成者メールアドレス'
			],
			'del_flg' => [
				'type'	   => 'TINYINT',
				'constraint' => '3',
				'default'	=> 0,
				'unsigned'   => TRUE,
				'null'	   => TRUE,
				'comment'	=> '削除フラグ'
			],
		]);
		$this->forge->addKey('event_id', true);
		$this->forge->createTable('dt_event');
	}

	public function down()
	{
		$this->forge->dropTable('dt_event');
	}
}
