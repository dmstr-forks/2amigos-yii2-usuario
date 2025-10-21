<?php

/*
 * This file is part of the 2amigos/yii2-usuario project.
 *
 * (c) 2amigOS! <http://2amigos.us/>
 *
 * For the full copyright and license information, please view
 * the LICENSE file that was distributed with this source code.
 */

use Da\User\Widget\ConnectWidget;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/**
 * @var yii\web\View            $this
 * @var \Da\User\Form\LoginForm $model
 * @var \Da\User\Module         $module
 */

$this->title = Yii::t('usuario', 'Sign in');
$this->params['breadcrumbs'][] = $this->title;
?>

<?= $this->render('/shared/_alert', ['module' => Yii::$app->getModule('user')]) ?>

<div class="row">
    <div class="col-md-4 offset-md-4 col-sm-6 offset-sm-3">
        <div class="card shadow-sm">
            <div class="card-header bg-light">
                <h5 class="mb-0"><?= Html::encode($this->title) ?></h5>
            </div>
            <div class="card-body">
                <?php $form = ActiveForm::begin(
                    [
                        'id' => $model->formName(),
                        'enableAjaxValidation' => true,
                        'enableClientValidation' => false,
                        'validateOnBlur' => false,
                        'validateOnType' => false,
                        'validateOnChange' => false,
                        'fieldConfig' => [
                            'options' => ['class' => 'mb-3'],
                        ],
                    ]
                ) ?>
                <?= $form->field(
                    $model,
                    'twoFactorAuthenticationCode',
                    ['inputOptions' => ['autofocus' => 'autofocus', 'class' => 'form-control', 'tabindex' => '1']]
                ) ?>
                <div class="row">
                    <div class="col-md-6">
                        <?= Html::a(
                            Yii::t('usuario', 'Cancel'),
                            ['login'],
                            ['class' => 'btn btn-secondary w-100', 'tabindex' => '3']
                        ) ?>
                    </div>
                    <div class="col-md-6">
                        <?= Html::submitButton(
                            Yii::t('usuario', 'Confirm'),
                            ['class' => 'btn btn-primary w-100', 'tabindex' => '3']
                        ) ?>
                    </div>
                </div>
                <?php ActiveForm::end(); ?>
            </div>
        </div>
    </div>
</div>
