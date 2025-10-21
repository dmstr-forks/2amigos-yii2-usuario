<?php

/*
 * This file is part of the 2amigos/yii2-usuario project.
 *
 * (c) 2amigOS! <http://2amigos.us/>
 *
 * For the full copyright and license information, please view
 * the LICENSE file that was distributed with this source code.
 */

use yii\helpers\Html;

/** @var \yii\web\View $this */
/** @var string $content */

?>
<div class="clearfix"></div>

<?= $this->render(
    '/shared/_alert',
    [
        'module' => Yii::$app->getModule('user'),
    ]
) ?>

<div class="row">
    <div class="col-md-12">
        <div class="card shadow-sm">
            <div class="card-header bg-light">
                <h5 class="mb-0"><?= Html::encode($this->title) ?></h5>
            </div>
            <div class="card-body">
                <?= $this->render('/shared/_menu') ?>
                <?= $content ?>
            </div>
        </div>
    </div>
</div>
