<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "colors".
 *
 * @property int $id
 * @property string $name
 * @property string $value
 *
 * @property Bike $bikes
 */
class Color extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'colors';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name', 'value'], 'required'],
            [['name'], 'string', 'max' => 255],
            [['value'], 'string', 'max' => 6],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Name',
            'value' => 'Value',
        ];
    }

    /**
     * Gets query for [[Bikes]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getBikes()
    {
        return $this->hasMany(Bike::class, ['colorId' => 'id']);
    }
}
