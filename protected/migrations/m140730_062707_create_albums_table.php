<?php

class m140730_062707_create_albums_table extends CDbMigration
{
	public function up()
	{
        $this->createTable('albums', array(
            'id' => 'pk',
            'cam_id' => 'integer not null',
            'name' => 'varchar(50) not null'
        ));

        $this->addForeignKey('cam_id', 'albums', 'cam_id', 'camerists', 'user_id', 'cascade', 'cascade');

	}

	public function down()
	{
		$this->dropTable('albums');
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