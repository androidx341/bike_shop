<?php

/* @var $this yii\web\View */

use common\models\Bike;
use frontend\models\BikesSearch;
use yii\data\ActiveDataProvider;use yii\widgets\ListView;
use yii\widgets\Pjax;

/**
 * @var $searchModel BikesSearch
 * @var $dataProvider ActiveDataProvider
 */
$this->title = 'My Yii Application';

?>

<div class="row">
    <div class="col-md-3">
        <?= $this->render('_search', ['searchModel' => $searchModel]) ?>
    </div>
    <div class="col-md-9">
        <?php Pjax::begin(['id' => 'update_pjax']) ?>
        <?= ListView::widget([
            'dataProvider' => $dataProvider,
            'itemView' => '_bikeItem'
        ])?>
        <?php Pjax::end() ?>
    </div>
</div>
