<?php

use yii\db\Migration;

/**
 * Handles the creation of table `calculations`.
 */
class m170206_152510_create_calculations_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('calculation', [
            'id' => $this->primaryKey(),
            'expression' => $this->string(),
            'result' => $this->double(),
            'created' => $this->timestamp()
        ]);
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('calculation');
    }
}
