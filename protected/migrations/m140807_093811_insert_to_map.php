<?php

class m140807_093811_insert_to_map extends CDbMigration
{
	public function up()
	{
        $this->insert('map',array('stylePlacemark' => 'islands#greenDotIcon', 'balloonText' => 'textt', 'lat' => '54.954', 'lon' => '82.99'));
        $this->insert('map',array('stylePlacemark' => 'islands#redDotIcon', 'balloonText' => 'textt', 'lat' => '55.052', 'lon' => '83'));
        $this->insert('map',array('stylePlacemark' => 'islands#greenIcon', 'balloonText' => 'textt', 'lat' => '55.003', 'lon' => '82.997'));
        $this->insert('map',array('stylePlacemark' => 'islands#dotIcon', 'balloonText' => 'textt', 'lat' => '55.004', 'lon' => '83.001'));
	}

	public function down()
	{

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