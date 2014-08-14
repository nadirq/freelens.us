<?php

class m140730_060213_create_users_table extends CDbMigration
{
	public function up()
	{
        $this->createTable('users', array(
            'id' => 'pk',
            'login' => 'varchar(30) not null',
            'avatar' => 'varchar(50) default "images/noavatar.jpg"',
            'pass' => 'varchar(100) not null',
            'email' => 'varchar(50) not null',
            'tel' => 'varchar(20)',
            'fio' => 'varchar(50) not null',
            'activation' => 'varchar(32) NOT NULL',
            'about' => 'text',
            'reg_date' => 'timestamp',
            'last_login' => 'timestamp',
            'role' => 'varchar(30) default "user"',
            'lat' => 'varchar(40)',
            'lon' => 'varchar(40)'
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