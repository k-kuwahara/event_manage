<?php
class Migration_Add_dt_answer extends CI_Migration {

    public function __construct()
    {
        parent::__construct();
    }
    public function up()
    {
        $this->dbforge->add_field(array(
            'answer_id' => array(
                'type'           => 'INT',
                'constraint'     => 8,
                'unsigned'       => TRUE,
                'auto_increment' => TRUE,
                'comment'        => '回答ID'
            ),
            'event_id' => array(
                'type'       => 'INT',
                'constraint' => 8,
                'unsigned'   => TRUE,
                'comment'    => 'イベントID'
            ),
            'answer_date' => array(
                'type' => 'DATETIME',
                'comment'    => '回答日'
            ),
            'answer_name' => array(
                'type'       => 'VARCHAR',
                'constraint' => '255',
                'null'       => TRUE,
                'comment'    => '回答者名'
            ),
            'answer' => array(
                'type'       => 'TINYINT',
                'constraint' => 3,
                'comment'    => '出欠'
            ),
            'email' => array(
                'type'       => 'VARCHAR',
                'constraint' => '255',
                'comment'    => '参加者メールアドレス'
            ),
            'memo' => array(
                'type'    => 'text',
                'null'    => TRUE,
                'comment' => '備考'
            ),
        ));
        $this->dbforge->add_key('answer_id', true);
        $this->dbforge->create_table('dt_answer');
    }

    public function down()
    {
        $this->dbforge->drop_table('dt_answer');
    }
}