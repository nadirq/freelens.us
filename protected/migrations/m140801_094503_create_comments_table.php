<?php

class m140801_094503_create_comments_table extends CDbMigration
{
	public function up()
	{
        $this->createTable('comments', array(
            'id' => 'pk',
            'user_id' => 'integer not null',
            'cam_id' => 'integer not null',
            'message' => 'text not null',
            'created_at' => 'timestamp',
        ));
        $this->addForeignKey('usr_fk', 'comments', 'user_id', 'users', 'id', 'cascade', 'cascade');
        $this->addForeignKey('cmr_fk', 'comments', 'cam_id', 'camerists', 'user_id', 'cascade', 'cascade');
	}

	public function down()
	{
        $this->dropTable('comments');
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