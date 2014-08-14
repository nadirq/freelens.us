<?php

class m140806_091958_create_map_table extends CDbMigration
{
	public function up()
	{
        $this->createTable('map', array(
            'id' => 'pk',
            'cam_id' => 'integer',
            'name' => 'varchar(150)',
            'balloonText' => 'varchar(1000)',    //содержимое балуна (может содеражть html)
            'stylePlacemark' => 'varchar(255) default "islands#nightDotIcon" ', //стиль метки
            'lat' => 'varchar(255)',   //широта
            'lon' => 'varchar(255)'    //долгота
        ));
    }

	public function down()
	{
		$this->dropTable('map');
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