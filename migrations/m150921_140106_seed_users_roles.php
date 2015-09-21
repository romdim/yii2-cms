<?php

use yii\db\Schema;
use yii\db\Migration;

class m150921_140106_seed_users_roles extends Migration
{
    public function safeUp()
    {
        // Create 1 admin and 1 editor, 1 editor role (admin's role is predefined in config/web.php) and assign this role to both of them.
        $this->insert('{{%user}}', [
            'id' => 1,
            'username' => 'admin',
            'email' => 'admin@admin.com',
            'password_hash' => Yii::$app->getSecurity()->generatePasswordHash('admin'),
            'auth_key' => Yii::$app->getSecurity()->generateRandomString(),
            'confirmed_at' => time(),
            'created_at' => time(),
            'updated_at' => time()
        ]);
        $this->insert('{{%user}}', [
            'id' => 2,
            'username' => 'editor',
            'email' => 'editor@editor.com',
            'password_hash' => Yii::$app->getSecurity()->generatePasswordHash('editor'),
            'auth_key' => Yii::$app->getSecurity()->generateRandomString(),
            'confirmed_at' => time(),
            'created_at' => time(),
            'updated_at' => time()
        ]);
        $this->insert('{{%auth_item}}', [
            'name' => 'editor',
            'type' => 1,
            'description' => 'This role can edit posts',
            'created_at' => time(),
            'updated_at' => time()
        ]);
        $this->insert('{{%auth_assignment}}', [
            'item_name' => 'editor',
            'user_id' => 1,
            'created_at' => time()
        ]);
        $this->insert('{{%auth_assignment}}', [
            'item_name' => 'editor',
            'user_id' => 2,
            'created_at' => time()
        ]);
    }

    public function safeDown()
    {
        $this->delete('{{%auth_assignment}}', [
            'item_name' => 'editor',
            'user_id' => 1
        ]);
        $this->delete('{{%auth_assignment}}', [
            'item_name' => 'editor',
            'user_id' => 2
        ]);

        $this->delete('{{%auth_item}}', [
            'name' => 'editor'
        ]);

        $this->delete('{{%user}}', [
            'id' => [1, 2]
        ]);
    }
}
