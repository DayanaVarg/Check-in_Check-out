<?php

defined('BASEPATH') OR exit('No direct script acces allowed');

class Migration_create_role extends CI_Migration {

    public function up()
    {
        /*  ADMIN 1
            VISITOR 2
            EMPLOYEE 3
        */
        $this->dbforge->add_field(array(
            'id_Role' => array(
                'type' => 'INT',
                'constraint' => 10,
                'unsigned' => TRUE,
                'auto_increment'=> TRUE
            ),
            'nameR' => array(
                'type'=>'VARCHAR',
                'constraint'=> '20',
                'null' => FALSE,
            )
        ));
        $this->dbforge->add_key('id_Role', TRUE);
        $this->dbforge->create_table('role');
    }

    public function down()
    {
        $this->dbforge->drop_table('role');
    }
}

