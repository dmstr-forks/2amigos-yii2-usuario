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
use yii\widgets\Menu;
use Da\User\Module as UserModule;
use Da\User\Model\User;

/** @var User $user */
$user = Yii::$app->user->identity;
/** @var UserModule $module */
$module = Yii::$app->getModule('user');
$networksVisible = count(Yii::$app->authClientCollection->clients) > 0;

?>

<div class="card shadow-sm mb-3">
    <div class="card-header bg-light">
        <h6 class="mb-0">
            <?= Html::img(
                $user->profile->getAvatarUrl(24),
                [
                    'class' => 'rounded',
                    'alt' => $user->username,
                ]
            ) ?>
            <?= $user->username ?>
        </h6>
    </div>
    <div class="list-group list-group-flush">
        <?= Menu::widget(
            [
                'options' => [
                    'class' => 'list-group',
                ],
                'itemOptions' => ['class' => 'list-group-item list-group-item-action'],
                'activeCssClass' => 'active',
                'linkTemplate' => '<a href="{url}" class="list-group-item list-group-item-action">{label}</a>',
                'items' => [
                    ['label' => Yii::t('usuario', 'Profile'), 'url' => ['/user/settings/profile']],
                    ['label' => Yii::t('usuario', 'Account'), 'url' => ['/user/settings/account']],
                    [
                        'label' => Yii::t('usuario', 'Session history'),
                        'url' => ['/user/settings/session-history'],
                        'visible' => $module->enableSessionHistory,
                    ],
                    ['label' => Yii::t('usuario', 'Privacy'),
                        'url' => ['/user/settings/privacy'],
                        'visible' => $module->enableGdprCompliance
                    ],
                    [
                        'label' => Yii::t('usuario', 'Networks'),
                        'url' => ['/user/settings/networks'],
                        'visible' => $networksVisible,
                    ],
                ],
            ]
        ) ?>
    </div>
</div>
