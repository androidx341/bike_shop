<?php


namespace frontend\models;


use common\models\Bike;
use common\models\BikesQuery;
use common\models\BikeType;
use common\models\BrakeType;
use common\models\Brand;
use common\models\Color;
use common\models\Material;
use yii\base\DynamicModel;
use yii\data\ActiveDataProvider;
use yii\helpers\ArrayHelper;

class BikesSearch extends DynamicModel
{
    public $brandIds;
    public $bikeTypeIds;
    public $brakeTypeIds;
    public $colorIds;
    public $materialIds;
    public $frameSizesSearch;
    public $wheelSizesSearch;
    public $priceFrom;
    public $priceTo;

    public function init()
    {
        $this->priceTo = Bike::find()->select('price')->orderBy(['price' => SORT_DESC])->scalar();
    }

    public function rules()
    {
        return [
            [['priceFrom', 'priceTo'], 'number', 'min' => 0],
            ['priceFrom', 'default', 'value' => 0],
            [['frameSizesSearch', 'wheelSizesSearch'], 'each', 'rule' => ['number']],
            ['brandIds', 'exist', 'targetClass' => Brand::class, 'targetAttribute' => 'id', 'allowArray' => true],
            ['bikeTypeIds', 'exist', 'targetClass' => BikeType::class, 'targetAttribute' => 'id', 'allowArray' => true],
            ['brakeTypeIds', 'exist', 'targetClass' => BrakeType::class, 'targetAttribute' => 'id', 'allowArray' => true],
            ['colorIds', 'exist', 'targetClass' => BrakeType::class, 'targetAttribute' => 'id', 'allowArray' => true],
            ['materialIds', 'exist', 'targetClass' => Material::class, 'targetAttribute' => 'id', 'allowArray' => true],
        ];
    }

    public function attributeLabels()
    {
        return [
            'brandIds' => 'Бренд',
            'bikeTypeIds' => 'Тип велосипеда',
            'brakeTypeIds' => 'Тип тормозов',
            'colorIds' => 'Цвет',
            'materialIds' => 'Материал рамы',
            'frameSizesSearch' => 'Размер рамы',
            'wheelSizesSearch' => 'Диаметр колес',
            'priceFrom' => 'Цена от',
            'priceTo' => 'Цена до',
        ];
    }


    public function search($params)
    {
        $this->load($params);

        $query = Bike::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'pagination' => [
                'pageSizeLimit' => [0, 10],
            ],
        ]);

        if (!$this->validate()) {
            $query->emulateExecution();

            return $dataProvider;
        }

        $query->andFilterWhere([BikesQuery::field('brandId') => $this->brandIds]);
        $query->andFilterWhere([BikesQuery::field('bikeTypeId') => $this->bikeTypeIds]);
        $query->andFilterWhere([BikesQuery::field('colorId') => $this->colorIds]);
        $query->andFilterWhere([BikesQuery::field('brakeTypeId') => $this->brakeTypeIds]);
        $query->andFilterWhere([BikesQuery::field('materialId') => $this->materialIds]);
        $query->andFilterWhere(['between', BikesQuery::field('price'), $this->priceFrom, $this->priceTo]);
        $query->andFilterWhere([BikesQuery::field('frameSize') => $this->frameSizesSearch]);
        $query->andFilterWhere([BikesQuery::field('wheelSize') => $this->wheelSizesSearch]);

        return $dataProvider;
    }

    /**
     * Return brand list for select
     * @return array
     */
    public function getBrands(): array
    {
        $brands = Brand::find()->all();

        return ArrayHelper::map($brands, 'id', 'name');
    }

    /**
     * Return bike types list for select
     * @return array
     */
    public function getBikeTypes(): array
    {
        $types = BikeType::find()->all();

        return ArrayHelper::map($types, 'id', 'name');
    }

    /**
     * Return materials list for select
     * @return array
     */
    public function getMaterials(): array
    {
        $materials = Material::find()->all();

        return ArrayHelper::map($materials, 'id', 'name');
    }

    /**
     * Return brake types list for select
     * @return array
     */
    public function getBrakeTypes(): array
    {
        $brakeType = BrakeType::find()->all();

        return ArrayHelper::map($brakeType, 'id', 'name');
    }

    /**
     * Return colors models list
     * @return Color[]
     */
    public function getColors(): array
    {
        $colors = Color::find()->all();

        return ArrayHelper::map($colors, 'id', 'name');
    }

    /**
     * Return frames sizes list
     * @return array
     */
    public function getFrameSizesList(): array
    {
        $sizes = Bike::find()
            ->distinct()
            ->select('frameSize')
            ->orderBy(['frameSize' => SORT_ASC])
            ->asArray()
            ->all();

        return ArrayHelper::map($sizes, 'frameSize', 'frameSize');
    }

    /**
     * Return wheels sizes list
     * @return array
     */
    public function getWheelSizesList(): array
    {
        $sizes = Bike::find()
            ->distinct()
            ->select('wheelSize')
            ->orderBy(['wheelSize' => SORT_ASC])
            ->asArray()
            ->all();

        return ArrayHelper::map($sizes, 'wheelSize', 'wheelSize');
    }
}