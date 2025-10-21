<?php

/**
 * @var yii\web\View $this
 * @var \Da\User\Model\Rule $model
 */

use yii\helpers\Html;
use yii\widgets\ActiveForm;

?>


<?php $form = ActiveForm::begin(
    [
        'enableClientValidation' => false,
        'enableAjaxValidation' => true,
        'fieldConfig' => [
            'options' => ['class' => 'mb-3'],
        ],
    ]
) ?>

<?= $form->field($model, 'name') ?>

<?= $form->field($model, 'className') ?>

<div class="mb-3">
    <?= Html::submitButton(Yii::t('usuario', 'Save'), ['class' => 'btn btn-primary w-100']) ?>
</div>

<?php ActiveForm::end() ?>
