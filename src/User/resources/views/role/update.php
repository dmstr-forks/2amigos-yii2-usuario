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
 * @var \Da\User\Model\Role $model
 * @var string[] $unassignedItems
 * @var \yii\rbac\Item[] $parentItems
 * @var \Da\User\Module $module
 */
$this->title = Yii::t('usuario', 'Update role');
$this->params['breadcrumbs'][] = $this->title;

?>

<?php $this->beginContent($module->viewPath . '/shared/admin_layout.php') ?>

<?= $this->render(
    '/role/_form',
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
