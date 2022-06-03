<?php

/*
 * This file is part of the 2amigos/yii2-usuario project.
 *
 * (c) 2amigOS! <http://2amigos.us/>
 *
 * For the full copyright and license information, please view
 * the LICENSE file that was distributed with this source code.
 */

use hrzg\widget\widgets\Cell;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/**
 * @var yii\web\View $this
 * @var \Da\User\Form\ResendForm $model
 */

$this->title = Yii::t('usuario', 'Request new confirmation message');
echo Cell::widget(['id' => 'resend-top']);
?>
    <div class="row">
        <div class="col-md-6 col-md-offset-3 col-sm-6 col-sm-offset-3">
            <h3 class="text-center"><?= Html::encode($this->title) ?></h3>

            <?php $form = ActiveForm::begin(
                [
                    'id' => $model->formName(),
                    'enableAjaxValidation' => true,
                    'enableClientValidation' => false,
                ]
            ); ?>

            <?= $form->field($model, 'email')->textInput(['autofocus' => true]) ?>
            <br>
            <?= Html::submitButton(Yii::t('usuario', 'Continue'), ['class' => 'btn btn-primary btn-block']) ?><br>

            <?php ActiveForm::end(); ?>
            <br>
            <p class="text-center">
                <?= Html::a(
                    Yii::t('usuario', 'Back to login!'),
                    ['/user/security/login']
                ) ?>
            </p>
        </div>
    </div>
<?php
echo Cell::widget(['id' => 'resend-bottom']);
