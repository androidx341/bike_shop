<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "bikes_types".
 *
 * @property int $id
 * @property string $name
 *
 * @property Bike[] $bikes
 */
class BikeType extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'bikes_types';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name'], 'required'],
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
        return $this->hasMany(Bike::class, ['bikeTypeId' => 'id']);
    }
}
