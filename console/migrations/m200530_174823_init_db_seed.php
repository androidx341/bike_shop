<?php

use yii\db\Migration;

/**
 * Class m200530_174823_init_db_seed
 */
class m200530_174823_init_db_seed extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->batchInsert('brands', ['name'], [
            ['Centurion'],
            ['Comanche'],
            ['CUBE'],
            ['Giant'],
            ['Haibike'],
            ['KROSS'],
            ['Liv'],
            ['Merida'],
            ['Scott'],
        ]);

        $this->batchInsert('bikes_types', ['name'], [
            ['Горные MTB'],
            ['DH/FR/AM'],
            ['Enduro/Trail'],
        ]);

        $this->batchInsert('materials', ['name'], [
            ['Алюминий'],
            ['Карбон'],
            ['ХромМолибден'],
        ]);

        $this->batchInsert('colors', ['name', 'value'], [
            ['Белый', 'FFFFFF'],
            ['Черный', '000000'],
            ['Красный', 'FF0000'],
            ['Зеленый', '00FF00'],
            ['Синий', '0000FF'],
            ['Желтый', 'FFFF00'],
            ['Серебристый', 'C0C0C0'],
            ['Фиолетоый', '800080'],
        ]);

        $this->batchInsert('brake_types', ['name'], [
            ['Дисковые гидравлические'],
            ['Клещевой'],
            ['Дисковые механические'],
            ['Ободные V-Brake'],
            ['Ножной'],
            ['Барабанный ручной'],
        ]);

        $this->batchInsert('gallery', ['name', 'file'], [
            ['bike_1.jpg', '1.jpg'],
            ['bike_2.jpg', '2.jpg'],
            ['bike_3.jpg', '3.jpg'],
        ]);


        $brands = $this->getDb()->createCommand('SELECT * FROM brands')->queryAll();
        $bikesTypes = $this->getDb()->createCommand('SELECT * FROM bikes_types')->queryAll();
        $materials = $this->getDb()->createCommand('SELECT * FROM materials')->queryAll();
        $colors = $this->getDb()->createCommand('SELECT * FROM colors')->queryAll();
        $brake_types = $this->getDb()->createCommand('SELECT * FROM brake_types')->queryAll();
        $gallery = $this->getDb()->createCommand('SELECT * FROM gallery')->queryAll();

        $a = 1;
        $faker = Faker\Factory::create();

        for ($i = 0; $i < 50; $i++) {
            $brand = $brands[array_rand($brands)];
            $bikeType = $bikesTypes[array_rand($bikesTypes)];
            $color = $colors[array_rand($colors)];
            $photo = $gallery[array_rand($gallery)];
            $material = $materials[array_rand($materials)];
            $brakeType = $brake_types[array_rand($brake_types)];

            $this->insert('bikes', [
                'name' => sprintf('Велосипед %s %s %s', $brand['name'], $bikeType['name'], $color['name'] ),
                'gearsCount' => rand(1, 27),
                'wheelSize' => rand(16, 29) + rand(0, 1) / 2,
                'frameSize' => rand(11, 19) + rand(0, 1) / 2,
                'description' => $faker->text(200),
                'photoId' => $photo['id'],
                'price' => rand(2000, 30000),
                'brandId' => $brand['id'],
                'colorId' => $color['id'],
                'materialId' => $material['id'],
                'bikeTypeId' => $bikeType['id'],
                'brakeTypeId' => $brakeType['id'],
            ]);
        }
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->execute("SET foreign_key_checks = 0;");
        $this->truncateTable('bikes');
        $this->truncateTable('brake_types');
        $this->truncateTable('colors');
        $this->truncateTable('materials');
        $this->truncateTable('bikes_types');
        $this->truncateTable('brands');
        $this->execute("SET foreign_key_checks = 1;");
    }
}
