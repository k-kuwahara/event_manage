<?php
class Migration_Add_dt_answer extends CI_Migration {

    public function __construct()
    {
        parent::__construct();
    }
    public function up()
    {
        $this->dbforge->add_field([
            'answer_id' => [
                'type'           => 'INT',
                'constraint'     => 8,
                'unsigned'       => TRUE,
                'auto_increment' => TRUE,
                'comment'        => '回答ID'
            ],
            'event_id' => [
                'type'       => 'INT',
                'constraint' => 8,
                'unsigned'   => TRUE,
                'comment'    => 'イベントID'
            ],
            'answer_date' => [
                'type' => 'DATETIME',
                'comment'    => '回答日'
            ],
            'answer_name' => [
                'type'       => 'VARCHAR',
                'constraint' => '255',
                'null'       => TRUE,
                'comment'    => '回答者名'
            ],
            'answer' => [
                'type'       => 'TINYINT',
                'constraint' => 3,
                'comment'    => '出欠'
            ],
            'email' => [
                'type'       => 'VARCHAR',
                'constraint' => '255',
                'comment'    => '参加者メールアドレス'
            ],
            'memo' => [
                'type'    => 'text',
                'null'    => TRUE,
                'comment' => '備考'
            ],
        ]);
        $this->dbforge->add_key('answer_id', true);
        $this->dbforge->create_table('dt_answer');
    }

    public function down()
    {
        $this->dbforge->drop_table('dt_answer');
    }
}
