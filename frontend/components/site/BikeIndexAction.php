<?php


namespace frontend\components\site;


use frontend\models\BikesSearch;
use yii\base\Action;
use Yii;

/**
 * Class BikeIndexAction
 * @property $controller
 * @package frontend\components\site
 */
class BikeIndexAction extends Action
{
    public function run()
    {
        $searchModel = new BikesSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->controller->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider
        ]);
    }

    /**
     * @return string[]
     */
    public static function getRoute(): array
    {
        return ['site/index'];
    }
}