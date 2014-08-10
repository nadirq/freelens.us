<?php

class m140730_062839_create_photos_table extends CDbMigration
{
	public function up()
	{
        $this->createTable('photos', array(
            'id' => 'pk',
            'path' => 'varchar(100) default "/images/"',
            'desc' => 'varchar(300)',
            'published' => 'integer default "1"',
            'album_id' => 'integer not null'
        ));

        $this->addForeignKey('fk_album', 'photos', 'album_id', 'albums', 'id', 'cascade', 'cascade');
    }

	public function down()
	{
		$this->dropTable('photos');
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