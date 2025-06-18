<?php

/*
 * This file is part of the 2amigos/yii2-usuario project.
 *
 * (c) 2amigOS! <http://2amigos.us/>
 *
 * For the full copyright and license information, please view
 * the LICENSE file that was distributed with this source code.
 */

/**
 * @var yii\web\View $this
 * @var Da\User\Model\Permission $model
 * @var string[] $unassignedItems
 * @var \yii\rbac\Item[] $parentItems
 * @var \Da\User\Module $module
 */

use yii\helpers\Html;
use yii\rbac\Role;

$this->title = Yii::t('usuario', 'Update permission');
$this->params['breadcrumbs'][] = $this->title;


?>

<?php $this->beginContent($module->viewPath . '/shared/admin_layout.php') ?>

<?= $this->render(
    '/permission/_form',
    [
        'model' => $model,
        'unassignedItems' => $unassignedItems,
    ]
) ?>

<hr>

<?= $this->render(
    '/shared/_parent-items',
    [
        'parentItems' => $parentItems
    ]
) ?>

<?php $this->endContent() ?>
