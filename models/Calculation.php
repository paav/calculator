<?php

namespace app\models;

use yii\data\ActiveDataProvider;
use yii\db\ActiveRecord;

/**
 *
 * @property string $expression E.g. "2 + 3".
 * @property float $result Arithmetic expression result.
 */
class Calculation extends ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{calculation}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['expression'], 'required'],
            [['expression'], 'match', 'pattern' => ArithmeticExpression::REGEX_EXPRESSION],
            [['result'], 'number'],
        ];
    }

    /**
     * @param int $limit Number of fetched items.
     * @return static[]
     */
    public static function findLast($limit)
    {
        static::find()->limit($limit)->all();
    }

    /**
     * @param int $limit Fetched items count.
     * @return ActiveDataProvider
     */
    public static function DPLast($limit)
    {
        $dp = new ActiveDataProvider();
        $dp->sort = false;
        $dp->query = static::find()
            ->limit($limit)
            ->orderBy('id DESC');
        return $dp;
    }
}
