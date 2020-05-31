<?php


namespace common\helpers;


use yii\base\DynamicModel;
use yii\widgets\ActiveForm;

class HtmlHelper
{
    /**
     * @param ActiveForm $form
     * @param DynamicModel $model
     * @param string $field
     * @param array $list
     * @return \yii\widgets\ActiveField
     */
    public static function buildActiveCheckbox(ActiveForm $form, DynamicModel $model, string $field, array $list)
    {
        return $form->field($model, $field)->checkboxList($list, [
            'separator' => '<br>',
            'onchange' => 'updateResults()'
        ]);
    }
}