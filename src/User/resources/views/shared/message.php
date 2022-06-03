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
 * @var yii\web\View
 * @var \Da\User\Module $module
 * @var string          $title
 * @var array          $messages
 */

$this->title = $title;

echo $this->render(
    '/shared/_alert',
    [
        'module' => $module,
        'title' => $title,
        'messages' => $messages
    ]
);
