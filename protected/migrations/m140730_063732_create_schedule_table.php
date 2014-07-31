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
<<<<<<< HEAD
		$this->dropTable('schedule');
=======
		echo "m140730_063732_create_schedule_table does not support migration down.\n";

<<<<<<< HEAD
>>>>>>> origin/registration
=======
>>>>>>> upstream/registration
>>>>>>> 49e5363532eecd16b6286b685027a78f9730623a
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