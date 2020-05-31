<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "gallery".
 *
 * @property int $id
 * @property string|null $name
 * @property string|null $file
 *
 * @property Bike[] $bikes
 */
class Gallery extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'gallery';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name', 'file'], 'string', 'max' => 255],
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
            'file' => 'File',
        ];
    }

    /**
     * Gets query for [[Bikes]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getBikes()
    {
        return $this->hasMany(Bike::class, ['photoId' => 'id']);
    }
}
