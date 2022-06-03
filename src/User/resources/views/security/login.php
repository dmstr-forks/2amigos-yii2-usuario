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
use hrzg\widget\widgets\Cell;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/**
 * @var yii\web\View $this
 * @var \Da\User\Form\LoginForm $model
 * @var \Da\User\Module $module
 */

$this->title = Yii::t('usuario', 'Sign in');

echo Cell::widget(['id' => 'login-top']);
?>
    <div class="row">
        <div class="col-md-6 col-md-offset-3 col-sm-6 col-sm-offset-3">
            <h3 class="text-center"><?= Html::encode($this->title) ?></h3>
            <?php $form = ActiveForm::begin(
                [
                    'id' => $model->formName(),
                    'enableClientValidation' => false,
                    'validateOnBlur' => false,
                    'validateOnType' => false,
                    'validateOnChange' => false
                ]
            ) ?>

            <?= $form->field(
                $model,
                'login',
                ['inputOptions' => ['autofocus' => 'autofocus', 'class' => 'form-control', 'tabindex' => '1']]
            ) ?>

            <?= $form
                ->field(
                    $model,
                    'password',
                    ['inputOptions' => ['class' => 'form-control', 'tabindex' => '2']]
                )
                ->passwordInput() ?>

            <div class="form-group">
                <div class="row">
                    <div class="col-xs-12 col-md-6">
                        <?= $form->field($model, 'rememberMe')->checkbox(['tabindex' => '4']) ?>
                    </div>
                    <?php if ($module->allowPasswordRecovery): ?>
                        <div class="col-xs-12 col-md-6">
                            <?= Html::a(
                                Yii::t('usuario', 'Forgot password?'),
                                ['/user/recovery/request'],
                                ['tabindex' => '5','class' => 'pull-right']
                            ) ?>
                        </div>
                    <?php endif; ?>
                </div>
            </div>

            <div class="form-group">
                <?= Html::submitButton(
                    Yii::t('usuario', 'Login'),
                    ['class' => 'btn btn-primary btn-block', 'tabindex' => '3']
                ) ?>
            </div>
            <?php ActiveForm::end(); ?>
            <br>
            <?php if ($module->enableEmailConfirmation): ?>
                <p class="text-center">
                    <?= Html::a(
                        Yii::t('usuario', 'Didn\'t receive confirmation message?'),
                        ['/user/registration/resend']
                    ) ?>
                </p>
            <?php endif ?>
            <?php if ($module->enableRegistration): ?>
                <p class="text-center">
                    <?= Html::a(Yii::t('usuario', 'Don\'t have an account? Sign up!'),
                        ['/user/registration/register']) ?>
                </p>
            <?php endif ?>
            <?= ConnectWidget::widget(
                [
                    'baseAuthUrl' => ['/user/security/auth'],
                ]
            ) ?>
        </div>
    </div>
<?php
echo Cell::widget(['id' => 'login-bottom']);
