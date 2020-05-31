<?php

namespace common\models;

/**
 * This is the ActiveQuery class for [[Bike]].
 *
 * @see Bike
 */
class BikesQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return Bike[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return Bike|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }

    public static function field(string $name)
    {
        return Bike::tableName() . ".{$name}";
    }
}
