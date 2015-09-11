<?php

use yii\db\Schema;
use yii\db\Migration;

class m150910_115628_posts extends Migration
{
    public function safeUp()
    {
		$tableOptions = null;
		if ($this->db->driverName === 'mysql') {
			// http://stackoverflow.com/questions/766809/whats-the-difference-between-utf8-general-ci-and-utf8-unicode-ci
			$tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
		}

		$this->createTable('{{%posts}}', [
			'id' => Schema::TYPE_PK,
			'title' => Schema::TYPE_STRING . ' NOT NULL',
            'slug' => Schema::TYPE_STRING . ' NOT NULL',
			'short' => Schema::TYPE_TEXT,
			'text' => Schema::TYPE_TEXT,
            'date' => Schema::TYPE_DATE,
            'published' => Schema::TYPE_BOOLEAN,
			'created_by' => Schema::TYPE_INTEGER,
			'updated_by' => Schema::TYPE_INTEGER,
			'created_at' => Schema::TYPE_INTEGER . ' NOT NULL',
			'updated_at' => Schema::TYPE_INTEGER . ' NOT NULL',
		], $tableOptions);
		$this->addForeignKey('fk_posts_user_created', '{{%posts}}', 'created_by', '{{%user}}', 'id', 'CASCADE', 'SET NULL');
		$this->addForeignKey('fk_posts_user_updated', '{{%posts}}', 'updated_by', '{{%user}}', 'id', 'CASCADE', 'SET NULL');
    }

    public function safeDown()
    {
        $this->dropTable('{{%posts}}');
    }
}
