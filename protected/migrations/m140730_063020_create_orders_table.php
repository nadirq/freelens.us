<?php

class m140730_063020_create_orders_table extends CDbMigration
{
	public function up()
	{
        $this->createTable('orders', array(
            'cam_id' => 'integer not null',
            'user_id' => 'integer not null',
            'price' => 'integer not null',
            'date' => 'timestamp'
        ));

        $this->addForeignKey('fk_cam', 'orders', 'cam_id', 'camerists', 'user_id', 'cascade', 'cascade');
        $this->addForeignKey('fk_usr', 'orders', 'user_id', 'users', 'id');

    }

	public function down()
	{
<<<<<<< HEAD
		$this->dropTable('orders');
=======
		echo "m140730_063020_create_orders_table does not support migration down.\n";

>>>>>>> origin/registration
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