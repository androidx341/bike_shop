<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "bikes".
 *
 * @property int $id
 * @property string $name
 * @property int|null $gearsCount
 * @property float|null $wheelSize
 * @property float|null $frameSize
 * @property string|null $description
 * @property int|null $photoId
 * @property float|null $price
 * @property int|null $brandId
 * @property int|null $colorId
 * @property int|null $materialId
 * @property int|null $bikeTypeId
 * @property int|null $brakeTypeId
 *
 * @property BikeType $bikeType
 * @property BrakeType $brakeType
 * @property Brand $brand
 * @property Color $color
 * @property Material $material
 * @property Gallery $photo
 */
class Bike extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'bikes';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name'], 'required'],
            [['gearsCount', 'photoId', 'brandId', 'colorId', 'materialId', 'bikeTypeId', 'brakeTypeId'], 'integer'],
            [['wheelSize', 'frameSize', 'price'], 'number'],
            [['description'], 'string'],
            [['name'], 'string', 'max' => 255],
            [['bikeTypeId'], 'exist', 'skipOnError' => true, 'targetClass' => BikeType::class, 'targetAttribute' => ['bikeTypeId' => 'id']],
            [['brakeTypeId'], 'exist', 'skipOnError' => true, 'targetClass' => BrakeType::class, 'targetAttribute' => ['brakeTypeId' => 'id']],
            [['brandId'], 'exist', 'skipOnError' => true, 'targetClass' => Brand::class, 'targetAttribute' => ['brandId' => 'id']],
            [['colorId'], 'exist', 'skipOnError' => true, 'targetClass' => Color::class, 'targetAttribute' => ['colorId' => 'id']],
            [['materialId'], 'exist', 'skipOnError' => true, 'targetClass' => Material::class, 'targetAttribute' => ['materialId' => 'id']],
            [['photoId'], 'exist', 'skipOnError' => true, 'targetClass' => Gallery::class, 'targetAttribute' => ['photoId' => 'id']],
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
            'gearsCount' => 'Gears Count',
            'wheelSize' => 'Wheel Size',
            'frameSize' => 'Frame Size',
            'description' => 'Description',
            'photoId' => 'Photo ID',
            'price' => 'Price',
            'brandId' => 'Brand ID',
            'colorId' => 'Color ID',
            'materialId' => 'Material ID',
            'bikeTypeId' => 'Bike Type ID',
            'brakeTypeId' => 'Brake Type ID',
        ];
    }

    /**
     * Gets query for [[BikeType]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getBikeType()
    {
        return $this->hasOne(BikeType::class, ['id' => 'bikeTypeId']);
    }

    /**
     * Gets query for [[BrakeType]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getBrakeType()
    {
        return $this->hasOne(BrakeType::class, ['id' => 'brakeTypeId']);
    }

    /**
     * Gets query for [[Brand]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getBrand()
    {
        return $this->hasOne(Brand::class, ['id' => 'brandId']);
    }

    /**
     * Gets query for [[Color]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getColor()
    {
        return $this->hasOne(Color::class, ['id' => 'colorId']);
    }

    /**
     * Gets query for [[Material]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getMaterial()
    {
        return $this->hasOne(Material::class, ['id' => 'materialId']);
    }

    /**
     * Gets query for [[Photo]].
     *
     * @return \yii\db\ActiveQuery|yii\db\ActiveQuery
     */
    public function getPhoto()
    {
        return $this->hasOne(Gallery::class, ['id' => 'photoId']);
    }

    /**
     * {@inheritdoc}
     * @return BikesQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new BikesQuery(get_called_class());
    }

    public function getPriceFormatted()
    {
        return sprintf('%.2f грн.', $this->price);
    }
}
