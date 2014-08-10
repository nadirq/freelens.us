<?php

class m140809_184209_create_placemark_photos_table extends CDbMigration
{
	public function up()
	{
        $this->createTable('placemark_photos', array(
            'placemark_id' => 'integer not null',
            'photo_id' => 'integer not null'
        ));

        $this->addForeignKey('fk_placemark', 'placemark_photos', 'placemark_id', 'map', 'id', 'cascade', 'cascade');
        $this->addForeignKey('fk_photo', 'placemark_photos', 'photo_id', 'photos', 'id');
	}

	public function down()
	{
		$this->dropTable('placemark_photos');
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