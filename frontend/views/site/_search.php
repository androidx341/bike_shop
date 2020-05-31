<?php

use common\helpers\HtmlHelper;
use common\models\Brand;
use frontend\components\site\BikeIndexAction;
use frontend\models\BikesSearch;
use yii\bootstrap\Html;
use yii\widgets\ActiveForm;
use yii\widgets\Pjax;

/**
 * @var $searchModel BikesSearch
 */

?>

<div class="search">
    <?php Pjax::begin(['id' => 'form_pjax']) ?>
    <?php $form = ActiveForm::begin([
        'id' => 'filter-form',
        'action' => BikeIndexAction::getRoute(),
        'method' => 'get',
        'options' => [
            'data-pjax' => true
        ]
    ]) ?>

    <div>
        <?= HtmlHelper::buildActiveCheckbox($form, $searchModel, 'brandIds', $searchModel->getBrands()); ?>
        <?= HtmlHelper::buildActiveCheckbox($form, $searchModel, 'bikeTypeIds', $searchModel->getBikeTypes()); ?>
        <?= HtmlHelper::buildActiveCheckbox($form, $searchModel, 'materialIds', $searchModel->getMaterials()); ?>
        <?= HtmlHelper::buildActiveCheckbox($form, $searchModel, 'brakeTypeIds', $searchModel->getBrakeTypes()); ?>
        <?= HtmlHelper::buildActiveCheckbox($form, $searchModel, 'colorIds', $searchModel->getColors()); ?>
        <?= HtmlHelper::buildActiveCheckbox($form, $searchModel, 'frameSizesSearch', $searchModel->getFrameSizesList()); ?>
        <?= HtmlHelper::buildActiveCheckbox($form, $searchModel, 'wheelSizesSearch', $searchModel->getWheelSizesList()); ?>

        <div class="row">
            <div class="col-md-6">
                <?= $form->field($searchModel, 'priceFrom')->input('number', [
                        'onChange' => 'updateResults()'
                ]); ?>
            </div>
            <div class="col-md-6">
                <?= $form->field($searchModel, 'priceTo')->input('number', [
                    'onChange' => 'updateResults()'
                ]); ?>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="form-group btn-container col-xs-12 col-sm-6">
            <div class="btn-group">
                <?= Html::a('Сбросить фильтры', BikeIndexAction::getRoute(), ['class' => 'btn btn-danger']); ?>
            </div>
        </div>
    </div>

    <?php ActiveForm::end(); ?>
    <?php Pjax::end() ?>
</div>
