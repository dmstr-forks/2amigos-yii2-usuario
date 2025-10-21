<?php

/*
 * This file is part of the 2amigos/yii2-usuario project.
 *
 * (c) 2amigOS! <http://2amigos.us/>
 *
 * For the full copyright and license information, please view
 * the LICENSE file that was distributed with this source code.
 */

use Da\User\Helper\TimezoneHelper;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/**
 * @var yii\web\View           $this
 * @var yii\widgets\ActiveForm $form
 * @var \Da\User\Model\Profile $model
 * @var TimezoneHelper         $timezoneHelper
 */

$this->title = Yii::t('usuario', 'Profile settings');
$this->params['breadcrumbs'][] = $this->title;
$timezoneHelper = $model->make(TimezoneHelper::class);
?>

<div class="clearfix"></div>

<?= $this->render('/shared/_alert', ['module' => Yii::$app->getModule('user')]) ?>

<div class="row">
    <div class="col-md-3">
        <?= $this->render('_menu') ?>
    </div>
    <div class="col-md-9">
        <div class="card shadow-sm">
            <div class="card-header bg-light">
                <h5 class="mb-0"><?= Html::encode($this->title) ?></h5>
            </div>
            <div class="card-body">
                <?php $form = ActiveForm::begin(
                    [
                        'id' => $model->formName(),
                        'options' => ['class' => 'form-horizontal'],
                        'fieldConfig' => [
                            'template' => "{label}\n<div class=\"col-lg-9\">{input}</div>\n<div class=\"offset-sm-3 col-lg-9\">{error}\n{hint}</div>",
                            'labelOptions' => ['class' => 'col-lg-3 col-form-label'],
                        ],
                        'enableAjaxValidation' => true,
                        'enableClientValidation' => false,
                        'validateOnBlur' => false,
                    ]
                ); ?>

                <?= $form->field($model, 'name') ?>

                <?= $form->field($model, 'public_email') ?>

                <?= $form->field($model, 'website') ?>

                <?= $form->field($model, 'location') ?>

                <?= $form
                    ->field($model, 'timezone')
                    ->dropDownList(ArrayHelper::map($timezoneHelper->getAll(), 'timezone', 'name'));
                ?>
                <?= $form
                    ->field($model, 'gravatar_email')
                    ->hint(
                        Html::a(
                            Yii::t('usuario', 'Change your avatar at Gravatar.com'),
                            'http://gravatar.com',
                            ['target' => '_blank']
                        )
                    ) ?>

                <?= $form->field($model, 'bio')->textarea() ?>

                <div class="row mb-3">
                    <div class="col-lg-9 offset-lg-3">
                        <?= Html::submitButton(Yii::t('usuario', 'Save'), ['class' => 'btn btn-success w-100']) ?>
                    </div>
                </div>

                <?php ActiveForm::end(); ?>
            </div>
        </div>
    </div>
</div>
