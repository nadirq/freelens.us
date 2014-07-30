<?php

class m140730_060213_create_users_table extends CDbMigration
{
	public function up()
	{
        $this->createTable('users', array(
            'id' => 'pk',
            'login' => 'varchar(30) not null',
            'pass' => 'varchar(100) not null',
            'email' => 'varchar(50) not null',
            'role' => 'varchar(30) not null'
        ));
	}

	public function down()
	{
		$this->dropTable('users');
	}

	/*
	// Use safeUp/safeDown to do migration with transaction
	public function safeUp()
	{
	}

	public function safeDown()
	{
	}
	*/
}