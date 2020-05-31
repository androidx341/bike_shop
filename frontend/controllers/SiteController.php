<?php
namespace frontend\controllers;

use frontend\components\site\BikeIndexAction;
use yii\web\Controller;

/**
 * Site controller
 */
class SiteController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'index' => [
                'class' => BikeIndexAction::class
            ]
        ];
    }
}
