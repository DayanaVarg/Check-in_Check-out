<?php

defined('BASEPATH') OR exit('No direct script acces allowed');

class Migration_create_history extends CI_Migration {

    public function up()
    {
        $this->dbforge->add_field(array(
            'id_his' => array(
                'type' => 'INT',
                'constraint' => 10,
                'unsigned' => TRUE,
                'auto_increment'=> TRUE
            ),
            'date_checkin' => array(
                'type'=>'DATE',
                'null' => FALSE,
            ),
            'time_checkin' => array(
                'type'=>'TIME',
                'null' => FALSE,
            ),
            'date_checkout' => array(
                'type'=>'DATE',
                'null' => TRUE,
            ),
            'time_checkout' => array(
                'type'=>'TIME',
                'null' => TRUE,
            ),
			'reason' => array(
				'type'=>'VARCHAR',
				'constraint'=> '100',
				'null' => TRUE,
			),
            'id_user' => array(
                'type'=>'VARCHAR',
                'constraint'=> 10,
                'unsigned' => TRUE,
            ),

        ));
        $this->dbforge->add_key('id_his', TRUE);
        $this->dbforge->create_table('history');

        // Foreign key
        $this->db->query('ALTER TABLE history ADD CONSTRAINT fk_user_history FOREIGN KEY (id_user) REFERENCES user(identification) ON DELETE CASCADE ON UPDATE CASCADE');
    }

    public function down()
    {
        $this->dbforge->drop_table('history');
    }
}
