<?php

class m140730_063732_create_schedule_table extends CDbMigration
{
	public function up()
	{
        $this->createTable('schedule', array(
            'cam_id' => 'integer',
            'start_date' => 'timestamp',
            'end_date' => 'timestamp',
            'price' => 'int',
            'desc' => 'text'
        ));

        $this->addForeignKey('fk_cam_id', 'schedule', 'cam_id', 'camerists', 'user_id', 'cascade', 'cascade');
    }

	public function down()
	{
		$this->dropTable('schedule');
	}

}