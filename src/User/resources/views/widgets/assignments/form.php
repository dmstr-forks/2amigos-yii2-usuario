<?php

/*
 * This file is part of the 2amigos/yii2-usuario project.
 *
 * (c) 2amigOS! <http://2amigos.us/>
 *
 * For the full copyright and license information, please view
 * the LICENSE file that was distributed with this source code.
 */

use kartik\select2\Select2;
use yii\bootstrap5\Alert;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var \yii\web\View $this */
/** @var string[] $availableItems */
/** @var Da\User\Model\Assignment $model */


?>

<?php if ($model->updated): ?>

    <?= Alert::widget(
        [
            'options' => [
                'class' => 'alert-success',
            ],
            'body' => Yii::t('usuario', 'Assignments have been updated'),
        ]
    ) ?>

<?php endif ?>

<?php $form = ActiveForm::begin(
    [
        'enableClientValidation' => false,
        'enableAjaxValidation' => false,
        'fieldConfig' => [
            'options' => ['class' => 'mb-3'],
        ],
    ]
) ?>

<?= Html::activeHiddenInput($model, 'user_id') ?>

<?= $form->field($model, 'items')->widget(
    Select2::class,
    [
        'data' => $availableItems,
        'options' => [
            'id' => 'children',
            'multiple' => true,
            'class' => 'form-select',
        ],
        'pluginOptions' => [
            'allowClear' => true,
            'theme' => 'bootstrap-5',
            'placeholder' => Yii::t('usuario', 'Select items...'),
        ],
        'addon' => [
            'prepend' => [
                'content' => '<i class="bi bi-list-check"></i>',
            ]
        ],
    ]
) ?>

<div class="mb-3">
    <?= Html::submitButton(Yii::t('usuario', 'Update assignments'), ['class' => 'btn btn-primary w-100']) ?>
</div>

<?php ActiveForm::end() ?>
