<?php

use yii\db\Schema;

class m160605_064325_movie extends CDbMigration
{
	public function up()
	{
		 $this->createTable('movie', array(
            'id' => 'integer',
            'title' => 'text',
            'original_title' => 'text',
            'release_date' => 'text',
            'runtime' => 'integer',
            'overview' => 'text',
            'genres' => 'text',
            'poster_path' => 'text',
            'PRIMARY KEY (`id`)'
        ));
	}

	public function down()
	{
		echo "m160605_064325_movie does not support migration down.\n";
		return false;
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