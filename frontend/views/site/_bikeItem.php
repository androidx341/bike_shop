<?php
use common\models\Bike;
use yii\bootstrap\Html;


/**
 * @var $model Bike
 */
?>
<div class="item col-md-12">
    <div class="col-md-4">
        <?= Html::img('/gallery/' . $model->photo->file, [
            'style' => [
                'width' => '250px'
            ]
        ]) ?>
    </div>
    <div class="col-md-5">
        <?= Html::a($model->name, '#') ?>
        <?= Html::tag('p', $model->description) ?>
    </div>
    <div class="col-md-3">
        <div class="alert alert-info" role="alert"><?=$model->getPriceFormatted()?>  </div>
        <div class="btn btn-success">Купить</div>
    </div>
</div>
