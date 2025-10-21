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
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/**
 * @var yii\web\View $this
 * @var Da\User\Model\Permission $model
 * @var string[] $unassignedItems
 */

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

<?= $form->field($model, 'description') ?>

<?= $form->field($model, 'rule')->widget(Select2::class, [
    'data' => ArrayHelper::map(Yii::$app->getAuthManager()->getRules(), 'name', 'name'),
    'options' => [
        'prompt' => Yii::t('usuario', 'Select rule...'),
        'class' => 'form-select',
    ],
    'pluginOptions' => [
        'allowClear' => true,
        'theme' => 'bootstrap-5',
        'placeholder' => Yii::t('usuario', 'Select rule...'),
    ],
    'addon' => [
        'prepend' => [
            'content' => '<i class="bi bi-shield-check"></i>',
        ]
    ],
]) ?>

<?= $form->field($model, 'children')->widget(
    Select2::class,
    [
        'data' => $unassignedItems,
        'options' => [
            'id' => 'children',
            'multiple' => true,
            'class' => 'form-select',
        ],
        'pluginOptions' => [
            'allowClear' => true,
            'theme' => 'bootstrap-5',
            'placeholder' => Yii::t('usuario', 'Select children...'),
        ],
        'addon' => [
            'prepend' => [
                'content' => '<i class="bi bi-diagram-3"></i>',
            ]
        ],
    ]
) ?>

<div class="mb-3">
    <?= Html::submitButton(Yii::t('usuario', 'Save'), ['class' => 'btn btn-primary w-100']) ?>
</div>

<?php ActiveForm::end() ?>
