<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "brake_types".
 *
 * @property int $id
 * @property string|null $name
 *
 * @property Bike[] $bikes
 */
class BrakeType extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'brake_types';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name'], 'string', 'max' => 255],
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
        ];
    }

    /**
     * Gets query for [[Bikes]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getBikes()
    {
        return $this->hasMany(Bike::class, ['brakeTypeId' => 'id']);
    }
}
