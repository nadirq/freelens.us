<?php

class m140730_063803_create_rating_table extends CDbMigration
{
	public function up()
	{
        $this->createTable('rating', array(
            'cam_id' => 'integer not null',
            'user_id' => 'integer not null',
            'rate' => 'decimal(2,1) not null'
        ));

        $this->addForeignKey('fk_cam_rate', 'rating', 'cam_id', 'camerists', 'user_id', 'cascade', 'cascade');
        $this->addForeignKey('fk_user_rate', 'rating', 'user_id', 'users', 'id', 'cascade', 'cascade');
	}

	public function down()
	{
	    $this->dropTable('rating');
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