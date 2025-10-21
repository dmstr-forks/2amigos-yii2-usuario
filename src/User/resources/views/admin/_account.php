<?php

/*
 * This file is part of the 2amigos/yii2-usuario project.
 *
 * (c) 2amigOS! <http://2amigos.us/>
 *
 * For the full copyright and license information, please view
 * the LICENSE file that was distributed with this source code.
 */

use yii\bootstrap5\ActiveForm;
use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var Da\User\Model\User $user */
/** @var \Da\User\Module $module */

?>

<?php $this->beginContent($module->viewPath. '/admin/update.php', ['user' => $user]) ?>

<?php $form = ActiveForm::begin(
    [
        'layout' => 'horizontal',
        'enableAjaxValidation' => true,
        'enableClientValidation' => false,
        'fieldConfig' => [
            'horizontalCssClasses' => [
                'wrapper' => 'col-sm-9',
            ],
        ],
    ]
); ?>

<?= $this->render('/admin/_user', ['form' => $form, 'user' => $user]) ?>

<div class="row mb-3">
    <div class="col-lg-9 offset-lg-2">
        <?= Html::submitButton(Yii::t('usuario', 'Update'), ['class' => 'btn btn-primary w-100']) ?>
    </div>
</div>

<?php ActiveForm::end(); ?>

<?php $this->endContent() ?>
