<?php

use yii\db\Migration;

/**
 * Class m200530_170321_init_tables
 */
class m200530_170321_init_tables extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('bikes', [
            'id' => $this->primaryKey()->unsigned(),
            'name' => $this->string(255)->notNull(),
            'gearsCount' => $this->integer()->unsigned()->defaultValue(1),
            'wheelSize' => $this->decimal(4,2),
            'frameSize' => $this->decimal(4,2),
            'description' => $this->text(),
            'photoId' => $this->integer()->unsigned(),
            'price' => $this->decimal(8, 2)->defaultValue(0),
            'brandId' => $this->integer()->unsigned(),
            'colorId' => $this->integer()->unsigned(),
            'materialId' => $this->integer()->unsigned(),
            'bikeTypeId' => $this->integer()->unsigned(),
            'brakeTypeId' => $this->integer()->unsigned(),
        ]);

        $this->createIndex('idx_bikes_price', 'bikes', 'price');
        $this->createIndex('idx_bikes_name', 'bikes', 'name');
        $this->createIndex('idx_bikes_wheelSize', 'bikes', 'wheelSize');
        $this->createIndex('idx_bikes_frameSize', 'bikes', 'frameSize');
        $this->createIndex('idx_bikes_gearsCount', 'bikes', 'gearsCount');

        $this->createTable('gallery', [
            'id' => $this->primaryKey()->unsigned(),
            'name' => $this->string(255),
            'file' => $this->string(255)
        ]);

        $this->createTable('brands', [
            'id' => $this->primaryKey()->unsigned(),
            'name' => $this->string(255)->notNull(),
        ]);

        $this->createTable('colors', [
            'id' => $this->primaryKey()->unsigned(),
            'name' => $this->string(255)->notNull(),
            'value' => $this->string(6)->notNull(),
        ]);

        $this->createTable('materials', [
            'id' => $this->primaryKey()->unsigned(),
            'name' => $this->string(255)->notNull(),
        ]);

        $this->createTable('bikes_types', [
            'id' => $this->primaryKey()->unsigned(),
            'name' => $this->string(255)->notNull(),
        ]);

        $this->createTable('brake_types', [
            'id' => $this->primaryKey()->unsigned(),
            'name' => $this->string(255),
        ]);

        $this->addForeignKey(
            'fk_bike_brand',
            'bikes',
            'brandId',
            'brands',
            'id',
            'SET NULL'
        );

        $this->addForeignKey(
            'fk_bike_colorId',
            'bikes',
            'colorId',
            'colors',
            'id',
            'SET NULL'
        );

        $this->addForeignKey(
            'fk_bike_materialId',
            'bikes',
            'materialId',
            'materials',
            'id',
            'SET NULL'
        );

        $this->addForeignKey(
            'fk_bike_bikeTypeId',
            'bikes',
            'bikeTypeId',
            'bikes_types',
            'id',
            'SET NULL'
        );

        $this->addForeignKey(
            'fk_bike_brakeTypeId',
            'bikes',
            'brakeTypeId',
            'brake_types',
            'id',
            'SET NULL'
        );

        $this->addForeignKey(
            'fk_bike_photoId',
            'bikes',
            'photoId',
            'gallery',
            'id',
            'SET NULL'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropForeignKey('fk_bike_brakeTypeId', 'bikes');
        $this->dropForeignKey('fk_bike_bikeTypeId', 'bikes');
        $this->dropForeignKey('fk_bike_materialId', 'bikes');
        $this->dropForeignKey('fk_bike_colorId', 'bikes');
        $this->dropForeignKey('fk_bike_brand', 'bikes');
        $this->dropForeignKey('fk_bike_photoId', 'bikes');

        $this->dropTable('gallery');
        $this->dropTable('brake_types');
        $this->dropTable('bikes_types');
        $this->dropTable('materials');
        $this->dropTable('colors');
        $this->dropTable('brands');
        $this->dropTable('bikes');
    }
}
