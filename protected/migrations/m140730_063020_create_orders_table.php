<?php

class m140730_063020_create_orders_table extends CDbMigration
{
	public function up()
	{
        $this->createTable('orders', array(
            'id' => 'pk',
            'cam_id' => 'integer not null',
            'user_id' => 'integer not null',
            'price' => 'integer not null',
            'accepted' => 'boolean default null',
            'status' => 'varchar(50) default "Unclosed"',
            'date' => 'timestamp'
        ));

        $this->addForeignKey('fk_cam', 'orders', 'cam_id', 'camerists', 'user_id', 'cascade', 'cascade');
        $this->addForeignKey('fk_usr', 'orders', 'user_id', 'users', 'id');

    }

	public function down()
	{

        $this->dropTable('orders');
    }
}