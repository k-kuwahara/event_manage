<?php
class Migration_Add_dt_answer extends \CodeIgniter\Database\Migration {
	public function up()
	{
		$this->forge->addField([
			'answer_id' => [
				'type'		   => 'INT',
				'constraint'	 => 8,
				'unsigned'	   => TRUE,
				'auto_increment' => TRUE,
				'comment'		=> '回答ID'
			],
			'event_id' => [
				'type'	   => 'INT',
				'constraint' => 8,
				'unsigned'   => TRUE,
				'comment'	=> 'イベントID'
			],
			'answer_date' => [
				'type' => 'DATETIME',
				'comment'	=> '回答日'
			],
			'answer_name' => [
				'type'	   => 'VARCHAR',
				'constraint' => '255',
				'null'	   => TRUE,
				'comment'	=> '回答者名'
			],
			'answer' => [
				'type'	   => 'TINYINT',
				'constraint' => 3,
				'comment'	=> '出欠'
			],
			'email' => [
				'type'	   => 'VARCHAR',
				'constraint' => '255',
				'comment'	=> '参加者メールアドレス'
			],
			'memo' => [
				'type'	=> 'text',
				'null'	=> TRUE,
				'comment' => '備考'
			],
		]);
		$this->forge->addKey('answer_id', true);
		$this->forge->createTable('dt_answer');
	}

	public function down()
	{
		$this->forge->dropTable('dt_answer');
	}
}
