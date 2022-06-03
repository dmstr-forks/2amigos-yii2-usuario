<?php
/**
 * @var $module Da\User\Module
 * @var $messages array
 * @var $title string
 */

use yii\helpers\Html;

if (!isset($messages)) {
    $messages = [];
}
?>

<div class="row">
    <div class="col-md-6 col-md-offset-3 col-sm-6 col-sm-offset-3">
        <h2><?php echo isset($title) ? $title : '' ?></h2>
        <?php foreach ($messages as $message): ?>
            <p><?php echo $message ?></p>
        <?php endforeach ?>
        <div class="form-group">
            <?php
            $isGuest = Yii::$app->getUser()->getIsGuest();
            echo Html::a($isGuest ? Yii::t('usuario', 'Back to login!') : Yii::t('usuario', 'Go to homepage'),
                $isGuest ? ['/user/security/login'] : Yii::$app->getHomeUrl(), ['class' => 'btn btn-primary'])
            ?>
        </div>
    </div>
</div>
