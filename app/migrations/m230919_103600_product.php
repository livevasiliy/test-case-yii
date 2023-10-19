<?php

namespace app\migrations;

use yii\db\Migration;

class m230919_103600_product extends Migration
{
    public function safeUp()
    {
        $this->createTable('{{%product}}', [
            'id'         => $this->primaryKey(),
            'group_id'   => $this->integer(),
            'article'    => $this->string(32),
            'title'      => $this->string(),
            'image'      => $this->string(),
            'price'      => $this->decimal(10, 2),
            'stock'      => $this->integer(),
            'created_at' => $this->dateTime()->notNull()->defaultExpression('now()'),
            'deleted_at' => $this->dateTime(),
        ]);
    }

    public function safeDown()
    {
        $this->dropTable('{{%product}}');
    }
} 