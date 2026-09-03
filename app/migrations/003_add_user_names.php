<?php

class Add_user_names {

    private $_lava;

    public function __construct()
    {
        $this->_lava = lava_instance();
        $this->_lava->call->dbforge();
    }

    public function up()
    {
        if (!$this->_lava->dbforge->table_exists('users')) {
            return;
        }

        $this->_lava->dbforge->add_column('users', [
            'firstname' => [
                'type'       => 'VARCHAR',
                'constraint' => 100,
                'null'       => FALSE,
                'default'    => '',
            ],
        ]);

        $this->_lava->dbforge->add_column('users', [
            'lastname' => [
                'type'       => 'VARCHAR',
                'constraint' => 100,
                'null'       => FALSE,
                'default'    => '',
            ],
        ]);
    }

    public function down()
    {
        // Existing records should be preserved during rollback.
    }
}