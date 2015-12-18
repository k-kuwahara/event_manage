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
            ),
            'event_id' => array(
                'type'       => 'INT',
                'constraint' => 8,
                'unsigned'   => TRUE,
            ),
            'answer_date' => array(
                'type' => 'DATETIME',
            ),
            'answer_name' => array(
                'type'       => 'VARCHAR',
                'constraint' => '255',
                'null'       => TRUE,
            ),
            'answer' => array(
                'type'       => 'TINYINT',
                'constraint' => 3,
            ),
            'email' => array(
                'type' => 'VARCHAR',
                'constraint' => '255',
            ),
            'memo' => array(
                'type'  => 'text',
                'null'  => TRUE,
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