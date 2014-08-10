<?php

class m140807_093811_insert_to_map extends CDbMigration
{
	public function up()
	{
        $this->insert('map',array('cam_id'=> '1', 'name' => 'Place 1', 'stylePlacemark' => 'islands#orangeIcon', 'balloonText' => 'sometext', 'lat' => '54.954', 'lon' => '82.99'));
        $this->insert('map',array('cam_id'=> '1', 'name' => 'Place 2', 'stylePlacemark' => 'islands#orangeIcon', 'balloonText' => '<p style="color:#4f0500">red, motherfuckers</p>', 'lat' => '55.052', 'lon' => '83'));
        $this->insert('map',array('cam_id'=> '2', 'name' => 'Place 3', 'stylePlacemark' => 'islands#orangeIcon', 'balloonText' => 'text', 'lat' => '55.003', 'lon' => '82.997'));
        $this->insert('map',array('cam_id'=> '2', 'name' => 'Place 4', 'stylePlacemark' => 'islands#orangeIcon', 'balloonText' => '<h1>it is just for fun</h1>', 'lat' => '55.004', 'lon' => '83.001'));
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