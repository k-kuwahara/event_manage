<?php
class Migration_Add_dt_event extends CI_Migration {

    public function __construct()
    {
        parent::__construct();
    }
    public function up()
    {
        $this->dbforge->add_field(array(
            'event_id' => array(
                'type'           => 'INT',
                'constraint'     => 8,
                'unsigned'       => TRUE,
                'auto_increment' => TRUE
                'comment'        => 'イベントID'
            ),
            'event_title' => array(
                'type'       => 'VARCHAR',
                'constraint' => '255',
                'comment'    => 'イベントタイトル'
            ),
            'create_date' => array(
                'type'       => 'DATETIME',
                'null'       => TRUE,
                'comment'    => '作成日'
            ),
            'update_date' => array(
                'type'       => 'DATETIME',
                'comment'    => '更新日'
            ),
            'event_date' => array(
                'type'       => 'DATETIME',
                'comment'    => 'イベント日'
            ),
            'email' => array(
                'type'       => 'VARCHAR',
                'constraint' => '255',
                'comment'    => '作成者メールアドレス'
            ),
            'del_flg' => array(
                'type'       => 'TINYINT',
                'constraint' => '3',
                'default'    => 0,
                'unsigned'   => TRUE,
                'null'       => TRUE,
                'comment'    => '削除フラグ'
            ),
        ));
        $this->dbforge->add_key('event_id', true);
        $this->dbforge->create_table('dt_event');
    }

    public function down()
    {
        $this->dbforge->drop_table('dt_event');
    }
}