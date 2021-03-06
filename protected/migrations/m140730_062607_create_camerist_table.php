<?php

class m140730_062607_create_camerist_table extends CDbMigration
{
	public function up()
	{
        $this->createTable('camerists', array(
            'user_id' => 'pk',
            'rate' => 'decimal(2,1) default 3'
         ));

        $this->addForeignKey('fk_user', 'camerists', 'user_id', 'users', 'id','cascade','cascade');
	}

	public function down()
	{
		$this->dropTable('camerists');
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