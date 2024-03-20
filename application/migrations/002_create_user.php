<?php

defined('BASEPATH') OR exit('No direct script acces allowed');

class Migration_create_user extends CI_Migration {

    public function up()
    {
        $this->dbforge->add_field(array(
            'identification' => array(
                'type' => 'VARCHAR',
                'constraint' => '10',
                'unsigned' => TRUE,
            ),
            'name' => array(
                'type'=>'VARCHAR',
                'constraint'=> '20',
                'null' => FALSE,
            ),
            'lastname' => array(
                'type'=>'VARCHAR',
                'constraint'=> '20',
                'null' => FALSE,
            ),
            'gender' => array(
                'type'=>'VARCHAR',
                'constraint'=> '10',
                'null' => FALSE,
            ),
            'phone' => array(
                'type'=>'VARCHAR',
                'constraint'=> '10',
                'null' => FALSE,
            ),
            'rh' => array(
                'type'=>'CHAR',
                'constraint'=> '3',
                'null' => FALSE,
            ),
            'password' => array(
                'type'=>'VARCHAR',
                'constraint'=> '255',
                'null' => TRUE,
            ),
            'photo' => array(
                'type'=>'VARCHAR',
                'constraint'=> '220',
                'null' => TRUE,
            ),
            'state' => array(
                'type'=>'BOOLEAN',
                'null' => FALSE,
            ),
            'id_Role' => array(
                'type'=>'INT',
                'constraint'=> 10,
                'unsigned' => TRUE,
            ),

        ));
        $this->dbforge->add_key('identification', TRUE);
        $this->dbforge->create_table('user');

        // Foreign key
        $this->db->query('ALTER TABLE user ADD CONSTRAINT fk_user_role FOREIGN KEY (id_Role) REFERENCES role(id_Role) ON DELETE CASCADE ON UPDATE CASCADE');
    }

    public function down()
    {
        $this->dbforge->drop_table('user');
    }
}
